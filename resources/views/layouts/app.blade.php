<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - SMPN 1 Mangunreja</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --school-dark: #051911; --school-green: #10b981; --school-hover: #0e2a1f; }
        body { background: #f1f5f9; color: #1e293b; font-family: 'Inter', sans-serif; }
        .admin-sidebar { position: fixed; inset: 0 auto 0 0; z-index: 1030; width: 260px; overflow-y: auto; background: var(--school-dark); color: #fff; padding: 1rem; }
        .admin-main { min-height: 100vh; margin-left: 260px; display: flex; flex-direction: column; min-width: 0; }
        .admin-header { min-height: 64px; background: #fff; border-bottom: 1px solid #e2e8f0; }
        .admin-content { flex: 1; padding: 1.5rem; min-width: 0; }
        .school-logo-icon { width: 42px; height: 42px; flex: 0 0 42px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; background: var(--school-green); }
        .admin-menu-label { padding: .25rem .75rem; margin: .5rem 0 .75rem; color: #10b981; font-size: .7rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .admin-nav-link { display: flex; align-items: center; gap: .8rem; padding: .7rem .85rem; margin-bottom: .25rem; border-radius: .75rem; color: #e2e8f0; text-decoration: none; font-size: .9rem; font-weight: 500; transition: background .2s, color .2s; }
        .admin-nav-link i { width: 20px; text-align: center; color: #34d399; }
        .admin-nav-link:hover, .admin-nav-link.active { background: var(--school-hover); color: #fff; }
        .admin-nav-link.active { font-weight: 700; }
        @media (max-width: 767.98px) {
            .admin-sidebar { position: static; width: 100%; max-height: none; }
            .admin-main { margin-left: 0; }
            .admin-content { padding: 1rem; }
            .admin-nav { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .25rem; }
            .admin-nav-link { margin: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid p-0">
        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="d-flex align-items-center gap-3 px-2 py-3 mb-4">
                <div class="school-logo-icon text-white shadow">
                    <i class="fa-solid fa-graduation-cap fs-5"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="fs-6 fw-bold lh-sm mb-0 text-white">
                        {{ \App\Models\ProfilSekolah::first()?->nama_sekolah ?? 'SMPN 1 Mangunreja' }}
                    </h1>
                </div>
            </div>

            <p class="admin-menu-label">Menu</p>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.profil-sekolah.index') }}" class="admin-nav-link {{ request()->routeIs('admin.profil-sekolah*') ? 'active' : '' }}">
                    <i class="fa-solid fa-building-columns"></i><span>Profil Sekolah</span>
                </a>
                <a href="{{ route('admin.guru.index') }}" class="admin-nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-chalkboard-user"></i><span>Guru</span>
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="admin-nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-graduate"></i><span>Siswa</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="admin-nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i><span>Berita</span>
                </a>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="admin-nav-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-trophy"></i><span>Ekstrakurikuler</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="admin-nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i><span>Galeri</span>
                </a>
                @if(auth()->check() && strtolower(auth()->user()->role ?? '') === 'admin')
                    <a href="{{ route('admin.user.index') }}" class="admin-nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i><span>Pengelola User</span>
                    </a>
                @endif
            </nav>
        </aside>

        <!-- AREA KONTEN UTAMA -->
        <div class="admin-main">
            <header class="admin-header d-flex align-items-center justify-content-between px-3 px-md-4 py-3">
                <span class="small text-secondary">Aplikasi Sistem Informasi Sekolah</span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                    </button>
                </form>
            </header>

            <main class="admin-content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
