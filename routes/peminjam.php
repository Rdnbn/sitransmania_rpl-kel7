<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Peminjam\BrowseKendaraanController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Peminjam\PembayaranController;
use App\Http\Controllers\Peminjam\DashboardPeminjamController;
use App\Http\Controllers\Peminjam\RiwayatPeminjamController;
use App\Http\Controllers\Peminjam\NotifikasiController;

// DASHBOARD
Route::get('/dashboard', [DashboardPeminjamController::class, 'index'])
    ->name('peminjam.dashboard');

// BROWSE KENDARAAN
Route::get('/browse', [BrowseKendaraanController::class, 'index'])
    ->name('peminjam.browse.index');

Route::get('/browse/{id}', [BrowseKendaraanController::class, 'detail'])
    ->name('peminjam.browse.detail');

// PINJAM
Route::get('/pinjam/{id_kendaraan}', [PeminjamanController::class, 'create'])
    ->name('peminjam.pinjam.form');

Route::post('/pinjam/store', [PeminjamanController::class, 'store'])
    ->name('peminjam.pinjam.store');

// LIST PEMINJAMAN
Route::get('/peminjaman', [PeminjamanController::class, 'index'])
    ->name('peminjam.peminjaman.index');

// PEMBAYARAN
Route::get('/pembayaran/{id_peminjaman}', [PembayaranController::class, 'index'])
    ->name('peminjam.pembayaran.index');

Route::post('/pembayaran/upload', [PembayaranController::class, 'upload'])
    ->name('peminjam.pembayaran.upload');

// RIWAYAT
Route::get('/riwayat', [RiwayatPeminjamController::class, 'index'])
    ->name('peminjam.riwayat.index');

// NOTIFIKASI
Route::get('/notifikasi', [NotifikasiController::class, 'index'])
    ->name('peminjam.notifikasi.index');