<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMPN 1 Mangunreja - Website Resmi</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
    <!-- Gambar Logo Sekolah -->
    <img src="{{ asset('images/logo.smp.png') }}" 
         alt="Logo SMKN 2 Tasikmalaya" 
         class="w-10 h-10 object-contain">

    <!-- Nama Sekolah & NPSN -->
    <div>
        <h1 class="text-base font-bold text-slate-900 leading-tight">
           SMPN 1 Mangunreja
        </h1>
        <p class="text-xs text-slate-500">
            NPSN: 20210890
        </p>
    </div>
</div>

            <!-- Menu Navigasi -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#beranda" class="hover:text-emerald-600 transition">Beranda</a>
                <a href="#profil" class="hover:text-emerald-600 transition">Profil</a>
                <a href="#guru" class="hover:text-emerald-600 transition">Guru & Staff</a>
                <a href="#ekskul" class="hover:text-emerald-600 transition">Ekstrakurikuler</a>
                <a href="#berita" class="hover:text-emerald-600 transition">Berita</a>
                <a href="#galeri" class="hover:text-emerald-600 transition">Galeri</a>
            </nav>

            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition shadow-lg shadow-emerald-600/20">
                <span>Login</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </header>

<section id="beranda" class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28 bg-cover bg-center bg-no-repeat bg-slate-800" style="background-image: url('{{ asset('public/img/hero.png') }}');">
    
    <!-- Overlay Gelap Transparan (Agar tulisan putih tetap terlihat jelas) -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Konten Hero Utama -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Kolom Teks -->
            <div class="space-y-6">
                <span class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem Informasi Sekolah
                </span>
                
                <h2 class="text-4xl sm:text-5xl font-extrabold text-white leading-tight">
                    <span class="text-emerald-400">SMPN 1 Mangunreja</span>
                </h2>
                
                
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="#profil" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3.5 rounded-xl font-semibold text-sm shadow-lg shadow-emerald-600/30 transition">
                        Profil Sekolah
                    </a>
                    <a href="#guru" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md px-6 py-3.5 rounded-xl font-semibold text-sm transition">
                        Lihat Tenaga Pendidik
                    </a>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-white/95 backdrop-blur-md p-6 rounded-2xl border border-white/20 shadow-xl">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900">7</h3>
                    <p class="text-xs font-medium text-slate-500 mt-1">Tenaga Pendidik</p>
                </div>
                
                <div class="bg-white/95 backdrop-blur-md p-6 rounded-2xl border border-white/20 shadow-xl">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900">4</h3>
                    <p class="text-xs font-medium text-slate-500 mt-1">Berita & Artikel</p>
                </div>
                
                <div class="bg-white/95 backdrop-blur-md p-6 rounded-2xl border border-white/20 shadow-xl">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900">5</h3>
                    <p class="text-xs font-medium text-slate-500 mt-1">Ekstrakurikuler</p>
                </div>
                
                <div class="bg-white/95 backdrop-blur-md p-6 rounded-2xl border border-white/20 shadow-xl">
                    <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900">7</h3>
                    <p class="text-xs font-medium text-slate-500 mt-1">Galeri Dokumentasi</p>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- Section Profil Sekolah -->
    <section id="profil" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            
            <!-- Kolom Foto Kepala Sekolah (Sebelah Kiri) -->
            <div class="md:col-span-4 flex justify-center">
                <div class="relative w-full max-w-sm rounded-2xl overflow-hidden shadow-lg border border-slate-100">
                    <img src="{{ asset('images/kepala-sekolah.png') }}" 
                         alt="Foto Kepala Sekolah" 
                         class="w-full h-[380px] object-cover object-center">
                </div>
            </div>

            <!-- Kolom Konten Sambutan & Detail (Sebelah Kanan) -->
            <div class="md:col-span-8 space-y-4">
                
                <!-- Sub-heading Kuning/Emas -->
                <p class="text-xs font-bold tracking-widest text-amber-600 uppercase">
                    Profil & Sambutan Sekolah
                </p>

                <!-- Judul Utama Biru -->
                <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-900 leading-tight">
                    Sambutan Kepala Sekolah
                </h2>

                <!-- Garis Akses Horizontal -->
                <div class="w-16 h-1 bg-amber-500 rounded-full my-2"></div>

                <!-- Teks Deskripsi / Sambutan -->
                <div class="text-slate-600 text-sm leading-relaxed space-y-3 pt-2">
                    <p>
                        "SMK Negeri 2 Tasikmalaya dulunya adalah sebuah Sekolah Teknik Menengah namun sekarang telah berubah menjadi Sekolah Menengah Kejuruan yang termasuk dalam kelompok Teknologi dan Industri."
                    </p>
                    <p>
                        Melalui media ini, kami berharap seluruh informasi mengenai kegiatan, prestasi, serta program pendidikan dapat tersampaikan secara transparan, cepat, dan akurat.
                    </p>
                </div>

                <!-- Nama & Jabatan Kepala Sekolah -->
                <div class="pt-4 border-b border-slate-100 pb-4">
                    <h3 class="text-lg font-bold text-slate-900">
                        KURNIAWAN, S.Pd., M.Pd.
                    </h3>
                    <p class="text-xs font-medium text-slate-500">
                        Kepala Sekolah SMPN 1 Mangunreja
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Section Guru & Staff -->
    <section id="guru" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Tenaga Pendidik</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Daftar Guru & Staff Pengajar</h2>
                <p class="text-slate-600 text-sm mt-2">Seluruh tenaga pendidik profesional di SMKN 2 Tasikmalaya.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">AF</div>
                    <h4 class="font-bold text-slate-900 text-base">Ahmad Fauzi, S.Kom.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Informatika</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 198501152010011</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">BS</div>
                    <h4 class="font-bold text-slate-900 text-base">Budi Santoso, M.Pd.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Matematika</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 198207102008011</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">DL</div>
                    <h4 class="font-bold text-slate-900 text-base">Dewi Lestari, S.Pd.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Bahasa Inggris</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 199011052014022</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">EM</div>
                    <h4 class="font-bold text-slate-900 text-base">Endang Maryani, S.Pd.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Seni Budaya</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 198709182011022</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">NS</div>
                    <h4 class="font-bold text-slate-900 text-base">Nabila, S.Pd.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">PPKN</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 09876543123456</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">RP</div>
                    <h4 class="font-bold text-slate-900 text-base">Rizki Pratama, M.Kom.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Produktif PPLG</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 199205122016011</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 text-emerald-700 font-bold text-xl flex items-center justify-center mb-4 border-2 border-emerald-200">SR</div>
                    <h4 class="font-bold text-slate-900 text-base">Siti Rahmawati, S.Pd.</h4>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Bahasa Indonesia</p>
                    <p class="text-[11px] text-slate-400 mt-2 font-mono">NIP: 198803202012022</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Ekstrakurikuler (5 Ekskul dari Database) -->
    <section id="ekskul" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Pengembangan Bakat</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Ekstrakurikuler Sekolah</h2>
                <p class="text-slate-600 text-sm mt-2">Daftar kegiatan pengembangan minat dan potensi siswa.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Futsal -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg">⚽</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">Futsal</h4>
                            <p class="text-xs text-emerald-600 font-medium">Pembina: Siti Rahmawati, S.Pd.</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mb-4">Wadah pembinaan bakat olahraga sepak bola dan futsal siswa.</p>
                    <div class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-medium bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Selasa & Kamis, 16.00 - 18.00 WIB
                    </div>
                </div>

                <!-- PMR -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-lg">🏥</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">Palang Merah Remaja (PMR)</h4>
                            <p class="text-xs text-emerald-600 font-medium">Pembina: Siti Rahmawati, S.Pd.</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mb-4">Melatih keterampilan pertolongan pertama dan jiwa kemanusiaan.</p>
                    <div class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-medium bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Senin, 15.30 - 17.00 WIB
                    </div>
                </div>

                <!-- Paskibra -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">🇮🇩</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">Paskibra</h4>
                            <p class="text-xs text-emerald-600 font-medium">Pembina: Ahmad Fauzi, S.Kom.</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mb-4">Membina baris-berbaris, ketahanan fisik, serta kedisiplinan tinggi.</p>
                    <div class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-medium bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Rabu & Sabtu, 15.30 - 17.30 WIB
                    </div>
                </div>

                <!-- Pramuka -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-lg">⚜️</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">Pramuka</h4>
                            <p class="text-xs text-emerald-600 font-medium">Pembina: Budi Santoso, M.Pd.</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mb-4">Ekstrakurikuler wajib yang melatih kemandirian dan kepemimpinan.</p>
                    <div class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-medium bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Jumat, 15.00 - 17.00 WIB
                    </div>
                </div>

                <!-- Seni Musik dan Tari -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 hover:shadow-md transition">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg">🎵</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-lg">Seni Musik dan Tari</h4>
                            <p class="text-xs text-emerald-600 font-medium">Pembina: Dewi Lestari, S.Pd.</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mb-4">Eksplorasi bakat seni tradisi maupun modern bagi para siswa.</p>
                    <div class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-medium bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Sabtu, 09.00 - 12.00 WIB
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Berita -->
    <section id="berita" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Informasi Terkini</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Berita & Kegiatan Sekolah</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-100 hover:shadow-md transition flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-emerald-600 font-semibold mb-1">06 Oct 2026 &bull; Administrator</div>
                        <h4 class="font-bold text-slate-900 text-lg">Penerimaan Peserta Didik Baru Telah Dibuka</h4>
                        <p class="text-xs text-slate-500 mt-1">Informasi pendaftaran siswa baru SMKN 2 Tasikmalaya tahun ajaran mendatang.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100 hover:shadow-md transition flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-emerald-600 font-semibold mb-1">06 Oct 2026 &bull; Administrator</div>
                        <h4 class="font-bold text-slate-900 text-lg">Siswa SMK Raih Juara 1 LKS Tingkat Provinsi</h4>
                        <p class="text-xs text-slate-500 mt-1">Prestasi membanggakan dari perwakilan siswa SMKN 2 Tasikmalaya dalam Lomba Kompetensi Siswa.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100 hover:shadow-md transition flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-emerald-600 font-semibold mb-1">06 Oct 2026 &bull; Administrator</div>
                        <h4 class="font-bold text-slate-900 text-lg">Sosialisasi Bahaya Narkoba Bersama Kepolisian</h4>
                        <p class="text-xs text-slate-500 mt-1">Kegiatan edukasi pencegahan bahaya penyalahgunaan narkoba bagi seluruh siswa.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100 hover:shadow-md transition flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-emerald-600 font-semibold mb-1">06 Oct 2026 &bull; Administrator</div>
                        <h4 class="font-bold text-slate-900 text-lg">Ujian Akhir Semester Berbasis Digital</h4>
                        <p class="text-xs text-slate-500 mt-1">Pelaksanaan ujian berbasis komputer dan smartphone berjalan secara tertib dan lancar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Galeri & Dokumentasi (7 Data dari Database) -->
    <section id="galeri" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Koleksi Aktivitas</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Galeri & Dokumentasi</h2>
                <p class="text-slate-600 text-sm mt-2">Koleksi foto dan video aktivitas kegiatan di sekolah.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- 1. Workshop Pemrograman Web Modern -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Foto</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">14 Feb 2025</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Workshop Pemrograman Web Modern</h4>
                        <p class="text-xs text-slate-500 mt-1">Pelatihan intensif pembuatan website portofolio...</p>
                    </div>
                </div>

                <!-- 2. Dokumentasi Latihan Kepemimpinan Siswa -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-purple-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Video</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">22 Jan 2025</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Dokumentasi Latihan Kepemimpinan Siswa</h4>
                        <p class="text-xs text-slate-500 mt-1">Video rangkuman kegiatan LDKS pembentukan...</p>
                    </div>
                </div>

                <!-- 3. Pentas Seni dan Budaya Sunda -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Foto</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">15 Dec 2024</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Pentas Seni dan Budaya Sunda</h4>
                        <p class="text-xs text-slate-500 mt-1">Penampilan tari kreasi tradisional dan arumba oleh...</p>
                    </div>
                </div>

                <!-- 4. Pelantikan Pengurus OSIS & MPK -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Foto</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">12 Nov 2024</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Pelantikan Pengurus OSIS & MPK</h4>
                        <p class="text-xs text-slate-500 mt-1">Kegiatan serah terima jabatan dan ikrar pengurus...</p>
                    </div>
                </div>

                <!-- 5. Kunjungan Industri Jurusan PPLG -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Foto</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">05 Oct 2024</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Kunjungan Industri Jurusan PPLG</h4>
                        <p class="text-xs text-slate-500 mt-1">Siswa jurusan PPLG melakukan kunjungan studi...</p>
                    </div>
                </div>

                <!-- 6. Highlights Turnamen Futsal Antar Kelas -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-purple-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Video</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">10 Sep 2024</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Highlights Turnamen Futsal Antar Kelas</h4>
                        <p class="text-xs text-slate-500 mt-1">Video cuplikan aksi seru pertandingan final...</p>
                    </div>
                </div>

                <!-- 7. Upacara Hari Kemerdekaan RI Ke-79 -->
                <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
                    <div class="h-44 bg-slate-200 flex items-center justify-center text-slate-400 relative">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Foto</span>
                    </div>
                    <div class="p-5">
                        <span class="text-[11px] text-slate-400 font-semibold">17 Aug 2024</span>
                        <h4 class="font-bold text-slate-900 text-base mt-1">Upacara Hari Kemerdekaan RI Ke-79</h4>
                        <p class="text-xs text-slate-500 mt-1">Dokumentasi pelaksanaan upacara peringatan HU...</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <p class="font-bold text-white">SMKN 2 Tasikmalaya</p>
                <p class="text-xs text-slate-500 mt-0.5">Jl. Noenoeng Tisnasaputra No.2, Kahuripan, Tawang, Tasikmalaya</p>
            </div>
            <p class="text-xs text-slate-500">&copy; 2026 SMKN 2 Tasikmalaya. NPSN: 20210890 &bull; Telp: 08772218776</p>
        </div>
    </footer>

</body>
</html>