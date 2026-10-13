<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMPN 1 Mangunreja') - SMPN 1 Mangunreja</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        html { scroll-behavior: smooth; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f8fafc; color: #1f2937; display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        .warna-utama { color: #15803d; }
        .tombol-utama { background: #15803d; color: #fff; border: 1px solid #15803d; transition: .2s; }
        .tombol-utama:hover { background: #166534; color: #fff; border-color: #166534; }
        .menu-aktif { color: #15803d !important; font-weight: 700; }
        .navbar-brand img { width: 40px; height: 40px; object-fit: contain; }
        .school-footer { background: #0B2319; color: #cbd5e1; }
        .school-footer a { color: #a7f3d0; text-decoration: none; }
        .school-footer a:hover { color: #fff; }
        @media (max-width: 991.98px) {
            .navbar-nav { padding-top: .75rem; }
            .navbar-nav .nav-link { padding: .6rem 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo.smp.png') }}" alt="Logo Sekolah" onerror="this.src='https://via.placeholder.com/40'">
                <span class="fw-bold" style="color:#0B2319">
                    {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSekolah" aria-controls="navbarSekolah" aria-expanded="false" aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSekolah">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a href="{{ route('landing') }}" class="nav-link {{ request()->routeIs('landing') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profil') }}" class="nav-link {{ request()->routeIs('profil*') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru') }}" class="nav-link {{ request()->routeIs('guru*') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Guru</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ekstrakurikuler') }}" class="nav-link {{ request()->routeIs('ekstrakurikuler*') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita*') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('galeri') }}" class="nav-link {{ request()->routeIs('galeri*') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ujikom') }}" class="nav-link {{ request()->routeIs('ujikom*') ? 'menu-aktif' : 'fw-medium text-secondary' }}">Ujikom</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn tombol-utama fw-semibold px-4 py-2 rounded-3">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ================= ISI HALAMAN (CONTENT) ================= -->
    <main>
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="school-footer pt-5 pb-4 border-top mt-auto">
        <div class="container">
            <div class="row pb-4 border-bottom border-success">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('images/logo.smp.png') }}" alt="Logo SMPN 1 Mangunreja" width="48" height="48" class="object-fit-contain" onerror="this.src='https://via.placeholder.com/48'">
                        <div>
                            <h2 class="text-white fw-bold fs-5 mb-1">SMPN 1 Mangunreja</h2>
                            <p class="small text-success mb-0">Unggul, Berkarakter, dan Berprestasi</p>
                        </div>
                    </div>
                    <div class="small d-grid gap-3">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fa-solid fa-location-dot text-success mt-1"></i>
                            <p class="mb-0">{{ $profil->alamat ?? 'Jl. Kalapasewu / Jl. Kaum Selatan No. 217, Mangunreja, Kabupaten Tasikmalaya, Jawa Barat 46462' }}</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fa-solid fa-phone text-success"></i>
                            <p class="mb-0">{{ $profil->telepon ?? '(0265) 546717 / 0897654212345' }}</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="fa-solid fa-envelope text-success"></i>
                            <p class="mb-0">{{ $profil->email ?? 'smpn1mangunreja@sch.id' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 pt-4 small text-secondary">
                <p class="mb-0">&copy; {{ date('Y') }} SMPN 1 Mangunreja. Seluruh Hak Cipta Dilindungi.</p>
                <span>Membangun Generasi Cerdas &amp; Berakhlak Mulia</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>