<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Chat;

class DashboardPeminjamController extends Controller
{
    public function index()
    {
        $id = auth()->id();

        return view('peminjam.dashboard.index', [
            'totalPinjam' => Peminjaman::where('id_peminjam', $id)->count(),
            'totalPay'    => Pembayaran::where('id_peminjam', $id)->count(),
            'totalChat'   => Chat::where('receiver_id', $id)->orWhere('sender_id', $id)->count(),
            'lastStatus'  => Peminjaman::where('id_peminjam', $id)->latest()->value('status'),
        ]);
    }
}
