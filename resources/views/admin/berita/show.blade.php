@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="container-fluid px-0" style="max-width: 800px; margin: 0 auto;">

    <!-- Header & Tombol Kembali -->
    <div class="mb-4">
        <h1 class="h3 fw-bold text-dark mb-1">Detail Berita</h1>
        <p class="text-muted small mb-0">Informasi lengkap mengenai berita atau kegiatan sekolah.</p>
    </div>

    <!-- Card Utama -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
        
        <!-- Judul & Info Meta -->
        <div class="mb-4">
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill small mb-3">
                <i class="fa-solid fa-newspaper me-1"></i> Berita Sekolah
            </span>
            <h2 class="h4 fw-bold text-dark lh-base mb-3">
                {{ $berita->judul }}
            </h2>
            
            <div class="d-flex flex-wrap align-items-center gap-3 text-secondary small pt-3 border-top">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-regular fa-calendar text-success"></i>
                    <span>Tanggal: <strong class="text-dark">{{ date('d M Y', strtotime($berita->tanggal)) }}</strong></span>[cite: 18]
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-regular fa-user text-success"></i>
                    <span>Penulis: <strong class="text-dark">{{ $berita->user->name ?? 'Administrator' }}</strong></span>[cite: 18]
                </div>
            </div>
        </div>

        <!-- Gambar Berita -->
        @if ($berita->gambar)
            <div class="mb-4 rounded-3 overflow-hidden border bg-light" style="height: 320px;">
                <img src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-100 h-100 object-fit-cover">[cite: 18]
            </div>
        @endif

        <!-- Keterangan / Isi Berita -->
        <div class="mb-4 pt-3 border-top">
            <h3 class="small fw-bold text-uppercase text-secondary mb-2">Keterangan / Isi Berita</h3>
            <div class="p-4 bg-light rounded-3 border text-secondary small lh-lg text-pre-line">
                {{ $berita->isi }}[cite: 18]
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
            <a href="{{ route('admin.berita.index') }}" class="btn btn-light px-4 rounded-3 text-secondary fw-semibold">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Berita
            </a>
            <a href="{{ route('admin.berita.addEdit', Crypt::encrypt($berita->id)) }}" class="btn btn-warning text-white px-4 rounded-3 fw-semibold shadow-sm">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Berita
            </a>
        </div>

    </div>
</div>
@endsection