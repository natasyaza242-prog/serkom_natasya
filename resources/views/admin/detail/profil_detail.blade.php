<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil - {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="bg-slate-50 text-slate-800 font-sans">

    <!-- Header / Navbar Sederhana dengan Tombol Kembali -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
            <span class="font-bold text-slate-700 hidden sm:inline">{{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</span>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="max-w-5xl mx-auto px-4 py-10">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-10" data-aos="fade-up">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-800">Profil Lengkap Sekolah</h1>
            <p class="text-slate-500 mt-2">Mengenal lebih dekat {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</p>
            <div class="w-16 h-1 bg-blue-600 mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- 1. Detail Kepala Sekolah & Sambutan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                <div class="w-48 flex-shrink-0 text-center">
                    <div class="w-40 h-40 rounded-2xl overflow-hidden shadow-md mx-auto mb-3 border-2 border-blue-100 bg-slate-100">
                        <img src="{{ !empty($profil->foto_kepala) ? asset('storage/' . $profil->foto_kepala) : asset('images/kepala-sekolah.png') }}" 
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($profil->kepala_sekolah ?? 'Kepala Sekolah') }}&background=0D8ABC&color=fff';" 
                             alt="Kepala Sekolah" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-bold text-slate-800 text-base">{{ $profil->kepala_sekolah ?? 'Dendin Wirdina, S.Pd., M.M.' }}</h3>
                    <p class="text-xs font-semibold text-blue-600 mt-0.5">Kepala Sekolah</p>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-slate-800 mb-3 border-b pb-2">Sambutan Kepala Sekolah</h2>
                    <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3">
                        <p>Assalamu’alaikum Warahmatullahi Wabarakatuh,</p>
                        <p>
                            {{ $profil->sambutan ?? 'Selamat datang di halaman profil resmi sekolah kami. Kami berkomitmen memberikan sarana belajar terbaik, membentuk karakter siswa yang mandiri, berakhlak mulia, serta siap menghadapi tantangan masa depan.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Identitas Ringkas & Informasi Legal -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8 mb-8" data-aos="fade-up">
            <h2 class="text-xl font-bold text-slate-800 mb-6 border-b pb-2">Identitas & Legalitas Sekolah</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                <div class="flex justify-between py-2 border-b border-slate-100">
                    <span class="text-slate-500 font-medium">Nama Sekolah</span>
                    <span class="font-semibold text-slate-800">{{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-slate-100">
                    <span class="text-slate-500 font-medium">NPSN</span>
                    <span class="font-semibold text-slate-800">{{ $profil->npsn ?? '20210890' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-slate-100">
                    <span class="text-slate-500 font-medium">Status</span>
                    <span class="font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded text-xs">Negeri</span>
                </div>
                <div class="flex justify-between py-2 border-b border-slate-100">
                    <span class="text-slate-500 font-medium">Akreditasi</span>
                    <span class="font-semibold text-blue-600">{{ $profil->akreditasi ?? 'A' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-slate-100">
                    <span class="text-slate-500 font-medium">Tahun Berdiri</span>
                    <span class="font-semibold text-slate-800">{{ $profil->tahun_berdiri ?? '2000' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-slate-100">
                    <span class="text-slate-500 font-medium">Telepon / WhatsApp</span>
                    <span class="font-semibold text-slate-800">{{ $profil->kontak ?? '0897654212345' }}</span>
                </div>
            </div>
        </div>

        <!-- 3. Visi & Misi -->
        <div class="bg-blue-600 text-white rounded-2xl shadow-md p-6 sm:p-8" data-aos="fade-up">
            <h2 class="text-xl font-bold mb-4 border-b border-blue-400 pb-2">Visi & Misi</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-blue-200">Visi</h3>
                    <p class="text-blue-50 text-base italic mt-1 leading-relaxed">
                        "{{ $profil->visi ?? 'Terwujudnya Peserta Didik yang Berakhlak Mulia, Cerdas, Terampil, Mandiri, dan Berwawasan Lingkungan.' }}"
                    </p>
                </div>
                <div class="pt-2">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-blue-200 mb-2">Misi</h3>
                    <ul class="list-disc list-inside text-blue-50 space-y-1.5 text-sm sm:text-base leading-relaxed">
                        <li>Menyelenggarakan proses pembelajaran yang inovatif dan berorientasi pada karakter.</li>
                        <li>Mengembangkan bakat dan minat siswa dalam bidang akademik maupun non-akademik.</li>
                        <li>Mewujudkan lingkungan belajar yang aman, nyaman, dan berbudaya lingkungan.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Script Animasi AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });
    </script>
</body>
</html>