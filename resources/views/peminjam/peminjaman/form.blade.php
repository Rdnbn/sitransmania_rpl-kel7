@extends('layouts.peminjam')

@section('title', 'Form Peminjaman')

@section('content')

<h3 class="fw-bold mb-4">Form Peminjaman</h3>

<div class="card p-4 shadow">

    <h5 class="fw-bold">{{ $kendaraan->merk }} ({{ $kendaraan->tipe }})</h5>
    <p class="mb-1">Plat: {{ $kendaraan->plat_nomor }}</p>
    <p class="mb-3">Harga: Rp{{ number_format($kendaraan->harga_sewa) }}</p>

    {{-- Flash & Error --}}
    <x-flash />
    <x-error />
    
    <form action="{{ route('peminjam.pinjam.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id_kendaraan" value="{{ $kendaraan->id_kendaraan }}">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>No. Telp</label>
                <input type="text" name="no_telp" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Asrama</label>
                <input type="text" name="asrama" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Kamar</label>
                <input type="text" name="kamar" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Prodi</label>
                <input type="text" name="prodi" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Angkatan</label>
                <input type="text" name="angkatan" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Foto KTP</label>
                <input type="file" name="foto_ktp" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Waktu Pinjam</label>
                <input type="time" name="waktu_pinjam" class="form-control" required>
            </div>
        </div>

        <button class="btn btn-primary mt-3 w-100">Kirim Permintaan Peminjaman</button>
    </form>
</div>

@endsection
