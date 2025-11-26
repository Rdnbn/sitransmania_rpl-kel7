<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand" href="{{ route('pemilik.dashboard') }}">
            SITRANSMANIA Pemilik
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#pemilikNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="pemilikNav">
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.dashboard') }}">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kendaraan.index') }}">Kendaraan Saya</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.aktivitas.index') }}">Aktivitas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.peminjam.index') }}">Peminjam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemilik.chat.index') }}">Chat</a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-light ms-3">Logout</button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
