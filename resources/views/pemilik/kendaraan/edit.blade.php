@extends('layouts.pemilik')

@section('title', 'Ubah Status Kendaraan')

@section('content')

<h3 class="fw-bold mb-3">Ubah Status Kendaraan</h3>

<div class="card shadow-sm p-4">
{{-- Flash & Error --}}
    <x-flash />
    <x-error />
    <form action="{{ route('pemilik.kendaraan.update', $kendaraan->id_kendaraan) }}" method="POST">
        @csrf

        <h5>{{ $kendaraan->tipe }} — {{ $kendaraan->plat_nomor }}</h5>

        {{-- STATUS --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="tersedia" {{ $kendaraan->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ $kendaraan->status == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                <option value="tidak aktif" {{ $kendaraan->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        {{-- TANGGAL TERSEDIA --}}
        <div class="mb-3">
            <label>Tanggal & Waktu Tersedia</label>
            <input type="datetime-local" name="tanggal_tersedia" 
                   value="{{ $kendaraan->tanggal_tersedia }}" 
                   class="form-control">
        </div>

        {{-- KETERANGAN --}}
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"
                placeholder="Contoh: servis, ban bocor">{{ $kendaraan->keterangan }}</textarea>
        </div>

        <button class="btn btn-success">Simpan Perubahan</button>
    </form>

</div>

@endsection
