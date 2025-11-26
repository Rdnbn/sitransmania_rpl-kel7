<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Notifikasi;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalUser'       => User::count(),
            'totalKendaraan'  => Kendaraan::count(),
            'totalPinjam'     => Peminjaman::count(),
            'totalPembayaran' => Pembayaran::count(),
            'totalNotif'      => Notifikasi::count(),
        ]);
    }
}
