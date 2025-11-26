@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="auth-card">

    <h3 class="text-center auth-title">Login SITRANSMANIA</h3>
    <p class="text-center auth-subtitle">Masuk ke akun Anda untuk melanjutkan</p>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" 
               name="email" 
               class="form-control auth-input"
               value="{{ old('email') }}" 
               required autofocus>
    </div>

    <div class="mb-4">
        <label class="form-label">Password</label>
        <input type="password" 
               name="password" 
               class="form-control auth-input"
               required>
    </div>

    <button class="btn btn-primary w-100 auth-btn">Login</button>

    <div class="text-center mt-3">
        <a class="auth-link" href="{{ route('showRegisterForm') }}">
            Belum punya akun? Daftar
        </a>
    </div>

</form>
</div>

@endsection
