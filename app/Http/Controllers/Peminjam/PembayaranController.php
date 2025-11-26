<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // TAMPILKAN HALAMAN PEMBAYARAN
    public function index($id_peminjaman)
    {
        $peminjaman = Peminjaman::with(['kendaraan.pemilik'])->findOrFail($id_peminjaman);

        // QR CODE PEMILIK (ambil dari users.qris_image)
        $qris = $peminjaman->kendaraan->pemilik->qris_image;

        return view('peminjam.pembayaran.index', compact('peminjaman', 'qris'));
    }

    // UPLOAD BUKTI PEMBAYARAN
    public function upload(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload bukti transfer
        $fileName = time() . '-' . $request->bukti->getClientOriginalName();
        $request->bukti->move(public_path('uploads/bukti'), $fileName);

        // Simpan ke tabel pembayaran
        $pembayaran = Pembayaran::create([
            'id_peminjaman' => $request->id_peminjaman,
            'id_pemilik' => $request->id_pemilik,
            'status' => 'DP',
            'bukti' => $fileName,
        ]);

        // NOTIFIKASI UNTUK PEMILIK
        Notifikasi::create([
            'id_user'      => $request->id_pemilik,
            'jenis'        => 'pembayaran',
            'pesan'        => 'Peminjam telah mengupload bukti pembayaran.',
            'id_peminjaman'=> $request->id_peminjaman,
            'is_read'      => 0,
        ]);

        return redirect()->route('peminjam.dashboard')
            ->with('success', 'Bukti pembayaran berhasil dikirim! Tunggu konfirmasi dari pemilik.');
    }
}
