<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class ChatController extends Controller
{
    // ================================
    // ROOM CHAT
    // ================================
    public function room($id_peminjaman)
    {
        $pinjam = Peminjaman::with(['kendaraan.pemilik', 'peminjam'])
            ->findOrFail($id_peminjaman);

        // Tentukan lawan bicara
        $target = auth()->id() == $pinjam->id_peminjam
            ? $pinjam->kendaraan->pemilik
            : $pinjam->peminjam;

        // Ambil pesan chat
        $pesan = ChatMessage::where('id_peminjaman', $id_peminjaman)
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('chat.room', compact('pinjam', 'target', 'pesan'));
    }

    // ================================
    // KIRIM PESAN (TEXT & FILE)
    // ================================
    public function send(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'id_penerima'   => 'required',
            'pesan'         => 'nullable|string',
            'file'          => 'nullable|file|max:4096'
        ]);

        // Upload file jika ada
        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = time() . '-' . $request->file->getClientOriginalName();
            $request->file->move(public_path('uploads/chat'), $fileName);
        }

        // Simpan pesan
        $msg = ChatMessage::create([
            'id_pengirim'   => auth()->id(),
            'id_penerima'   => $request->id_penerima,
            'id_peminjaman' => $request->id_peminjaman,
            'pesan'         => $request->pesan,
            'file'          => $fileName,
        ]);

        // ================================
        // NOTIFIKASI PESAN BARU
        // ================================
        NotificationService::send(
            $request->id_penerima,            // dikirim ke penerima
            $request->id_peminjaman,
            "Pesan Baru",
            "Anda menerima pesan baru."
        );

        // === CATATAN RIWAYAT ===
        ActivityService::add(
        auth()->id(),
            "Kirim Pesan",
            "Mengirim pesan kepada user #{$request->id_penerima}",
        $request->id_peminjaman
        );

        return back();
    }

    // ================================
    // FETCH PESAN UNTUK AJAX (REALTIME)
    // ================================
    public function fetch($id_peminjaman)
    {
        $pesan = ChatMessage::where('id_peminjaman', $id_peminjaman)
            ->orderBy('created_at', 'ASC')
            ->get();

        return response()->json($pesan);
    }
}
