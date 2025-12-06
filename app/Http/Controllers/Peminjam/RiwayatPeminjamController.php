<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Riwayat; // sesuaikan dengan nama model kamu

class RiwayatPeminjamController extends Controller
{
    public function index(Request $request)
    {
        $idPeminjam = Auth::user()->id_user; // sesuaikan jika field id berbeda

        // List aksi untuk dropdown -> ambil unik dari database atau manual
        $aksiList = Riwayat::where('id_peminjam', $idPeminjam)
            ->distinct()
            ->pluck('aksi')
            ->toArray();

        // Query dasar
        $riwayat = Riwayat::where('id_peminjam', $idPeminjam);

        // Filter aksi
        if ($request->aksi) {
            $riwayat->where('aksi', $request->aksi);
        }

        // Filter tanggal
        if ($request->tanggal_mulai) {
            $riwayat->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->tanggal_akhir) {
            $riwayat->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        $riwayat = $riwayat->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();

        return view('peminjam.riwayat.index', compact('aksiList', 'riwayat'));
    }
}
