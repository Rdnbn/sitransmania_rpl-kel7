@extends('layouts.pemilik')

@section('title', 'Kendaraan Saya')

@section('content')

<h3 class="fw-bold mb-3">Kendaraan Saya</h3>

<div class="row">

@foreach($kendaraan as $k)
<div class="col-md-4 mb-3">
    <div class="card shadow-sm p-3">
        
        <img src="{{ asset('uploads/kendaraan/'.$k->foto) }}" 
             class="img-fluid rounded mb-2" style="height: 180px; object-fit:cover;">

        <h5>{{ $k->tipe }} — {{ $k->plat_nomor }}</h5>

        <p class="m-0">Status: 
            <span class="badge 
                @if($k->status=='tersedia') bg-success 
                @elseif($k->status=='tidak tersedia') bg-warning
                @else bg-danger @endif">
                {{ ucfirst($k->status) }}
            </span>
        </p>

        @if($k->tanggal_tersedia)
        <p class="text-muted small m-0">Tersedia mulai: {{ $k->tanggal_tersedia }}</p>
        @endif

        <a href="{{ route('pemilik.kendaraan.edit', $k->id_kendaraan) }}"
           class="btn btn-primary mt-3">Ubah Status</a>

    </div>
</div>
@endforeach

</div>

@endsection
