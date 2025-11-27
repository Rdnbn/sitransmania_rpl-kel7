<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalPemilik     = User::where('role', 'pemilik')->count();
        $totalPeminjam    = User::where('role', 'peminjam')->count();
        $totalKendaraan   = Kendaraan::count();
        $totalPeminjaman  = Peminjaman::count();

        // Status peminjaman
        $aktif   = Peminjaman::where('status_peminjaman', 'aktif')->count();
        $selesai = Peminjaman::where('status_peminjaman', 'selesai')->count();

        // Chart per bulan
        $year = Carbon::now()->year;

        $chart = Peminjaman::selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_pinjam', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $fullChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $fullChart[$i] = $chart[$i] ?? 0;
        }

        // Aktivitas terbaru dengan relasi peminjam
        $recent = Peminjaman::with('peminjam')
            ->latest('tanggal_pinjam')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalPemilik',
            'totalPeminjam',
            'totalKendaraan',
            'totalPeminjaman',
            'aktif',
            'selesai',
            'fullChart',
            'recent'
        ));
    }
}
