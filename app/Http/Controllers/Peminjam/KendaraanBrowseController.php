<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;

class KendaraanBrowseController extends Controller
{
    // LIST & FILTER KENDARAAN
    public function index(Request $request)
    {
        $query = Kendaraan::with('pemilik')
            ->where('status', '!=', 'tidak aktif');

        // FILTER: TIPE
        if ($request->tipe) {
            $query->where('tipe', 'like', '%' . $request->tipe . '%');
        }

        // FILTER: HARGA MAX
        if ($request->max_harga) {
            $query->where('harga_sewa', '<=', $request->max_harga);
        }

        // FILTER: STATUS (tersedia / tidak tersedia)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $kendaraan = $query->get();

        return view('peminjam.kendaraan.index', compact('kendaraan'));
    }

    // DETAIL KENDARAAN
    public function show($id)
    {
        $kendaraan = Kendaraan::with('pemilik')->findOrFail($id);

        return view('peminjam.kendaraan.show', compact('kendaraan'));
    }
}
