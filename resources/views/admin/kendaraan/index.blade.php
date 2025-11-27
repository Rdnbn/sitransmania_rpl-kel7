@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')

<h3 class="fw-bold mb-3">Data Kendaraan</h3>

<div class="card shadow p-3">
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Pemilik</th>
            <th>Tipe Kendaraan</th>
            <th>Plat</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kendaraan as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $k->pemilik->nama }}</td>
            <td>{{ $k->tipe }}</td>
            <td>{{ $k->plat }}</td>
            <td>
                <span class="badge 
                    @if($k->status=='tersedia') bg-success
                    @elseif($k->status=='dipinjam') bg-warning
                    @else bg-secondary
                    @endif">
                    {{ $k->status }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
