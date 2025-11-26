@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')

<h3 class="fw-bold mb-3">Pengaturan Sistem</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-4 shadow">

    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama Aplikasi</label>
        <input type="text" class="form-control mb-3" name="nama" value="{{ $set->nama }}">

        <label>Deskripsi Sistem</label>
        <textarea class="form-control mb-3" name="deskripsi" rows="3">{{ $set->deskripsi }}</textarea>

        <label>Aturan Peminjaman</label>
        <textarea class="form-control mb-3" name="aturan" rows="4">{{ $set->aturan }}</textarea>

        <label>Batas Maksimal Peminjaman (jam)</label>
        <input type="number" class="form-control mb-3" name="max_waktu_pinjam" value="{{ $set->max_waktu_pinjam }}">

        <label>Kontak Admin (WhatsApp/Telp)</label>
        <input type="text" class="form-control mb-3" name="kontak_admin" value="{{ $set->kontak_admin }}">

        <label>Logo Aplikasi</label><br>

        <img src="{{ asset('uploads/logo/'.$set->logo) }}" height="60" class="mb-2">
        <input type="file" name="logo" class="form-control mb-3">

        <label>Status Sistem</label>
        <select class="form-control mb-3" name="maintenance">
            <option value="0" {{ $set->maintenance == 0 ? 'selected' : '' }}>Normal</option>
            <option value="1" {{ $set->maintenance == 1 ? 'selected' : '' }}>Maintenance</option>
        </select>

        <button class="btn btn-primary">Simpan</button>
    </form>

</div>

@endsection
