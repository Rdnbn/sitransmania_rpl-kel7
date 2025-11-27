@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<h3 class="page-title mb-4">Dashboard Admin</h3>

{{-- ======================== STATISTIK ======================== --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card card shadow-sm">
            <h6 class="stat-label">Total Pemilik</h6>
            <h2 class="stat-value">{{ $totalPemilik ?? '-' }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card card shadow-sm">
            <h6 class="stat-label">Total Peminjam</h6>
            <h2 class="stat-value">{{ $totalPeminjam ?? '-' }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card card shadow-sm">
            <h6 class="stat-label">Total Kendaraan</h6>
            <h2 class="stat-value">{{ $totalKendaraan ?? '-' }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card card shadow-sm">
            <h6 class="stat-label">Total Peminjaman</h6>
            <h2 class="stat-value">{{ $totalPeminjaman ?? '-' }}</h2>
        </div>
    </div>
</div>

{{-- ======================== STATUS PEMINJAMAN ======================== --}}
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="status-card card shadow-sm bg-info text-white text-center p-4">
            <h6 class="status-label">Peminjaman Aktif</h6>
            <h2 class="status-value">{{ $aktif ?? '-' }}</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="status-card card shadow-sm bg-success text-white text-center p-4">
            <h6 class="status-label">Peminjaman Selesai</h6>
            <h2 class="status-value">{{ $selesai ?? '-' }}</h2>
        </div>
    </div>
</div>

{{-- ======================== GRAFIK ======================== --}}
<div class="card shadow-sm p-4 mb-4">
    <h5 class="mb-3">Grafik Peminjaman Tahun {{ date('Y') }}</h5>
    <canvas id="chartPeminjaman"></canvas>
</div>

{{-- ======================== AKTIVITAS TERBARU ======================== --}}
<div class="card shadow-sm p-3">
    <h5 class="mb-3">Aktivitas Terbaru</h5>

    <ul class="list-group">
        @forelse ($recent ?? [] as $r)
            <li class="list-group-item">
               <strong>{{ $r->peminjam?->nama ?? 'Tidak diketahui' }}</strong> — {{ $r->aktivitas ?? '-' }}
                <div class="text-muted small">{{ $r->tanggal }}</div>
            </li>
        @empty
            <li class="list-group-item text-muted">Belum ada aktivitas.</li>
        @endforelse
    </ul>
</div>

@endsection

{{-- ======================== SCRIPTS ======================== --}}
@section('scripts')

@php
    $chartData = isset($chart) ? $chart->toArray() : [];
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartPeminjaman');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($chartData)) !!},
            datasets: [{
                label: 'Total Peminjaman',
                data: {!! json_encode(array_values($chartData)) !!},
                borderWidth: 1
            }]
        }
    });
</script>

@endsection
