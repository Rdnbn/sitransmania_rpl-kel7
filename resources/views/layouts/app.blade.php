<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | SITRANSMANIA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        .navbar-app {
            background: #5E4632;
        }
        .navbar-app .nav-link,
        .navbar-app .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        .navbar-app .nav-link.active {
            color: #F0D8BA !important;
        }
    </style>
</head>

<body>

    {{-- Navbar khusus user yang sudah login --}}
    <nav class="navbar navbar-expand-lg navbar-app fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SITRANSMANIA</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navApp">
                <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
            </button>

            <div class="collapse navbar-collapse" id="navApp">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('kendaraan*') ? 'active' : '' }}" href="/kendaraan">Transportasi</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}" href="/riwayat">Riwayat</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('chat') ? 'active' : '' }}" href="/chat">Chat</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('notifikasi') ? 'active' : '' }}" href="/notifikasi">Notifikasi</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container" style="margin-top: 90px;">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @yield('scripts')

</body>
</html>
