@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')

<h3 class="fw-bold mb-3">Pengaturan Akun</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">

    {{-- Update Profil --}}
    <div class="col-md-6">
        <div class="card p-4 shadow">

            <h5 class="fw-bold mb-3">Data Profil</h5>

            <form action="{{ route('pemilik.akun.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $user->nama }}" class="form-control mb-2" required>

                <label>No. Telepon</label>
                <input type="text" name="no_telp" value="{{ $user->no_telp }}" class="form-control mb-2" required>

                <label>Foto Profil</label>
                <input type="file" name="foto_profil" class="form-control mb-2">

                <label>QRIS Pembayaran</label>
                <input type="file" name="qris" class="form-control mb-3">

                <button class="btn btn-primary">Simpan Profil</button>
            </form>

        </div>
    </div>

    {{-- Ubah Password --}}
    <div class="col-md-6">
        <div class="card p-4 shadow">

            <h5 class="fw-bold mb-3">Ubah Password</h5>
            {{-- Flash & Error --}}
            <x-flash />
            <x-error />
            <form action="{{ route('pemilik.akun.password') }}" method="POST">
                @csrf

                <label>Password Lama</label>
                <input type="password" name="password_lama" class="form-control mb-2" required>

                <label>Password Baru</label>
                <input type="password" name="password_baru" class="form-control mb-2" required>

                <label>Konfirmasi Password</label>
                <input type="password" name="password_baru_confirmation" class="form-control mb-3" required>

                <button class="btn btn-warning">Ubah Password</button>
            </form>

        </div>
    </div>

</div>

@endsection
