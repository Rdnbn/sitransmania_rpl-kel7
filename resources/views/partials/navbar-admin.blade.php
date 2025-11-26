<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            SITRANSMANIA Admin
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <form action="{{ route('search') }}" class="d-flex ms-3">
                    <input type="text" name="keyword" class="form-control"
                    placeholder="Search..." style="max-width: 200px;">
        </form>

        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
        </form>

        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Akun Pengguna</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.peminjaman.index') }}">Peminjaman</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pembayaran.index') }}">Pembayaran</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger ms-3">Logout</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.akun') }}">Pengaturan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reset.index') }}">Reset Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pengaturan') }}">Pengaturan Sistem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.laporan') }}">Laporan</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
