<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pemilik\DashboardController;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// UNIVERSAL CHAT (boleh semua role)
Route::middleware(['auth'])->group(function () {

    Route::get('/pemilik/dashboard', [DashboardController::class, 'index'])->name('pemilik.dashboard');
    Route::get('/peminjam/dashboard', [PeminjamDashboardController::class, 'index'])->name('peminjam.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // ROOM CHAT
    Route::get('/chat/{id_peminjaman}', [ChatController::class, 'room'])
        ->name('chat.room');

    // SEND MESSAGE
    Route::post('/chat/send', [ChatController::class, 'send'])
        ->name('chat.send');

    // FETCH (AJAX)
    Route::get('/chat/fetch/{id}', [ChatController::class, 'fetch'])
        ->name('chat.fetch');

    // NOTIFIKASI
    Route::get('/notifikasi/{id}', [NotifikasiController::class, 'read'])
        ->name('notif.read');

    Route::get('/search', [SearchController::class, 'index'])
        ->name('search');
    
});
