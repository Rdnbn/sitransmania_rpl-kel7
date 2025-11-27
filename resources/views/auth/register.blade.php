@extends('layouts.guest')

@section('title', 'Register')

@section('content')

<div class="auth-card">

    <h3 class="text-center auth-title">Daftar Akun Baru</h3>
    <p class="text-center auth-subtitle">Buat akun untuk menggunakan SITRANSMANIA</p>

    <x-flash />
    <x-error />

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="mb-2">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   class="form-control auth-input" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control auth-input" required>
        </div>

        <div class="mb-2">
            <label class="form-label">No. Telp</label>
            <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                   class="form-control auth-input">
        </div>

        <div class="mb-2">
            <label class="form-label">Role</label>
            <select name="role" class="form-select auth-input" required>
                <option value="">— Pilih role —</option>
                <option value="pemilik" {{ old('role')=='pemilik' ? 'selected' : '' }}>Pemilik</option>
                <option value="peminjam" {{ old('role')=='peminjam' ? 'selected' : '' }}>Peminjam</option>
            </select>
        </div>

        <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control auth-input" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control auth-input" required>
        </div>

        <button class="btn btn-success w-100 auth-btn">Daftar</button>

        <div class="text-center mt-3">
            <a class="auth-link" href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
    </form>

</div>

@endsection
