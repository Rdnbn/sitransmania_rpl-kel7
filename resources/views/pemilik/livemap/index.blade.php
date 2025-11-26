@extends('layouts.app')

@section('title', 'Live Location Kendaraan')

@section('content')

<h3 class="fw-bold mb-3">Live Location Kendaraan</h3>

@if($dipinjam->isEmpty())
    <p class="text-muted">Tidak ada kendaraan yang sedang dipinjam.</p>
@else
    @foreach($dipinjam as $item)
        <div class="card p-3 mb-3">
            <h5>{{ $item->kendaraan->tipe }} — {{ $item->kendaraan->plat_nomor }}</h5>

            <a href="{{ route('pemilik.livemap.view', $item->kendaraan->id_kendaraan) }}" 
               class="btn btn-primary mt-2">
                Lihat Live Map
            </a>
        </div>
    @endforeach
@endif

@endsection
