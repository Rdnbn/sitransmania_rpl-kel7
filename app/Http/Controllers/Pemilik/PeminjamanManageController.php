<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Notifikasi;
use App\Models\Kendaraan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PeminjamanManageController extends Controller
{
    // LIST PEMINJAMAN
    public function index()
    {
        $peminjaman = Peminjaman::with(['kendaraan', 'pembayaran'])
            ->whereHas('kendaraan', function ($q) {
                $q->where('id_pemilik', auth()->id());
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('pemilik.peminjaman.index', compact('peminjaman'));
    }

    // SETUJUI PEMINJAMAN
    public function setujui($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update(['status' => 'disetujui']);

        // NOTIFIKASI UNTUK PEMINJAM
        Notifikasi::create([
            'id_user' => $pinjam->id_peminjam,
            'jenis' => 'peminjaman',
            'pesan' => 'Permintaan peminjaman Anda disetujui. Silakan lanjut ke pembayaran.',
            'id_peminjaman' => $pinjam->id_peminjaman,
            'is_read' => 0
        ]);

        return back()->with('success', 'Peminjaman disetujui.');
    }

    // TOLAK PEMINJAMAN
    public function tolak($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update(['status' => 'ditolak']);

        $kendaraan = Kendaraan::find($pinjam->id_kendaraan);
        $kendaraan->update(['status' => 'tersedia']);

        Notifikasi::create([
            'id_user' => $pinjam->id_peminjam,
            'jenis' => 'peminjaman',
            'pesan' => 'Permintaan peminjaman Anda ditolak.',
            'id_peminjaman' => $pinjam->id_peminjaman,
            'is_read' => 0
        ]);

        return back()->with('success', 'Peminjaman ditolak.');
    }

    // VERIFIKASI PEMBAYARAN
    public function verifikasi($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pembayaran = Pembayaran::where('id_peminjaman', $id)->first();

        if (!$pembayaran) {
            return back()->with('error', 'Belum ada bukti pembayaran.');
        }

        $pembayaran->update(['status' => 'dibayar']);

        // NOTIFIKASI
        Notifikasi::create([
            'id_user' => $pinjam->id_peminjam,
            'jenis' => 'pembayaran',
            'pesan' => 'Pembayaran Anda telah diverifikasi.',
            'id_peminjaman' => $pinjam->id_peminjaman,
            'is_read' => 0
        ]);

        return back()->with('success', 'Pembayaran diverifikasi.');
    }

    // UPDATE STATUS PEMINJAMAN
    public function updateStatus(Request $request, $id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update(['status' => $request->status]);

        // Jika selesai → kendaraan tersedia lagi
        if ($request->status == 'selesai') {
            $kendaraan = Kendaraan::find($pinjam->id_kendaraan);
            $kendaraan->update(['status' => 'tersedia']);
        }

        return back()->with('success', 'Status peminjaman diperbarui.');
    }
}
