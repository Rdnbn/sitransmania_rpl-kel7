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

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardAdminController::class, 'index'])
        ->name('dashboard');

    Route::resource('users', UserController::class);

    Route::get('/kendaraan', [KendaraanAdminController::class, 'index'])
        ->name('kendaraan.index');

    Route::get('/peminjaman', [PeminjamanAdminController::class, 'index'])
        ->name('peminjaman.index');

    Route::get('/pembayaran', [PembayaranAdminController::class, 'index'])
        ->name('pembayaran.index');

    Route::get('/transaksi', [TransaksiController::class, 'index'])
        ->name('transaksi.index');

    Route::get('/notifikasi', [NotifikasiAdminController::class, 'index'])
        ->name('notifikasi.index');

    Route::get('/riwayat', [RiwayatController::class, 'admin'])
        ->name('riwayat.index');
});
