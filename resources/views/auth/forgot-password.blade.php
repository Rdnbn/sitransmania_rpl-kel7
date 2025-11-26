@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card shadow p-4" style="width:420px;">
        <h3 class="text-center fw-bold mb-3">Lupa Password</h3>

        <x-flash />
        <x-error />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Masukkan email terdaftar</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Kirim Link Reset</button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
