@extends('layouts.landing')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<div class="hero">
    <div class="hero-overlay"></div>

    <div class="container h-100 d-flex align-items-center">
        <div class="hero-content">
            <h3 class="fw-semibold">Selamat Datang!</h3>

            <h1 class="hero-title">SITRANSMANIA</h1>

            <p class="hero-subtitle">
                Sistem Layanan Peminjaman Transportasi Antarwarga Asrama Universitas Negeri Malang
            </p>

            <a href="{{ route('login') }}" class="btn btn-primary btn-hero">
                Masuk ke Aplikasi
            </a>
        </div>
    </div>
</div>

@endsection
