@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

<h3 class="fw-bold mb-3">Kelola Data Pengguna</h3>

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Tambah Pengguna</a>

<div class="card shadow p-3">
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>No Telp</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $u->nama }}</td>
            <td>{{ $u->username }}</td>
            <td><span class="badge bg-info">{{ $u->role }}</span></td>
            <td>{{ $u->no_telp }}</td>
            <td>
                <a href="{{ route('users.edit', $u->id_user) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('users.destroy', $u->id_user) }}" 
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus pengguna?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection
