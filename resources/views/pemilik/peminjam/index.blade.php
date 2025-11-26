@extends('layouts.pemilik')

@section('title', 'Kelola Peminjaman')

@section('content')

<h3 class="fw-bold mb-4">Kelola Peminjaman Kendaraan</h3>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Kendaraan</th>
            <th>Peminjam</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($peminjaman as $p)
        <tr>
            <td>{{ $p->kendaraan->merk }} ({{ $p->kendaraan->plat_nomor }})</td>
            <td>{{ $p->nama }}<br>{{ $p->no_telp }}</td>
            <td>{{ $p->tanggal_pinjam }} {{ $p->waktu_pinjam }}</td>

            <td>
                <span class="badge bg-info">{{ ucfirst($p->status) }}</span>
            </td>

            <td>
                @if($p->pembayaran)
                    <a href="{{ asset('uploads/bukti/' . $p->pembayaran->bukti) }}" target="_blank" class="btn btn-sm btn-secondary">Lihat Bukti</a>
                @else
                    <span class="text-danger">Belum bayar</span>
                @endif
            </td>

            <td>
            
            {{-- Flash & Error --}}
            <x-flash />
            <x-error />

                {{-- SETUJUI --}}
                @if($p->status == 'menunggu')
                    <form action="{{ route('pemilik.peminjaman.setujui', $p->id_peminjaman) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Setujui</button>
                    </form>

                    <form action="{{ route('pemilik.peminjaman.tolak', $p->id_peminjaman) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                @endif

                {{-- VERIFIKASI PEMBAYARAN --}}
                @if($p->status == 'disetujui' && $p->pembayaran && $p->pembayaran->status == 'DP')
                    <form action="{{ route('pemilik.peminjaman.verifikasi', $p->id_peminjaman) }}" method="POST" class="d-inline mt-1">
                        @csrf
                        <button class="btn btn-warning btn-sm">Verifikasi Pembayaran</button>
                    </form>
                @endif

                {{-- UPDATE STATUS PENGGUNAAN --}}
                @if($p->status == 'dibayar')
                    <form action="{{ route('pemilik.peminjaman.updateStatus', $p->id_peminjaman) }}" method="POST" class="d-inline mt-1">
                        @csrf
                        <input type="hidden" name="status" value="dipinjam">
                        <button class="btn btn-primary btn-sm">Mulai Pinjam</button>
                    </form>
                @endif

                {{-- SELESAI --}}
                @if($p->status == 'dipinjam')
                    <form action="{{ route('pemilik.peminjaman.updateStatus', $p->id_peminjaman) }}" method="POST" class="d-inline mt-1">
                        @csrf
                        <input type="hidden" name="status" value="selesai">
                        <button class="btn btn-dark btn-sm">Selesai</button>
                    </form>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
