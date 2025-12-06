<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Peminjam\DashboardPeminjamController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KendaraanAdminController;
use App\Http\Controllers\Admin\PeminjamanAdminController;
use App\Http\Controllers\Admin\PembayaranAdminController;
use App\Http\Controllers\Admin\NotifikasiAdminController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Pemilik\KendaraanController;
use App\Http\Controllers\Pemilik\AktivitasController;
use App\Http\Controllers\Pemilik\PeminjamController;
use App\Http\Controllers\Pemilik\PembayaranPemilikController;
use App\Http\Controllers\Pemilik\PeminjamanManageController;
use App\Http\Controllers\Peminjam\KendaraanBrowseController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Peminjam\PembayaranController;
use App\Http\Controllers\Peminjam\RiwayatPeminjamController;
use App\Http\Controllers\RiwayatController;

// HALAMAN UTAMA
Route::get('/', function () {
    return view('public.landing');
})->name('landing');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route untuk reset password
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('showRegisterForm');
// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Register new user
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // DASHBOARD per role
    Route::get('/pemilik/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard');
    Route::get('/peminjam/dashboard', [DashboardPeminjamController::class, 'index'])->name('peminjam.dashboard');
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // NOTIFIKASI
    Route::get('/notifikasi/{id}', [NotifikasiController::class, 'read'])->name('notif.read');

    // SEARCH
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // PROFILE
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
});


// ========== ADMIN ROUTES ==========
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    // Users Resource
    Route::resource('users', UserController::class);

    // Other admin pages
    Route::get('kendaraan', [KendaraanAdminController::class, 'index'])->name('kendaraan.index');
    Route::get('peminjaman', [PeminjamanAdminController::class, 'index'])->name('peminjaman.index');
    Route::get('pembayaran', [PembayaranAdminController::class, 'index'])->name('pembayaran.index');
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('notifikasi', [NotifikasiAdminController::class, 'index'])->name('notifikasi.index');
    Route::get('riwayat', [RiwayatController::class, 'admin'])->name('riwayat.index');
});

// ========== PEMILIK ROUTES ==========
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->as('pemilik.')->group(function () {
    // DASHBOARD
    Route::get('dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');

    // KENDARAAN
    Route::resource('kendaraan', KendaraanController::class);

    // AKTIVITAS
    Route::get('aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');
    Route::get('aktivitas/lokasi/{id}', [AktivitasController::class, 'liveMap'])->name('aktivitas.map');

    // DATA PEMINJAM
    Route::get('peminjam', [PeminjamController::class, 'index'])->name('peminjam.index');

    // PEMINJAMAN
    Route::get('peminjaman', [PeminjamanManageController::class, 'index'])->name('peminjaman.index');
    Route::post('peminjaman/setujui/{id}', [PeminjamanManageController::class, 'setujui'])->name('peminjaman.setujui');
    Route::post('peminjaman/tolak/{id}', [PeminjamanManageController::class, 'tolak'])->name('peminjaman.tolak');
    Route::post('peminjaman/verifikasi/{id}', [PeminjamanManageController::class, 'verifikasi'])->name('peminjaman.verifikasi');
    Route::post('peminjaman/status/{id}', [PeminjamanManageController::class, 'updateStatus'])->name('peminjaman.updateStatus');

    // PEMBAYARAN
    Route::get('pembayaran', [PembayaranPemilikController::class, 'index'])->name('pembayaran.index');

    // RIWAYAT
    Route::get('riwayat', [RiwayatController::class, 'pemilik'])->name('riwayat');
});

// ========== PEMINJAM ROUTES ==========
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->as('peminjam.')->group(function () {

    // DASHBOARD
    Route::get('dashboard', [DashboardPeminjamController::class, 'index'])->name('dashboard');

    // BROWSE KENDARAAN
    Route::get('browse', [BrowseKendaraanController::class, 'index'])->name('browse.index');
    Route::get('browse/{id}', [BrowseKendaraanController::class, 'detail'])->name('browse.detail');

    // PINJAM
    Route::get('pinjam/{id_kendaraan}', [PeminjamanController::class, 'create'])->name('pinjam.form');
    Route::post('pinjam/store', [PeminjamanController::class, 'store'])->name('pinjam.store');

    // LIST PEMINJAMAN
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

    // PEMBAYARAN
    Route::get('pembayaran/{id_peminjaman}', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('pembayaran/upload', [PembayaranController::class, 'upload'])->name('pembayaran.upload');

    // RIWAYAT
    Route::get('riwayat', [RiwayatPeminjamController::class, 'index'])->name('riwayat');
    Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
});