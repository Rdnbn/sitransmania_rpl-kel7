@extends('layouts.peminjam')

@section('title', 'Cari Kendaraan')

@section('content')

<h3 class="fw-bold mb-4">Cari Kendaraan</h3>

{{-- Flash & Error --}}
    <x-flash />
    <x-error />
    
{{-- FILTER --}}
<form method="GET" class="row g-2 mb-4">
    <div class="col-md-3">
        <input type="text" name="tipe" class="form-control" placeholder="Tipe Kendaraan (Motor / Sepeda)">
    </div>

    <div class="col-md-3">
        <input type="number" name="max_harga" class="form-control" placeholder="Harga Max (Rp)">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">Semua Status</option>
            <option value="tersedia">Tersedia</option>
            <option value="tidak tersedia">Tidak Tersedia</option>
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
</form>

{{-- LIST KENDARAAN --}}
<div class="row">

@forelse($kendaraan as $k)
<div class="col-md-4 mb-4">
    <div class="card shadow-sm">

        @if($k->foto)
            <img src="{{ asset('uploads/kendaraan/' . $k->foto) }}" class="card-img-top" style="height:180px; object-fit:cover;">
        @else
            <div class="bg-secondary text-white text-center p-4">Tidak Ada Foto</div>
        @endif

        <div class="card-body">
            <h5 class="fw-bold">{{ $k->merk }} ({{ $k->tipe }})</h5>
            <p class="mb-1">Plat: {{ $k->plat_nomor }}</p>
            <p class="mb-1">Harga: <b>Rp{{ number_format($k->harga_sewa) }}</b></p>

            <span class="badge bg-info">{{ ucfirst($k->status) }}</span>

            <hr>

            <a href="{{ route('peminjam.kendaraan.show', $k->id_kendaraan) }}"
                class="btn btn-primary w-100">Detail</a>
        </div>

    </div>
</div>

@empty
<p class="text-center">Tidak ada kendaraan ditemukan.</p>
@endforelse

</div>

@endsection
