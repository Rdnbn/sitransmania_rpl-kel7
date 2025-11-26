<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KendaraanAdminController;
use App\Http\Controllers\Admin\PeminjamanAdminController;
use App\Http\Controllers\Admin\PembayaranAdminController;
use App\Http\Controllers\Admin\NotifikasiAdminController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\RiwayatController;

Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])
            ->name('dashboard');

        // User Management
        Route::resource('/users', UserController::class);

        // Kendaraan
        Route::get('/kendaraan', [KendaraanAdminController::class, 'index'])
            ->name('kendaraan.index');

        // Peminjaman
        Route::get('/peminjaman', [PeminjamanAdminController::class, 'index'])
            ->name('peminjaman.index');

        // Pembayaran
        Route::get('/pembayaran', [PembayaranAdminController::class, 'index'])
            ->name('pembayaran.index');

        // Transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi.index');

        // Notifikasi
        Route::get('/notifikasi', [NotifikasiAdminController::class, 'index'])
            ->name('notifikasi.index');

        // Riwayat
        Route::get('/riwayat', [RiwayatController::class, 'admin'])
            ->name('riwayat.index');

    });
