@extends('layouts.app')

@section('title', 'Warga Asrama')

@section('content')

<h3 class="fw-bold mb-3">Daftar Warga Asrama</h3>

{{-- FILTER --}}
<form method="GET" class="card p-3 shadow-sm mb-4">
    <div class="row">

        <div class="col-md-3">
            <label>Asrama</label>
            <select name="asrama" class="form-control">
                <option value="">Semua</option>
                <option value="Putra" {{ request('asrama') == 'Putra' ? 'selected' : '' }}>Putra</option>
                <option value="Putri" {{ request('asrama') == 'Putri' ? 'selected' : '' }}>Putri</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Prodi</label>
            <input type="text" name="prodi" class="form-control" value="{{ request('prodi') }}">
        </div>

        <div class="col-md-2">
            <label>Angkatan</label>
            <input type="number" name="angkatan" class="form-control" value="{{ request('angkatan') }}">
        </div>

        <div class="col-md-2">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="">Semua</option>
                <option value="pemilik" {{ request('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                <option value="peminjam" {{ request('role') == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
            </select>
        </div>

        <div class="col-md-2 text-end">
            <button class="btn btn-primary mt-4">Filter</button>
        </div>
    </div>
</form>

{{-- LIST WARGA --}}
<div class="row">
    @foreach($warga as $w)
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm p-3">
            <h5>{{ $w->nama }}</h5>
            <p class="text-muted m-0">{{ $w->prodi }} ({{ $w->angkatan }})</p>
            <p class="m-0">Asrama: <strong>{{ $w->asrama }}</strong></p>
            <p class="m-0">Role: <span class="badge bg-info">{{ $w->role }}</span></p>
        </div>
    </div>
    @endforeach
</div>

{{ $warga->links() }}

@endsection