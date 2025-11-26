<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Peminjam\BrowseKendaraanController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Peminjam\PembayaranController;
use App\Http\Controllers\Peminjam\ChatPeminjamController;
use App\Http\Controllers\RiwayatController;

Route::middleware(['auth', 'role:peminjam'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', function () {
            return view('peminjam.dashboard');
        })->name('dashboard');

        // BROWSE KENDARAAN
        Route::get('/browse', [BrowseKendaraanController::class, 'index'])
            ->name('browse.index');

        Route::get('/browse/{id}', [BrowseKendaraanController::class, 'detail'])
            ->name('browse.detail');

        // PINJAM
        Route::get('/pinjam/{id_kendaraan}', [PeminjamanController::class, 'create'])
            ->name('pinjam.form');

        Route::post('/pinjam/store', [PeminjamanController::class, 'store'])
            ->name('pinjam.store');

        // LIST PEMINJAMAN
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        // PEMBAYARAN
        Route::get('/pembayaran/{id_peminjaman}', [PembayaranController::class, 'index'])
            ->name('pembayaran.index');

        Route::post('/pembayaran/upload', [PembayaranController::class, 'upload'])
            ->name('pembayaran.upload');

        // CHAT
        Route::get('/chat', [ChatPeminjamController::class, 'index'])
            ->name('chat.index');

        Route::get('/chat/{room}', [ChatPeminjamController::class, 'show'])
            ->name('chat.show');

        // RIWAYAT
        Route::get('/riwayat', [RiwayatController::class, 'peminjam'])
            ->name('riwayat');
    });
