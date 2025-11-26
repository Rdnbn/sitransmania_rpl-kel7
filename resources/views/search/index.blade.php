@extends('layouts.app')

@section('title', 'Pencarian')

@section('content')

<h3 class="fw-bold mb-3">Hasil Pencarian</h3>

<form class="mb-4">
    <input type="text" name="keyword" class="form-control"
           placeholder="Cari apa saja..."
           value="{{ $keyword }}">
</form>

@if(!$keyword)
    <p class="text-muted">Masukkan kata kunci untuk mulai mencari.</p>
@else

    <h5 class="fw-bold">Kendaraan</h5>
    @forelse($result['kendaraan'] ?? [] as $k)
        <div class="p-2 border rounded mb-2">{{ $k->tipe }} — {{ $k->plat_nomor }}</div>
    @empty
        <p class="text-muted">Tidak ditemukan.</p>
    @endforelse

    @if(auth()->user()->role === 'admin')
        <hr>
        <h5 class="fw-bold">Pengguna</h5>
        @forelse($result['users'] ?? [] as $u)
            <div class="p-2 border rounded mb-2">{{ $u->nama }} ({{ $u->email }})</div>
        @empty
            <p class="text-muted">Tidak ditemukan.</p>
        @endforelse

        <hr>
        <h5 class="fw-bold">Peminjaman</h5>
        @forelse($result['peminjaman'] ?? [] as $p)
            <div class="p-2 border rounded mb-2">
                {{ $p->peminjam->nama }} meminjam {{ $p->kendaraan->tipe }}
            </div>
        @empty
            <p class="text-muted">Tidak ditemukan.</p>
        @endforelse
    @endif

    @if(auth()->user()->role !== 'peminjam')
        <hr>
        <h5 class="fw-bold">Pembayaran</h5>
        @forelse($result['pembayaran'] ?? [] as $b)
            <div class="p-2 border rounded mb-2">
                Status: {{ $b->status }} — Peminjaman #{{ $b->id_peminjaman }}
            </div>
        @empty
            <p class="text-muted">Tidak ditemukan.</p>
        @endforelse
    @endif

@endif

@endsection
