@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm"
                 style="background: linear-gradient(135deg, #473821bc 0%, #855d3ad1 100%); border-radius: 15px;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center gap-3 text-white">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-speedometer2" style="font-size: 2rem;"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Dashboard Admin</h2>
                            <p class="mb-0 opacity-75">Ringkasan statistik sistem peminjaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card stat-card shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-people-fill text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-1">Total Pemilik</p>
                    <h3 class="fw-bold mb-0" style="color: #667eea;">{{ $totalPemilik ?? '-' }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-badge-fill text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-1">Total Peminjam</p>
                    <h3 class="fw-bold mb-0" style="color: #43e97b;">{{ $totalPeminjam ?? '-' }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-truck text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-1">Total Kendaraan</p>
                    <h3 class="fw-bold mb-0" style="color: #f093fb;">{{ $totalKendaraan ?? '-' }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-journal-check text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <p class="text-muted small mb-1">Total Peminjaman</p>
                    <h3 class="fw-bold mb-0" style="color: #fa709a;">{{ $totalPeminjaman ?? '-' }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="card shadow-sm p-4 mb-4">
        <h5 class="mb-3">Grafik Peminjaman Tahun {{ date('Y') }}</h5>
        <canvas id="chartPeminjaman" height="200"></canvas>
    </div>

    {{-- Aktivitas Terbaru --}}
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

</div>

<style>
    /* Semua card punya transisi smooth */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        border-radius: 15px;
    }

    /* Hover effect untuk semua card */
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    /* Hover khusus untuk statistik card, lebih "angkat" */
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* Kontrol padding dan tinggi card statistik agar compact */
    .stat-card .card-body {
        padding: 0.75rem 1rem;
        min-height: 25px; /* sesuaikan jika terlalu tinggi/rendah */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Ikon di statistik card */
    .stat-card .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
    #chartPeminjaman {
    height: 200px !important; /* sesuai height canvas */
}


</style>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPeminjaman');
    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($chartData ?? [])) !!},
        datasets: [{
            label: 'Total Peminjaman',
            data: {!! json_encode(array_values($chartData ?? [])) !!},
            backgroundColor: '#667eea',
            borderRadius: 5,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // biar canvas bisa sesuai height yang kita atur
        scales: { y: { beginAtZero: true } }
    }
});

</script>
@endsection
