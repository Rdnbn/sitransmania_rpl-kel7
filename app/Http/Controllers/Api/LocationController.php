<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LokasiKendaraan;

class LocationController extends Controller
{
    public function getLocation($id_kendaraan)
    {
        $lokasi = LokasiKendaraan::where('id_kendaraan', $id_kendaraan)
            ->orderBy('waktu_update', 'DESC')
            ->first();

        return response()->json($lokasi);
    }
}
