@php
$user = auth()->user() ?? null;
@endphp

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3E2723;">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">SITRANSMANIA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @if(!$user)
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('showRegisterForm') }}">Register</a></li>
        @else
          @if($user->role === 'admin')
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
          @endif
          @if($user->role === 'pemilik')
            <li class="nav-item"><a class="nav-link" href="{{ route('pemilik.dashboard') }}">Dashboard Pemilik</a></li>
          @endif
          @if($user->role === 'peminjam')
            <li class="nav-item"><a class="nav-link" href="{{ route('peminjam.dashboard') }}">Dashboard Peminjam</a></li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        @endif
      </ul>
    </div>
  </div>
</nav>
