<?php

namespace App\Http\Controllers;

use App\Models\LokasiKendaraan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class LiveMapController extends Controller
{
    public function index($id_kendaraan)
    {
        $kendaraan = Kendaraan::findOrFail($id_kendaraan);

        return view('livemap.index', [
            'kendaraan' => $kendaraan
        ]);
    }

    public function fetch($id_kendaraan)
    {
        $lokasi = LokasiKendaraan::where('id_kendaraan', $id_kendaraan)
            ->latest('waktu_update')
            ->first();

        return response()->json($lokasi);
    }
}
