@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<h3 class="fw-bold mb-4">Dashboard Admin</h3>

{{-- STATISTIK --}}
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
            <h5>Total Pemilik</h5>
            <h2>{{ $totalPemilik }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
            <h5>Total Peminjam</h5>
            <h2>{{ $totalPeminjam }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
            <h5>Total Kendaraan</h5>
            <h2>{{ $totalKendaraan }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center">
            <h5>Total Peminjaman</h5>
            <h2>{{ $totalPeminjaman }}</h2>
        </div>
    </div>
</div>

{{-- STATUS PEMINJAMAN --}}
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm p-3 text-center bg-info text-white">
            <h5>Peminjaman Aktif</h5>
            <h2>{{ $aktif }}</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm p-3 text-center bg-success text-white">
            <h5>Peminjaman Selesai</h5>
            <h2>{{ $selesai }}</h2>
        </div>
    </div>
</div>

{{-- GRAFIK --}}
<div class="card shadow-sm p-4 mb-4">
    <h5 class="mb-3">Grafik Peminjaman Tahun {{ date('Y') }}</h5>
    <canvas id="chartPeminjaman"></canvas>
</div>

{{-- AKTIVITAS TERBARU --}}
<div class="card shadow-sm p-3">
    <h5 class="mb-3">Aktivitas Terbaru</h5>

    <ul class="list-group">
        @forelse($recent as $r)
            <li class="list-group-item">
                <strong>{{ $r->user->nama }}</strong> — {{ $r->aksi }}  
                <div class="text-muted small">{{ $r->created_at }}</div>
            </li>
        @empty
            <li class="list-group-item text-muted">Belum ada aktivitas.</li>
        @endforelse
    </ul>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartPeminjaman');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($chart->toArray())) !!},
        datasets: [{
            label: 'Total peminjaman',
            data: {!! json_encode(array_values($chart->toArray())) !!},
            borderWidth: 1
        }]
    }
});
</script>
@endsection