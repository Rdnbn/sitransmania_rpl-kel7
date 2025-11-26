@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas')

@section('content')
<h3 class="fw-bold mb-3">Riwayat Aktivitas Sistem</h3>

<form method="GET" class="card p-3 shadow-sm mb-4">
    <div class="row">

        {{-- FILTER USER --}}
        <div class="col-md-4">
            <label>Pengguna</label>
            <select name="user" class="form-control">
                <option value="">Semua</option>
                @foreach($users as $u)
                    <option value="{{ $u->id_user }}" {{ request('user') == $u->id_user ? 'selected' : '' }}>
                        {{ $u->nama }} ({{ $u->role }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- FILTER AKSI --}}
        <div class="col-md-4">
            <label>Aksi</label>
            <select name="aksi" class="form-control">
                <option value="">Semua</option>
                @foreach($aksiList as $a)
                    <option value="{{ $a }}" {{ request('aksi') == $a ? 'selected' : '' }}>
                        {{ $a }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- FILTER TANGGAL --}}
        <div class="col-md-2">
            <label>Dari</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
        </div>

        <div class="col-md-2">
            <label>Sampai</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>

    </div>

    <div class="mt-3 text-end">
        <button class="btn btn-primary">Filter</button>
        <a href="{{ route('admin.riwayat') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

<div class="card shadow-sm p-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>User</th>
                <th>Aksi</th>
                <th>Deskripsi</th>
                <th>ID Peminjaman</th>
            </tr>
        </thead>

        <tbody>
            @forelse($riwayat as $r)
                <tr>
                    <td>{{ $r->created_at }}</td>
                    <td>{{ $r->user->nama }} ({{ $r->user->role }})</td>
                    <td>{{ $r->aksi }}</td>
                    <td>{{ $r->deskripsi }}</td>
                    <td>{{ $r->id_peminjaman ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada riwayat</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $riwayat->links() }}
</div>

@endsection
