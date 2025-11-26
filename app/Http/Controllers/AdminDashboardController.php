<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\RiwayatAktivitas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalPemilik = User::where('role', 'pemilik')->count();
        $totalPeminjam = User::where('role', 'peminjam')->count();
        $totalKendaraan = Kendaraan::count();
        $totalPeminjaman = Peminjaman::count();

        // Peminjaman aktif & selesai
        $aktif = Peminjaman::where('status', 'dipinjam')->count();
        $selesai = Peminjaman::where('status', 'selesai')->count();

        // Grafik peminjaman 12 bulan terakhir
        $chart = Peminjaman::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Aktivitas terbaru
        $recent = RiwayatAktivitas::with('user')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalPemilik',
            'totalPeminjam',
            'totalKendaraan',
            'totalPeminjaman',
            'aktif',
            'selesai',
            'chart',
            'recent'
        ));
    }
}
