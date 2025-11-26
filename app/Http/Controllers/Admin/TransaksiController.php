<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Peminjaman::with(['kendaraan', 'pembayaran', 'peminjam'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }
}
