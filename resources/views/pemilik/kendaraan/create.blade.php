@extends('layouts.pemilik')

@section('title', 'Tambah Kendaraan')

@section('content')

<h3 class="fw-bold mb-4">Tambah Kendaraan</h3>
{{-- Flash & Error --}}
    <x-flash />
    <x-error />
<form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Tipe Kendaraan</label>
        <input type="text" name="tipe" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Merk</label>
        <input type="text" name="merk" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Plat Nomor</label>
        <input type="text" name="plat_nomor" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Harga Sewa (Rp)</label>
        <input type="number" name="harga_sewa" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="tersedia">Tersedia</option>
            <option value="tidak tersedia">Tidak Tersedia</option>
            <option value="tidak aktif">Tidak Aktif</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Kendaraan</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
