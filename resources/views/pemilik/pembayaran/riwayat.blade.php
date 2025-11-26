@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')

<h3 class="fw-bold mb-4">Riwayat Pembayaran</h3>

<div class="card p-4 shadow">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Peminjaman</th>
                <th>Kendaraan</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($riwayat as $r)
            <tr>
                <td>#{{ $r->id_peminjaman }}</td>
                <td>{{ $r->peminjaman->kendaraan->tipe }}</td>

                <td>
                    @if($r->bukti)
                    <a href="{{ asset('uploads/pembayaran/'.$r->bukti) }}" target="_blank">
                       📄 Lihat
                    </a>
                    @endif
                </td>

                <td>
                    <span class="badge bg-{{ 
                        $r->status == 'dibayar' ? 'success' : 
                        ($r->status == 'menunggu_verifikasi' ? 'warning' : 'danger')
                    }}">
                        {{ $r->status }}
                    </span>
                </td>

                <td>
                    {{-- Flash & Error --}}
                    <x-flash />
                    <x-error />
                    <form action="{{ route('pemilik.pembayaran.verifikasi') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id_pembayaran" value="{{ $r->id_pembayaran }}">

                        <select name="status" class="form-select mb-2">
                            <option value="dibayar">Dibayar</option>
                            <option value="ditolak">Ditolak</option>
                        </select>

                        <button class="btn btn-sm btn-success">
                            Simpan
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

@endsection
