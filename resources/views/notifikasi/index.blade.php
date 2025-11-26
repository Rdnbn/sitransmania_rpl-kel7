@extends('layouts.app')

@section('title','Semua Notifikasi')

@section('content')

<h3 class="fw-bold mb-3">Semua Notifikasi</h3>

<div class="card p-3 shadow">

@foreach($notifikasi as $n)
    <div class="border-bottom py-2">
        <strong>{{ $n->judul }}</strong>
        <p class="mb-1">{{ $n->pesan }}</p>
        <small class="text-muted">{{ $n->created_at }}</small>
    </div>
@endforeach

</div>

@endsection
