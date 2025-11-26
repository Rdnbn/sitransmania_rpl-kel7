@extends('layouts.pemilik')

@section('title', 'Riwayat Aktivitas')

@section('content')
<h3 class="fw-bold mb-3">Riwayat Aktivitas Anda</h3>

{{-- Flash & Error --}}
    <x-flash />
    <x-error />
    
<form method="GET" class="card p-3 shadow-sm mb-4">
    <div class="row">

        {{-- FILTER AKSI --}}
        <div class="col-md-6">
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
        <div class="col-md-3">
            <label>Dari</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
        </div>

        <div class="col-md-3">
            <label>Sampai</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>

    </div>

    <div class="text-end mt-3">
        <button class="btn btn-primary">Filter</button>
        <a href="{{ route('pemilik.riwayat') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

<div class="card shadow-sm p-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Aksi</th>
                <th>Deskripsi</th>
                <th>ID Peminjaman</th>
            </tr>
        </thead>

        <tbody>
            @forelse($riwayat as $r)
                <tr>
                    <td>{{ $r->created_at }}</td>
                    <td>{{ $r->aksi }}</td>
                    <td>{{ $r->deskripsi }}</td>
                    <td>{{ $r->id_peminjaman ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Tidak ada riwayat</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $riwayat->links() }}
</div>

@endsection
