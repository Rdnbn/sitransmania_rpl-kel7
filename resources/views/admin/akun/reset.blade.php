@extends('layouts.app')

@section('title', 'Reset Password Pengguna')

@section('content')

<h3 class="fw-bold mb-3">Reset Password Pengguna</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-4 shadow">

    <form action="{{ route('admin.reset.do') }}" method="POST">
        @csrf

        <label class="fw-bold">Pilih Pengguna</label>
        <select name="id_user" class="form-control mb-3" required>
            <option value="">— Pilih —</option>

            @foreach($users as $u)
                <option value="{{ $u->id_user }}">
                    {{ $u->nama }} — ({{ $u->role }})
                </option>
            @endforeach
        </select>

        <p class="text-muted">
            Password baru akan diset ke: <b>sitrans123</b>
        </p>

        <button class="btn btn-warning">Reset Password</button>
    </form>

</div>

@endsection
