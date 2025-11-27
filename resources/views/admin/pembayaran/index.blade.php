@extends('layouts.admin')

@section('title', 'Pembayaran')

@section('content')

<h3 class="fw-bold mb-3">Data Pembayaran</h3>

<div class="card shadow p-3">
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Pemilik</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Bukti</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayaran as $b)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->peminjaman->peminjam->nama }}</td>
            <td>{{ $b->peminjaman->kendaraan->pemilik->nama }}</td>
            <td>Rp {{ number_format($b->jumlah,0,',','.') }}</td>
            <td><span class="badge bg-info">{{ $b->status }}</span></td>
            <td>
                @if($b->bukti)
                <a href="{{ asset('uploads/bukti/'.$b->bukti) }}" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                @else
                <span class="text-muted">Belum ada</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
