@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')

<h3 class="fw-bold mb-3">Pembayaran Peminjaman</h3>

<div class="card p-4 shadow">

    {{-- DATA PEMILIK --}}
    <h5 class="fw-bold">Pemilik Kendaraan</h5>
    <p>{{ $pemilik->nama }} ({{ $pemilik->no_telp }})</p>

    <hr>

    {{-- METODE PEMBAYARAN --}}
    <h5 class="fw-bold">Metode Pembayaran</h5>
    <p>Silakan scan QR Code berikut:</p>

    <img src="{{ asset('uploads/qris/'.$pemilik->qris) }}"
         alt="QRIS"
         class="img-fluid mb-3"
         style="max-width:260px">

    <hr>

    {{-- FORM UPLOAD BUKTI --}}
    <h5 class="fw-bold">Kirim Bukti Pembayaran</h5>
    {{-- Flash & Error --}}
    <x-flash />
    <x-error />
    <form method="POST" 
          action="{{ route('peminjam.pembayaran.upload') }}"
          enctype="multipart/form-data">

        @csrf
        
        <input type="hidden" name="id_peminjaman" value="{{ $pinjam->id_peminjaman }}">
        <input type="hidden" name="id_pemilik" value="{{ $pemilik->id_user }}">

        <input type="file" name="bukti" required class="form-control mb-3">

        <button class="btn btn-primary">Kirim Bukti</button>
    </form>

    {{-- STATUS PEMBAYARAN --}}
    @if($pembayaran)
    <hr>
        <h5>Status Pembayaran:</h5>
        <span class="badge bg-info text-dark">{{ $pembayaran->status }}</span>
    @endif

</div>

@endsection