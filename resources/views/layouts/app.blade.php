<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - SMPN 1 Mangunreja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">

    <div class="min-h-screen flex">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-[#051911] text-white min-h-screen p-4 flex flex-col relative z-50">
            <div class="flex items-center gap-3 px-2 py-3 mb-6">
                <div class="w-10 h-10 bg-[#10b981] rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-900/50">
                    <i class="fa-solid fa-graduation-cap text-lg"></i>
                </div>
                <div>
                    <h1 class="font-bold text-white leading-tight">SMPN 1</h1>
                    <h2 class="font-bold text-white leading-tight">Mangunreja</h2>
                </div>
            </div>

            <p class="text-[11px] font-bold text-emerald-500 uppercase tracking-wider px-3 mb-3">MENU</p>

            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-house text-emerald-400 text-base w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.profil-sekolah') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.profil.*') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-building-columns text-emerald-400 text-base w-5 text-center"></i>
                    <span>Profil Sekolah</span>
                </a>

                <a href="{{ route('admin.guru.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.guru.*') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-chalkboard-user text-emerald-400 text-base w-5 text-center"></i>
                    <span>Guru</span>
                </a>

                <a href="{{ route('admin.siswa.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.siswa.*') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-user-graduate text-emerald-400 text-base w-5 text-center"></i>
                    <span>Siswa</span>
                </a>

                <a href="{{ route('admin.berita.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.berita.*') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-newspaper text-emerald-400 text-base w-5 text-center"></i>
                    <span>Berita</span>
                </a>

                <a href="{{ route('admin.ekstrakurikuler.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-trophy text-emerald-400 text-base w-5 text-center"></i>
                    <span>Ekstrakurikuler</span>
                </a>

                <a href="{{ route('admin.galeri.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.galeri.*') ? 'bg-[#0e2a1f] text-white font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                    <i class="fa-solid fa-images text-emerald-400 text-base w-5 text-center"></i>
                    <span>Galeri</span>
                </a>

                @if(auth()->check() && strtolower(auth()->user()->role ?? '') === 'admin')
                    <a href="{{ route('admin.user.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.user.*') ? 'bg-[#0e2a1f] text-emerald-400 font-semibold' : 'text-slate-200 hover:bg-[#0e2a1f]/60 hover:text-white' }}">
                        <i class="fa-solid fa-users text-emerald-400 text-base w-5 text-center"></i>
                        <span>Pengelola User</span>
                    </a>
                @endif
            </nav>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="bg-white border-b border-slate-200 h-16 px-6 flex items-center justify-between">
                <span class="text-slate-400 text-sm">Aplikasi Sistem Informasi Sekolah</span>
                
                <div class="flex items-center gap-4">
                    {{-- Tombol Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-700 font-medium bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 bg-slate-100">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>