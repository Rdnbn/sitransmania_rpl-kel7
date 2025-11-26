<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RiwayatAktivitas;

class RiwayatController extends Controller
{
    /**
     * ===============================
     *  ADMIN — melihat semua aktivitas
     * ===============================
     */
    public function admin(Request $request)
    {
        $query = RiwayatAktivitas::with('user')
            ->orderBy('created_at', 'DESC');

        // FILTER USER
        if ($request->filled('user')) {
            $query->where('id_user', $request->user);
        }

        // FILTER AKSI
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }

        // FILTER TANGGAL
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        // PAGINATION
        $riwayat = $query->paginate(15);

        // Dropdown user & aksi
        $users = User::orderBy('nama')->get();
        $aksiList = RiwayatAktivitas::select('aksi')->distinct()->pluck('aksi');

        return view('admin.riwayat.index', compact('riwayat', 'users', 'aksiList'));
    }


    /**
     * ===============================
     *  PEMILIK — aktivitas pemilik
     * ===============================
     */
    public function pemilik(Request $request)
    {
        $query = RiwayatAktivitas::where('id_user', auth()->id())
            ->orderBy('created_at', 'DESC');

        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        $riwayat = $query->paginate(15);
        $aksiList = RiwayatAktivitas::select('aksi')->distinct()->pluck('aksi');

        return view('pemilik.riwayat.index', compact('riwayat', 'aksiList'));
    }


    /**
     * ===============================
     *  PEMINJAM — aktivitas peminjam
     * ===============================
     */
    public function peminjam(Request $request)
    {
        $query = RiwayatAktivitas::where('id_user', auth()->id())
            ->orderBy('created_at', 'DESC');

        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        $riwayat = $query->paginate(15);
        $aksiList = RiwayatAktivitas::select('aksi')->distinct()->pluck('aksi');

        return view('peminjam.riwayat.index', compact('riwayat', 'aksiList'));
    }
}
