@extends('layouts.app')

@section('title', 'Laporan Keseluruhan')

@section('content')

<h3 class="fw-bold mb-3">Laporan Keseluruhan Sistem</h3>

{{-- FILTER --}}
<form method="GET" class="row mb-4">
    <div class="col-md-4">
        <label>Dari Tanggal</label>
        <input type="date" name="tanggal_mulai" value="{{ $mulai }}" class="form-control">
    </div>

    <div class="col-md-4">
        <label>Sampai Tanggal</label>
        <input type="date" name="tanggal_akhir" value="{{ $akhir }}" class="form-control">
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
</form>

{{-- STATISTIK --}}
<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card p-3 shadow text-center">
            <h4>{{ $stat['total_user'] }}</h4>
            <p>Total Pengguna</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card p-3 shadow text-center">
            <h4>{{ $stat['total_kendaraan'] }}</h4>
            <p>Total Kendaraan</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card p-3 shadow text-center">
            <h4>{{ $stat['total_peminjaman'] }}</h4>
            <p>Total Peminjaman</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card p-3 shadow text-center">
            <h4>{{ $stat['total_pembayaran'] }}</h4>
            <p>Total Pembayaran</p>
        </div>
    </div>

</div>

<hr>

{{-- TABEL PEMINJAMAN --}}
<h5 class="fw-bold mb-3">Detail Peminjaman</h5>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Peminjam</th>
            <th>Kendaraan</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($peminjaman as $p)
            <tr>
                <td>{{ $p->peminjam->nama }}</td>
                <td>{{ $p->kendaraan->tipe }} ({{ $p->kendaraan->plat_nomor }})</td>
                <td>{{ $p->created_at }}</td>
                <td>{{ $p->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada data.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
