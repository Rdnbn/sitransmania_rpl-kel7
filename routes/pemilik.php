<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Pemilik\KendaraanController;
use App\Http\Controllers\Pemilik\AktivitasController;
use App\Http\Controllers\Pemilik\PeminjamController;
use App\Http\Controllers\Pemilik\ChatPemilikController;
use App\Http\Controllers\Pemilik\PembayaranPemilikController;
use App\Http\Controllers\Pemilik\PeminjamanManageController;
use App\Http\Controllers\RiwayatController;

Route::middleware(['auth','role:pemilik'])
    ->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])
            ->name('pemilik.dashboard');

        // KENDARAAN
        Route::resource('/kendaraan', KendaraanController::class);

        // AKTIVITAS
        Route::get('/aktivitas', [AktivitasController::class, 'index'])
            ->name('aktivitas.index');

        Route::get('/aktivitas/lokasi/{id}', [AktivitasController::class, 'liveMap'])
            ->name('aktivitas.map');

        // DATA PEMINJAM
        Route::get('/peminjam', [PeminjamController::class, 'index'])
            ->name('peminjam.index');

        // PEMINJAMAN
        Route::get('/peminjaman', [PeminjamanManageController::class, 'index'])
            ->name('peminjaman.index');

        Route::post('/peminjaman/setujui/{id}', [PeminjamanManageController::class, 'setujui'])
            ->name('peminjaman.setujui');

        Route::post('/peminjaman/tolak/{id}', [PeminjamanManageController::class, 'tolak'])
            ->name('peminjaman.tolak');

        Route::post('/peminjaman/verifikasi/{id}', [PeminjamanManageController::class, 'verifikasi'])
            ->name('peminjaman.verifikasi');

        Route::post('/peminjaman/status/{id}', [PeminjamanManageController::class, 'updateStatus'])
            ->name('peminjaman.updateStatus');

        // CHAT
        Route::get('/chat', [ChatPemilikController::class, 'index'])
            ->name('chat.index');

        Route::get('/chat/{room}', [ChatPemilikController::class, 'show'])
            ->name('chat.show');

        // PEMBAYARAN
        Route::get('/pembayaran', [PembayaranPemilikController::class, 'index'])
            ->name('pembayaran.index');

        // RIWAYAT
        Route::get('/riwayat', [RiwayatController::class, 'pemilik'])
            ->name('riwayat');
    });
