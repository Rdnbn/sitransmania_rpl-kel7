@extends('layouts.peminjam')

@section('title', 'Dashboard')

@section('content')

<h2 class="fw-bold mb-4">Dashboard Peminjam</h2>

<div class="row">

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ $totalPinjam }}</h4>
                <p>Total Peminjaman</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ $totalPay }}</h4>
                <p>Total Pembayaran</p>
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

    @if($lastStatus)
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h4>{{ ucfirst($lastStatus) }}</h4>
                <p>Status Terakhir</p>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection
