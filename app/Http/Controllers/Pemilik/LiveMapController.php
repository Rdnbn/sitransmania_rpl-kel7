<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Peminjaman;

class LiveMapController extends Controller
{
    public function index()
    {
        $pemilik = auth()->id();

        // Kendaraan yang sedang dipinjam
        $dipinjam = Peminjaman::with('kendaraan')
            ->whereHas('kendaraan', function ($q) use ($pemilik) {
                $q->where('id_pemilik', $pemilik);
            })
            ->where('status', 'dipinjam')
            ->get();

        return view('pemilik.livemap.index', compact('dipinjam'));
    }

    public function view($id_kendaraan)
    {
        $kendaraan = Kendaraan::findOrFail($id_kendaraan);

        return view('pemilik.livemap.view', compact('kendaraan'));
    }
}
