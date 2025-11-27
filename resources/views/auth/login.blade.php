@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-card mx-auto">
    <h3 class="auth-title text-center">Login SITRANSMANIA</h3>
    <p class="auth-subtitle text-center">Masuk ke akun Anda untuk melanjutkan</p>

    {{-- Error --}}
    @if($errors->any())
        <div class="alert alert-danger text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                class="form-control auth-input"
                value="{{ old('email') }}"
                required 
                autofocus
            >
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                name="password" 
                id="password"
                class="form-control auth-input"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100 auth-btn">
            Login
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('showRegisterForm') }}" class="auth-link">
            Belum punya akun? Daftar
        </a>
    </div>
</div>
@endsection
