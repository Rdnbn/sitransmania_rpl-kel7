<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | SITRANSMANIA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        body {
            background: url('{{ asset("images/bg-asrama.jpg") }}') center/cover no-repeat fixed;
            min-height: 100vh;
            position: relative;
        }
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(60, 40, 25, 0.45);
            backdrop-filter: blur(2px);
        }
        .auth-wrap {
            position: relative;
            z-index: 3;
            max-width: 480px;
            width: 100%;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 35px 30px;
            box-shadow: 0 8px 26px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-wrap">

            <div class="text-center mb-3">
                <img src="{{ asset('images/logo-white.png') }}" width="180">
            </div>

            <div class="auth-card">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
