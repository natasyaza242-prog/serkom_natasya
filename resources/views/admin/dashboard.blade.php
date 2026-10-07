@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <!-- Page Title -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-sm text-slate-500">
            Selamat datang di sistem manajemen informasi sekolah.
        </p>
    </div>

    <!-- WELCOME BANNER (SPARK GREEN THEME) -->
    <div class="bg-[#0B2319] text-white p-6 rounded-3xl relative overflow-hidden flex justify-between items-center shadow-lg shadow-emerald-950/10">

        <div class="z-10 max-w-2xl">

            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-semibold mb-3">
                <i class="fa-solid fa-graduation-cap"></i> Admin Panel
            </div>

            <h2 class="text-xl font-bold mb-1">
                Selamat Datang di Dashboard SMPN 1 Mangunreja
            </h2>

            <p class="text-slate-300 text-sm leading-relaxed">
                Kelola seluruh informasi sekolah, tenaga pendidik, siswa, kegiatan, berita, dan galeri dengan mudah melalui antarmuka modern.
            </p>

        </div>

        <!-- Spark Decorative Icon -->
        <div class="hidden md:block opacity-10 text-emerald-400 text-9xl font-bold pr-6">
            <i class="fa-solid fa-sparkles"></i>
        </div>

    </div>

    <!-- STATISTIC CARDS GRID (5 METRICS) -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">

        <!-- Total Guru Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition">

            <div class="flex justify-between items-start">

                <div>
                    <span class="text-xs font-medium text-slate-500">
                        Total Guru
                    </span>

                    <h3 class="text-3xl font-bold text-slate-900 mt-1">
                        6
                    </h3>
                </div>

                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>

            </div>

            <a href="{{ route('admin.guru.index') }}"
               class="mt-4 inline-flex items-center justify-between text-xs font-semibold text-blue-600 hover:text-blue-700">

                <span>Kelola Guru</span>

                <i class="fa-solid fa-arrow-right text-[10px]"></i>

            </a>

        </div>


        <!-- Total Siswa Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition">

            <div class="flex justify-between items-start">

                <div>
                    <span class="text-xs font-medium text-slate-500">
                        Total Siswa
                    </span>

                    <h3 class="text-3xl font-bold text-slate-900 mt-1">
                        10
                    </h3>
                </div>

                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>

            </div>

            <a href="{{ route('admin.siswa.index') }}"
               class="mt-4 inline-flex items-center justify-between text-xs font-semibold text-emerald-600 hover:text-emerald-700">

                <span>Kelola Siswa</span>

                <i class="fa-solid fa-arrow-right text-[10px]"></i>

            </a>

        </div>


        <!-- Total Berita Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition">

            <div class="flex justify-between items-start">

                <div>
                    <span class="text-xs font-medium text-slate-500">
                        Total Berita
                    </span>

                    <h3 class="text-3xl font-bold text-slate-900 mt-1">
                        5
                    </h3>
                </div>

                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-newspaper"></i>
                </div>

            </div>

            <a href="{{ route('admin.berita.index') }}"
               class="mt-4 inline-flex items-center justify-between text-xs font-semibold text-sky-600 hover:text-sky-700">

                <span>Kelola Berita</span>

                <i class="fa-solid fa-arrow-right text-[10px]"></i>

            </a>

        </div>


        <!-- Total Ekstrakurikuler Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition">

            <div class="flex justify-between items-start">

                <div>
                    <span class="text-xs font-medium text-slate-500">
                        Total Ekskul
                    </span>

                    <h3 class="text-3xl font-bold text-slate-900 mt-1">
                        5
                    </h3>
                </div>

                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-trophy"></i>
                </div>

            </div>

            <a href="{{ route('admin.ekstrakurikuler.index') }}"
               class="mt-4 inline-flex items-center justify-between text-xs font-semibold text-amber-600 hover:text-amber-700">

                <span>Kelola Ekskul</span>

                <i class="fa-solid fa-arrow-right text-[10px]"></i>

            </a>

        </div>


        <!-- Total Galeri Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition">

            <div class="flex justify-between items-start">

                <div>
                    <span class="text-xs font-medium text-slate-500">
                        Dokumentasi
                    </span>

                    <h3 class="text-3xl font-bold text-slate-900 mt-1">
                        8
                    </h3>
                </div>

                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-images"></i>
                </div>

            </div>

            <a href="{{ route('admin.galeri.index') }}"
               class="mt-4 inline-flex items-center justify-between text-xs font-semibold text-rose-600 hover:text-rose-700">

                <span>Kelola Galeri</span>

                <i class="fa-solid fa-arrow-right text-[10px]"></i>

            </a>

        </div>

    </div>


    <!-- LOWER SECTION: PROFIL SEKOLAH & BERITA TERBARU -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">


        <!-- Profil Sekolah Singkat Card -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">

            <div>

                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-building-columns text-emerald-600"></i>

                        <h3 class="font-bold text-slate-800">
                            Profil Sekolah
                        </h3>

                    </div>

                    <a href="{{ route('admin.profil-sekolah') }}"
                       class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition">

                        Detail

                    </a>

                </div>


                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-slate-100 p-2 flex items-center justify-center border border-slate-200">

                        <i class="fa-solid fa-school text-2xl text-emerald-700"></i>

                    </div>

                    <div>

                        <h4 class="font-bold text-slate-900 text-lg">
                            SMPN 1 Mangunreja
                        </h4>

                        <p class="text-xs text-slate-500">
                            NPSN: 20210890
                        </p>

                    </div>

                </div>


                <div class="space-y-3 text-sm">

                    <div class="flex justify-between py-2 border-b border-slate-100">

                        <span class="text-slate-500">
                            Kepala Sekolah
                        </span>

                        <span class="font-semibold text-slate-800">
                            KURNIAWAN, S.Pd., M.Pd.
                        </span>

                    </div>


                    <div class="flex justify-between py-2 border-b border-slate-100">

                        <span class="text-slate-500">
                            Kontak
                        </span>

                        <span class="font-semibold text-slate-800">
                            081234567890
                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- Berita & Artikel Terbaru Card -->
        <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">

            <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">

                <div class="flex items-center gap-2">

                    <i class="fa-solid fa-newspaper text-emerald-600"></i>

                    <h3 class="font-bold text-slate-800">
                        Berita & Artikel Terbaru
                    </h3>

                </div>

                <a href="{{ route('admin.berita.index') }}"
                   class="text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition">

                    Lihat Semua

                </a>

            </div>


            <div class="space-y-3">

                <!-- Berita Item 1 -->
                <div class="p-3 rounded-xl border border-slate-100 hover:border-slate-200 bg-slate-50/50 flex items-center justify-between transition">

                    <div class="flex items-center gap-3">

                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold">

                            <i class="fa-solid fa-calendar-day"></i>

                        </div>

                        <div>

                            <p class="text-xs text-slate-400">
                                28 Feb 2025 • Administrator
                            </p>

                        </div>

                    </div>

                    <a href="{{ route('admin.berita.index') }}"
                       class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-100">

                        <i class="fa-solid fa-chevron-right text-xs"></i>

                    </a>

                </div>


                <!-- Berita Item 2 -->
                <div class="p-3 rounded-xl border border-slate-100 hover:border-slate-200 bg-slate-50/50 flex items-center justify-between transition">

                    <div class="flex items-center gap-3">

                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold">

                            <i class="fa-solid fa-calendar-day"></i>

                        </div>

                        <div>

                            <p class="text-xs text-slate-400">
                                18 Feb 2025 • Operator Sekolah
                            </p>

                        </div>

                    </div>

                    <a href="{{ route('admin.berita.index') }}"
                       class="w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-100">

                        <i class="fa-solid fa-chevron-right text-xs"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection