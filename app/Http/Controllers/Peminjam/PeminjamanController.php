<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // TAMPILKAN FORM PINJAM
    public function create($id_kendaraan)
    {
        $kendaraan = Kendaraan::with('pemilik')->findOrFail($id_kendaraan);

        if ($kendaraan->status != 'tersedia') {
            return back()->with('error', 'Kendaraan sedang tidak tersedia.');
        }

        return view('peminjam.peminjaman.form', compact('kendaraan'));
    }

    // PROSES SIMPAN DATA PINJAMAN
    public function store(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required',
            'nama'         => 'required|string',
            'no_telp'      => 'required',
            'asrama'       => 'required',
            'kamar'        => 'required',
            'prodi'        => 'required',
            'angkatan'     => 'required',
            'tanggal_pinjam' => 'required|date',
            'waktu_pinjam'   => 'required',
            'foto_ktp'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // UPLOAD FOTO KTP
        $ktpName = time() . '-' . $request->foto_ktp->getClientOriginalName();
        $request->foto_ktp->move(public_path('uploads/ktp'), $ktpName);

        // SIMPAN PEMINJAMAN
        $peminjaman = Peminjaman::create([
            'id_kendaraan'   => $request->id_kendaraan,
            'id_peminjam'    => auth()->id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'waktu_pinjam'   => $request->waktu_pinjam,
            'status'         => 'menunggu', // default
            'nama'           => $request->nama,
            'no_telp'        => $request->no_telp,
            'asrama'         => $request->asrama,
            'kamar'          => $request->kamar,
            'prodi'          => $request->prodi,
            'angkatan'       => $request->angkatan,
            'foto_ktp'       => $ktpName,
        ]);

        // UBAH STATUS KENDARAAN → "tidak tersedia"
        $kendaraan = Kendaraan::find($request->id_kendaraan);
        $kendaraan->update(['status' => 'tidak tersedia']);

        // KIRIM NOTIFIKASI UNTUK PEMILIK
        Notifikasi::create([
            'id_user'      => $kendaraan->id_pemilik,
            'jenis'        => 'peminjaman',
            'pesan'        => 'Ada permintaan peminjaman kendaraan Anda.',
            'id_peminjaman'=> $peminjaman->id_peminjaman,
            'is_read'      => 0,
        ]);

        return redirect()->route('peminjam.dashboard')
            ->with('success', 'Permintaan peminjaman berhasil dikirim! Silakan menunggu persetujuan pemilik.');
    }
}
