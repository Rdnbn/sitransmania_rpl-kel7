@extends('layouts.peminjam')

@section('title', 'Detail Kendaraan')

@section('content')

<a href="{{ route('peminjam.kendaraan.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

<div class="card shadow p-4">

    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('uploads/kendaraan/' . $kendaraan->foto) }}"
                class="img-fluid rounded border">
        </div>

        <div class="col-md-7">

            <h3 class="fw-bold">{{ $kendaraan->merk }} ({{ $kendaraan->tipe }})</h3>

            <p class="mt-2"><b>Plat:</b> {{ $kendaraan->plat_nomor }}</p>
            <p><b>Harga Sewa:</b> Rp{{ number_format($kendaraan->harga_sewa) }}</p>
            <p><b>Status:</b> <span class="badge bg-info">{{ $kendaraan->status }}</span></p>

            <p class="mt-3"><b>Deskripsi:</b><br>{{ $kendaraan->deskripsi ?? '-' }}</p>

            <hr>

            {{-- INFO PEMILIK --}}
            <h5 class="fw-bold">Pemilik Kendaraan</h5>
            <p>{{ $kendaraan->pemilik->nama }}</p>
            <p>{{ $kendaraan->pemilik->no_telp }}</p>
            <p>Asrama: {{ $kendaraan->pemilik->asrama }} kamar {{ $kendaraan->pemilik->kamar }}</p>

            <hr>

            <div class="d-flex gap-2">
                <a href="{{ route('chat.room', $kendaraan->id_peminjaman ?? 0) }}"
                class="btn btn-success flex-fill">Hubungi Pemilik</a>
                <a href="{{ route('peminjam.pinjam.form', $kendaraan->id_kendaraan) }}"
                    class="btn btn-primary flex-fill">
                    Pinjam Sekarang
                    </a>

            </div>
        </div>
    </div>

</div>

@endsection
