<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        {{-- BRAND / LOGO --}}
        <a class="navbar-brand" href="{{ route('pemilik.dashboard') }}">
            SITRANSMANIA Pemilik
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#pemilikNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- SEARCH BAR --}}
        <form action="{{ route('search') }}" class="d-flex ms-3">
            <input type="text" name="keyword" class="form-control"
                placeholder="Search..." style="max-width: 200px;">
        </form>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
            <button type="submit">Logout</button>
        </form>


        {{-- NAVIGATION MENU --}}
        <div class="collapse navbar-collapse" id="pemilikNav">
            <ul class="navbar-nav ms-auto">

                {{-- BERANDA --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.dashboard') }}">Beranda</a>
                </li>

                {{-- KENDARAAN --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.kendaraan.index') }}">
                        Kendaraan Saya
                    </a>
                </li>

                {{-- PEMINJAMAN / TRANSAKSI --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.peminjaman.index') }}">
                        Transaksi Peminjaman
                    </a>
                </li>

                {{-- CHAT --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.chat.index') }}">
                        Chat
                    </a>
                </li>

                {{-- RIWAYAT --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.riwayat') }}">
                        Riwayat Aktivitas
                    </a>
                </li>

                {{-- LOGOUT --}}
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
