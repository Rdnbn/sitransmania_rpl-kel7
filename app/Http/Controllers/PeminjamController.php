<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class PeminjamanController extends Controller
{
    // ================================
    // HALAMAN FORM PEMINJAMAN
    // ================================
    public function form($id_kendaraan)
    {
        $kendaraan = Kendaraan::with('pemilik')->findOrFail($id_kendaraan);

        return view('peminjam.peminjaman.form', compact('kendaraan'));
    }

    // ================================
    // SUBMIT PEMINJAMAN
    // ================================
    public function store(Request $request)
    {
        $request->validate([
            'id_kendaraan'  => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $kendaraan = Kendaraan::with('pemilik')->findOrFail($request->id_kendaraan);

        // Simpan peminjaman
        $pinjam = Peminjaman::create([
            'id_kendaraan' => $request->id_kendaraan,
            'id_peminjam' => auth()->id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu_konfirmasi',
        ]);

        // ================================
        // NOTIFIKASI UNTUK PEMILIK
        // ================================
        NotificationService::send(
            $kendaraan->id_pemilik,                 // user yang menerima notifikasi
            $pinjam->id_peminjaman,                // id transaksi
            "Peminjaman Baru",                     // judul notifikasi
            "Ada permintaan peminjaman baru untuk kendaraan Anda." // isi
        );

        // === CATATAN RIWAYAT ===
        ActivityService::add(
            auth()->id(),
            "Peminjaman Dibuat",
            "Mengajukan peminjaman kendaraan {$kendaraan->tipe}",
            $pinjam->id_peminjaman
        );
        
        return redirect()->route('peminjam.pembayaran', $pinjam->id_peminjaman)
            ->with('success', 'Peminjaman berhasil dibuat. Silakan lanjut ke pembayaran.');
    }


    // ================================
    // DETAIL PEMINJAMAN (SEMUA ROLE)
    // ================================
    public function detail($id_peminjaman)
    {
        $pinjam = Peminjaman::with(['kendaraan.pemilik', 'peminjam'])
            ->findOrFail($id_peminjaman);

        return view('peminjaman.detail', compact('pinjam'));
    }


    // ================================
    // RIWAYAT PEMINJAMAN PEMINJAM
    // ================================
    public function riwayatPeminjam()
    {
        $riwayat = Peminjaman::where('id_peminjam', auth()->id())
            ->with('kendaraan')
            ->latest()
            ->get();

        return view('peminjam.peminjaman.riwayat', compact('riwayat'));
    }


    // ================================
    // RIWAYAT PEMILIK
    // ================================
    public function riwayatPemilik()
    {
        $riwayat = Peminjaman::whereHas('kendaraan', function($q) {
                $q->where('id_pemilik', auth()->id());
            })
            ->with(['kendaraan', 'peminjam'])
            ->latest()
            ->get();

        return view('pemilik.peminjaman.riwayat', compact('riwayat'));
    }
}
