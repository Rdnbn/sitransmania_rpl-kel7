<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | SITRANSMANIA</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body>

    @yield('content')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
    <style>
    body {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .auth-card {
        width: 420px;
        background: #ffffffdd;
        backdrop-filter: blur(10px);
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .auth-title {
        font-weight: 700;
        margin-bottom: 15px;
        color: #343a40;
    }

    .auth-subtitle {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 25px;
    }

    .auth-input {
        border-radius: 12px;
        padding: 10px 14px;
    }

    .auth-btn {
        border-radius: 12px;
        padding: 10px;
        font-size: 16px;
        font-weight: 600;
    }

    a.auth-link {
        font-size: 14px;
        color: #0d6efd;
        text-decoration: none;
    }
    a.auth-link:hover {
        text-decoration: underline;
    }
</style>


</body>
</html>
