@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex flex-column gap-4">
    <!-- PAGE TITLE -->
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">Dashboard</h1>
        <p class="text-secondary mb-0">Selamat datang di sistem manajemen informasi sekolah.</p>
    </div>

    <!-- WELCOME BANNER -->
    <div class="rounded-4 p-4 p-md-5 text-white shadow-sm position-relative overflow-hidden" style="background:#0B2319;">
        <div class="position-relative" style="z-index:1; max-width:720px;">
            <span class="badge rounded-pill mb-3 px-3 py-2" style="background:rgba(16,185,129,.2);color:#6ee7b7;">
                <i class="fa-solid fa-graduation-cap me-1"></i> Admin Panel
            </span>
            <h2 class="h4 fw-bold mb-2">
                Selamat Datang di Dashboard {{ $profilSekolah->nama_sekolah ?? 'SMPN 1 Mangunreja' }}
            </h2>
            <p class="text-white-50 mb-0">
                Kelola seluruh informasi sekolah, tenaga pendidik, siswa, kegiatan, berita, dan galeri dengan mudah melalui antarmuka modern.
            </p>
        </div>
        <i class="fa-solid fa-sparkles position-absolute end-0 top-50 translate-middle-y me-4 d-none d-md-block"
           style="font-size:8rem;color:#34d399;opacity:.12;" aria-hidden="true"></i>
    </div>

    <!-- STATISTIC CARDS -->
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-xl">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><span class="small text-secondary">Total Guru</span><h3 class="display-6 fw-bold mt-1 mb-0">{{ $totalGuru }}</h3></div>
                        <span class="rounded-3 d-flex align-items-center justify-content-center fs-5" style="width:44px;height:44px;background:#eff6ff;color:#2563eb;"><i class="fa-solid fa-chalkboard-user"></i></span>
                    </div>
                    <a href="{{ route('admin.guru.index') }}" class="small fw-semibold text-primary text-decoration-none mt-4 d-flex justify-content-between">Kelola Guru <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><span class="small text-secondary">Total Siswa</span><h3 class="display-6 fw-bold mt-1 mb-0">{{ $totalSiswa }}</h3></div>
                        <span class="rounded-3 d-flex align-items-center justify-content-center fs-5" style="width:44px;height:44px;background:#ecfdf5;color:#059669;"><i class="fa-solid fa-user-graduate"></i></span>
                    </div>
                    <a href="{{ route('admin.siswa.index') }}" class="small fw-semibold text-success text-decoration-none mt-4 d-flex justify-content-between">Kelola Siswa <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><span class="small text-secondary">Total Berita</span><h3 class="display-6 fw-bold mt-1 mb-0">{{ $totalBerita }}</h3></div>
                        <span class="rounded-3 d-flex align-items-center justify-content-center fs-5" style="width:44px;height:44px;background:#f0f9ff;color:#0284c7;"><i class="fa-solid fa-newspaper"></i></span>
                    </div>
                    <a href="{{ route('admin.berita.index') }}" class="small fw-semibold text-info text-decoration-none mt-4 d-flex justify-content-between">Kelola Berita <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><span class="small text-secondary">Total Ekskul</span><h3 class="display-6 fw-bold mt-1 mb-0">{{ $totalEkstrakurikuler }}</h3></div>
                        <span class="rounded-3 d-flex align-items-center justify-content-center fs-5" style="width:44px;height:44px;background:#fffbeb;color:#d97706;"><i class="fa-solid fa-trophy"></i></span>
                    </div>
                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="small fw-semibold text-warning text-decoration-none mt-4 d-flex justify-content-between">Kelola Ekskul <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><span class="small text-secondary">Dokumentasi</span><h3 class="display-6 fw-bold mt-1 mb-0">{{ $totalGaleri }}</h3></div>
                        <span class="rounded-3 d-flex align-items-center justify-content-center fs-5" style="width:44px;height:44px;background:#fff1f2;color:#e11d48;"><i class="fa-solid fa-images"></i></span>
                    </div>
                    <a href="{{ route('admin.galeri.index') }}" class="small fw-semibold text-danger text-decoration-none mt-4 d-flex justify-content-between">Kelola Galeri <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- PROFIL SEKOLAH DAN BERITA TERBARU -->
    <div class="row g-4">
        <!-- PROFIL SEKOLAH -->
        <div class="col-12 col-xl-5">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <h3 class="h6 fw-bold mb-0"><i class="fa-solid fa-building-columns text-success me-2"></i>Profil Sekolah</h3>
                        <a href="{{ route('admin.profil-sekolah') }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-3 border bg-light d-flex align-items-center justify-content-center" style="width:64px;height:64px;">
                            <i class="fa-solid fa-school fs-3 text-success"></i>
                        </div>
                        <div>
                            <h4 class="h6 fw-bold mb-1">{{ $profilSekolah->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h4>
                            <p class="small text-secondary mb-0">NPSN: {{ $profilSekolah->npsn ?? '20210890' }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between gap-3 py-3 border-bottom">
                        <span class="text-secondary small">Kepala Sekolah</span>
                        <span class="fw-semibold small text-end">{{ $profilSekolah->kepala_sekolah ?? 'Belum diisi' }}</span>
                    </div>
                    <div class="d-flex justify-content-between gap-3 py-3">
                        <span class="text-secondary small">Kontak</span>
                        <span class="fw-semibold small text-end">{{ $profilSekolah->telepon ?? $profilSekolah->no_telepon ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- BERITA TERBARU -->
        <div class="col-12 col-xl-7">
            <div class="card h-100 border shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <h3 class="h6 fw-bold mb-0"><i class="fa-solid fa-newspaper text-success me-2"></i>Berita &amp; Artikel Terbaru</h3>
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        @forelse ($beritaTerbaru as $berita)
                            <div class="d-flex align-items-center justify-content-between gap-3 p-3 rounded-3 border bg-light">
                                <div class="d-flex align-items-center gap-3 min-w-0">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;background:#d1fae5;color:#047857;">
                                        <i class="fa-solid fa-calendar-day"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="fw-semibold small mb-1 text-break">{{ $berita->judul ?? $berita->judul_berita ?? 'Berita tanpa judul' }}</p>
                                        <p class="text-secondary small mb-0">
                                            @if ($berita->tanggal)
                                                {{ \Illuminate\Support\Carbon::parse($berita->tanggal)->format('d M Y') }}
                                            @else
                                                Tanggal tidak tersedia
                                            @endif
                                            &bull; {{ $berita->user->name ?? 'Administrator' }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.berita.index') }}" aria-label="Lihat berita" class="btn btn-sm btn-light border flex-shrink-0">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        @empty
                            <div class="alert alert-light text-center text-secondary mb-0">Belum ada berita yang tersedia.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
