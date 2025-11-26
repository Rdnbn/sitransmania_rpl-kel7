<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">

        <a class="navbar-brand" href="{{ route('peminjam.dashboard') }}">
            SITRANSMANIA Peminjam
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#peminjamNav">
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

        <div class="collapse navbar-collapse" id="peminjamNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peminjam.dashboard') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peminjam.browse.index') }}">Cari Kendaraan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peminjam.peminjaman.index') }}">Peminjaman Saya</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peminjam.chat.index') }}">Chat</a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-light ms-3">Logout</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.akun') }}">Pengaturan</a>   
                </li>
            </ul>
        </div>

    </div>
</nav>