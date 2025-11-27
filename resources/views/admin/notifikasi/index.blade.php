@extends('layouts.app')

@section('title', 'Notifikasi Sistem')

@section('content')

<h3 class="fw-bold mb-3">Notifikasi Sistem</h3>

<div class="card shadow p-3">
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Judul</th>
            <th>Pesan</th>
            <th>Waktu</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notifikasi as $n)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $n->user->nama }}</td>
            <td>{{ $n->judul }}</td>
            <td>{{ $n->pesan }}</td>
            <td>{{ $n->created_at }}</td>
            <td>
                @if($n->is_read)
                    <span class="badge bg-success">Dibaca</span>
                @else
                    <span class="badge bg-danger">Belum Dibaca</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
