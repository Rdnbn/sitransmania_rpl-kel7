<?php

namespace App\Services;

use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Pembayaran;

class SearchService
{
    public static function search($keyword, $role)
    {
        $result = [];

        // ============================
        // 1. SEARCH PENGGUNA
        // ============================
        if ($role === 'admin') {
            $result['users'] = User::where('nama', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('no_telp', 'LIKE', "%$keyword%")
                ->get();
        }

        // ============================
        // 2. SEARCH KENDARAAN
        // ============================
        $result['kendaraan'] = Kendaraan::where('tipe', 'LIKE', "%$keyword%")
            ->orWhere('plat_nomor', 'LIKE', "%$keyword%")
            ->get();

        // ============================
        // 3. SEARCH PEMINJAMAN
        // ============================
        if ($role === 'admin') {
            $result['peminjaman'] = Peminjaman::with(['peminjam', 'kendaraan'])
                ->whereHas('peminjam', function ($q) use ($keyword) {
                    $q->where('nama', 'LIKE', "%$keyword%");
                })
                ->orWhereHas('kendaraan', function ($q) use ($keyword) {
                    $q->where('tipe', 'LIKE', "%$keyword%");
                })
                ->get();
        }

        // ============================
        // 4. SEARCH PEMBAYARAN
        // ============================
        if ($role !== 'peminjam') {
            $result['pembayaran'] = Pembayaran::where('status', 'LIKE', "%$keyword%")
                ->get();
        }

        return $result;
    }
}
