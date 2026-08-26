<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Peminjam Alat</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuUtama">
            {{-- Menu Utama Kiri --}}
            <ul class="navbar-nav me-auto">
                @can('kategori.kelola')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a>
                    </li>
                @endcan

                @can('alat.kelola')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alat.index') }}">Alat</a>
                    </li>
                @endcan

                @can('user.kelola')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengguna.index') }}">Pengguna</a>
                    </li>
                @endcan

                @can('peminjaman.setujui')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('persetujuan.antrian') }}">Persetujuan</a>
                    </li>
                @endcan

                @can('pengembalian.pantau')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengembalian.pantau') }}">Pemantauan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengembalian.antrian') }}">Verifikasi</a>
                    </li>
                @endcan

                @can('log.lihat')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log.index') }}">Log Aktivitas</a>
                    </li>
                @endcan

                @can('alat.lihat')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('katalog.daftar') }}">Katalog Alat</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1" href="{{ route('katalog.keranjang') }}">
                            <span>Keranjang</span>
                            @if (count(session('keranjang', [])) > 0)
                                <span class="badge rounded-pill bg-warning text-dark">
                                    {{ count(session('keranjang', [])) }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman.saya') }}">Pinjaman Saya</a>
                    </li>
                @endcan

                @can('laporan.cetak')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('laporan.form') }}">Laporan</a>
                    </li>
                @endcan


            </ul>

            {{-- Menu Auth / Kanan (Nama User + Tombol Keluar) --}}
            @auth
                <div class="d-flex align-items-center gap-3">
                    <span class="navbar-text text-light">
                        {{ auth()->user()->nama }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Keluar</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
