<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index($id_peminjaman)
    {
        $pinjam = Peminjaman::with('kendaraan.pemilik')->findOrFail($id_peminjaman);

        return view('peminjam.pembayaran.index', [
            'pinjam' => $pinjam,
            'pemilik' => $pinjam->kendaraan->pemilik,
            'pembayaran' => $pinjam->pembayaran
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'bukti' => 'required|mimes:jpg,png,jpeg,pdf|max:2048'
        ]);

        $file = $request->file('bukti');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/pembayaran/'), $filename);

        Pembayaran::updateOrCreate(
            ['id_peminjaman' => $request->id_peminjaman],
            [
                'id_pemilik' => $request->id_pemilik,
                'status' => 'menunggu_verifikasi',
                'bukti' => $filename
            ]
        );
        // === NOTIFIKASI UNTUK PEMILIK ===
        NotificationService::send(
        $request->id_pemilik,
        $request->id_peminjaman,
        "Bukti Pembayaran Dikirim",
        "Peminjam telah mengirim bukti pembayaran untuk diverifikasi."
        );

        // === CATATAN RIWAYAT ===
        ActivityService::add(
        auth()->id(),
            "Upload Bukti Pembayaran",
            "Mengirim bukti pembayaran untuk verifikasi",
        $request->id_peminjaman
        );

        return back()->with('success', 'Bukti pembayaran berhasil dikirim.');
    }

    // ===============================
    //  PEMILIK — verifikasi pembayaran
    // ===============================
    public function pemilikView($id_peminjaman)
    {
        $pembayaran = Pembayaran::where('id_peminjaman', $id_peminjaman)->first();

        return view('pemilik.pembayaran.index', compact('pembayaran'));
    }

    public function verifikasi(Request $request)
    {
        $request->validate([
            'id_pembayaran' => 'required',
            'status' => 'required'
        ]);

        $bayar = Pembayaran::findOrFail($request->id_pembayaran);
        $bayar->status = $request->status;
        $bayar->save();
        
        // === NOTIFIKASI UNTUK PEMINJAM ===
        NotificationService::send(
        $bayar->peminjaman->id_peminjam,
        $bayar->id_peminjaman,
        "Status Pembayaran",
        "Pembayaran Anda telah {$request->status}."
        );

        // === CATATAN RIWAYAT ===
        ActivityService::add(
        auth()->id(),
            "Verifikasi Pembayaran",
            "Memverifikasi pembayaran menjadi: {$request->status}",
        $bayar->id_peminjaman
        );

        return back()->with('success', 'Status pembayaran diperbarui.');
    }

    public function riwayatPemilik()
    {
        $riwayat = Pembayaran::where('id_pemilik', auth()->id())
            ->with('peminjaman.kendaraan')
            ->latest()
            ->get();

        return view('pemilik.pembayaran.riwayat', compact('riwayat'));
    }
}
