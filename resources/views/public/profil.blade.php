@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')

{{-- HEADER PROFIL --}}
<section class="bg-success text-white py-4 px-3" style="background-color: #0B2319 !important;">
    <div class="container">
        <p class="small text-success-subtle mb-1">
            <a href="{{ route('landing') }}" class="text-success-subtle text-decoration-none">Beranda</a> / Profil Sekolah
        </p>
        <h1 class="h3 fw-bold mb-1">
            <i class="fas fa-school me-2 text-success"></i> Profil Sekolah
        </h1>
        <p class="small text-light mb-0">Informasi lengkap mengenai identitas, visi, misi, dan data sekolah.</p>
    </div>
</section>

{{-- INFORMASI PROFIL SEKOLAH --}}
<section class="bg-white py-5">
    <div class="container">

        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark h3">Informasi Profil Sekolah</h2>
            <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
        </div>

        <div class="row g-4">

            {{-- INFORMASI IDENTITAS SEKOLAH --}}
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-school fs-4"></i>
                    </div>
                    <div>
                        <h3 class="h5 fw-bold text-dark mb-0">{{ $profil->nama_sekolah ?? 'Profil Sekolah' }}</h3>
                        <p class="small text-muted mb-0">Identitas dan informasi lengkap sekolah</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-school me-1"></i> Nama Sekolah
                            </div>
                            <p class="fw-bold text-dark mb-0">{{ $profil->nama_sekolah ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-id-card me-1"></i> NPSN
                            </div>
                            <p class="fw-bold text-dark mb-0">{{ $profil->npsn ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-award me-1"></i> Akreditasi
                            </div>
                            <p class="fw-bold text-dark mb-0">{{ $profil->akreditasi ?? 'A' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-calendar-alt me-1"></i> Tahun Berdiri
                            </div>
                            <p class="fw-bold text-dark mb-0">{{ $profil->tahun_berdiri ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-phone me-1"></i> Kontak
                            </div>
                            <p class="fw-bold text-dark mb-0 text-break">{{ $profil->kontak ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border rounded-3 p-3 shadow-sm h-100">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-envelope me-1"></i> Email Sekolah
                            </div>
                            <p class="fw-bold text-dark mb-0 text-break">{{ $profil->email ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border rounded-3 p-3 shadow-sm">
                            <div class="text-success small fw-semibold text-uppercase mb-1">
                                <i class="fas fa-map-marker-alt me-1"></i> Alamat Sekolah
                            </div>
                            <p class="small text-secondary mb-0">{{ $profil->alamat ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border rounded-3 p-3 shadow-sm">
                            <div class="text-success small fw-semibold text-uppercase mb-2">
                                <i class="fas fa-info-circle me-1"></i> Tentang Sekolah
                            </div>
                            <p class="small text-secondary lh-lg mb-0">{{ $profil->deskripsi ?? 'Informasi sekolah belum tersedia.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4">
                    {{-- KARTU KEPALA SEKOLAH --}}
                    <div class="card border-0 text-center text-white rounded-4 p-4 shadow" style="background-color: #0B2319;">
                        @if(!empty($profil->foto_kepala))
                            <img src="{{ asset('storage/' . ltrim($profil->foto_kepala, '/')) }}" alt="Kepala Sekolah" class="rounded-circle border border-success border-4 mx-auto mb-3 object-fit-cover shadow-sm" style="width: 130px; height: 130px;">
                        @else
                            <div class="rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-center mx-auto mb-3" style="width: 130px; height: 130px;">
                                <i class="fas fa-user-tie fs-1"></i>
                            </div>
                        @endif
                        <h3 class="h5 fw-bold mb-1">{{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}</h3>
                        <p class="small text-success-subtle mb-0">Kepala Sekolah</p>
                    </div>

                    {{-- STATISTIK SEKOLAH --}}
                    <div class="card border shadow-sm rounded-3 overflow-hidden">
                        <div class="card-header text-white fw-bold py-3" style="background-color: #0B2319;">
                            <i class="fas fa-chart-bar me-2 text-success"></i> Statistik Sekolah
                        </div>
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-secondary"><i class="fas fa-user-graduate me-2 text-success"></i> Total Siswa</span>
                                <strong class="text-dark">{{ $jumlahSiswa ?? 0 }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-secondary"><i class="fas fa-chalkboard-teacher me-2 text-success"></i> Guru</span>
                                <strong class="text-dark">{{ $jumlahGuru ?? 0 }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="text-secondary"><i class="fas fa-users me-2 text-success"></i> Ekstrakurikuler</span>
                                <strong class="text-dark">{{ $jumlahEkstrakurikuler ?? 0 }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- VISI DAN MISI SEKOLAH --}}
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-4">
            <p class="small fw-bold text-success text-uppercase mb-1">Arah dan Tujuan</p>
            <h2 class="fw-bold text-dark h3">Visi & Misi Sekolah</h2>
            <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 border-start border-success border-4 shadow-sm p-4 rounded-3 bg-white">
                    <h3 class="h5 fw-bold text-dark mb-3">
                        <i class="fas fa-eye me-2 text-success"></i> Visi dan Misi Sekolah
                    </h3>
                    <p class="small text-secondary lh-lg mb-0 text-pre-line">{{ $profil->visi_misi ?? 'Visi dan misi sekolah belum diisi.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection