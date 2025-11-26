<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Chat;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $pemilikId = auth()->id();

        return view('pemilik.dashboard.index', [
            'totalKendaraan' => Kendaraan::where('id_pemilik', $pemilikId)->count(),
            'totalPinjam'    => Peminjaman::where('id_pemilik', $pemilikId)->count(),
            'totalPay'       => Pembayaran::where('id_pemilik', $pemilikId)->count(),
            'totalChat'      => Chat::where('receiver_id', $pemilikId)->orWhere('sender_id', $pemilikId)->count(),
        ]);
    }
}
