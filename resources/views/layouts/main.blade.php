<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | SITRANSMANIA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        .navbar-coffee {
            background: #5E4632;
        }
        .navbar-coffee .nav-link,
        .navbar-coffee .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        .hero {
            background: url('{{ asset("images/Asrama.jpg") }}') center/cover no-repeat;
            height: 85vh;
            position: relative;
            display: flex;
            align-items: center;
        }
        .hero::before {
            content:"";
            position:absolute;
            inset:0;
            background: rgba(60,40,25,0.50);
        }
        .hero > div {
            position:relative;
            z-index:2;
        }
    </style>
</head>

<body>

    {{-- Navbar Publik --}}
    <nav class="navbar navbar-expand-lg navbar-coffee fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SITRANSMANIA</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main style="margin-top:80px;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
