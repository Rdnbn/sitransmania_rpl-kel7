<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter tanggal (opsional)
        $mulai = $request->tanggal_mulai;
        $akhir = $request->tanggal_akhir;

        $filter = [];

        if ($mulai && $akhir) {
            $filter = [
                ['created_at', '>=', $mulai . ' 00:00:00'],
                ['created_at', '<=', $akhir . ' 23:59:59']
            ];
        }

        // Statistik Ringkas
        $stat = [
            'total_user'        => User::count(),
            'total_pemilik'     => User::where('role', 'pemilik')->count(),
            'total_peminjam'    => User::where('role', 'peminjam')->count(),
            'total_kendaraan'   => Kendaraan::count(),
            'total_peminjaman'  => Peminjaman::where($filter)->count(),
            'total_pembayaran'  => Pembayaran::where($filter)->count(),
            'total_dipinjam'    => Peminjaman::where('status', 'dipinjam')->count(),
        ];

        // Tabel peminjaman untuk laporan
        $peminjaman = Peminjaman::with(['peminjam', 'kendaraan'])
            ->where($filter)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.laporan.index', compact('stat', 'peminjaman', 'mulai', 'akhir'));
    }
}
