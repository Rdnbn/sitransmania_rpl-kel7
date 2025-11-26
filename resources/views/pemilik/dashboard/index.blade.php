@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="fw-bold mb-4">Dashboard Pemilik</h2>

<div class="row">

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ $totalKendaraan }}</h4>
                <p>Kendaraan Saya</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ $totalPinjam }}</h4>
                <p>Peminjaman</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ $totalPay }}</h4>
                <p>Pembayaran</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ $totalChat }}</h4>
                <p>Pesan Masuk</p>
            </div>
        </div>
    </div>

</div>

@endsection
