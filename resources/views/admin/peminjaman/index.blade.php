@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')

<h3 class="fw-bold mb-3">Data Peminjaman</h3>

<div class="card shadow p-3">
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Pemilik</th>
            <th>Kendaraan</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->peminjam->nama }}</td>
            <td>{{ $p->kendaraan->pemilik->nama }}</td>
            <td>{{ $p->kendaraan->tipe }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali ?? '-' }}</td>
            <td>
                <span class="badge bg-primary">{{ $p->status }}</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
