@extends('layouts.public')

@section('title', 'Galeri Sekolah')

@section('content')
<section class="bg-success text-white py-4 px-3" style="background-color: #0B2319 !important;">
    <div class="container">
        <p class="small text-success-subtle mb-1">
            <a href="{{ route('landing') }}" class="text-success-subtle text-decoration-none">Beranda</a> / Galeri
        </p>
        <h1 class="h3 fw-bold mb-1">
            <i class="fas fa-school me-2 text-success"></i> Galeri Sekolah
        </h1>
        <p class="small text-light mb-0">Dokumentasi kegiatan dan momen di sekolah.</p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="h2 fw-bold text-dark">Galeri Sekolah</h1>
            <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
        </div>

        @if($galeri->isEmpty())
            <div class="text-center py-5 bg-light rounded-4">
                <i class="fas fa-images fs-1 text-success mb-3 d-block"></i>
                <p class="small text-muted">Belum ada foto atau video di galeri.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($galeri as $item)
                    @php
                        $file = $item->file ?? $item->gambar ?? $item->foto ?? null;
                        $fileUrl = $file ? (\Illuminate\Support\Str::startsWith($file, ['http://', 'https://']) ? $file : asset('storage/' . ltrim($file, '/'))) : null;
                        $ekstensi = strtolower(pathinfo($file ?? '', PATHINFO_EXTENSION));
                        $isVideo = in_array($ekstensi, ['mp4', 'webm', 'ogg', 'mov']);
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                            @if($fileUrl && $isVideo)
                                <video controls preload="metadata" class="w-100 bg-dark object-fit-contain" style="height: 240px;">
                                    <source src="{{ $fileUrl }}"> Browser kamu tidak mendukung video.
                                </video>
                            @elseif($fileUrl)
                                <a href="{{ $fileUrl }}" target="_blank">
                                    <img src="{{ $fileUrl }}" alt="{{ $item->judul ?? 'Galeri' }}" class="w-100 object-fit-cover" style="height: 240px;" loading="lazy">
                                </a>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light text-success" style="height: 240px;">
                                    <i class="fas fa-image fs-1"></i>
                                </div>
                            @endif

                            <div class="card-body p-4">
                                <h3 class="h6 fw-bold text-dark mb-1">{{ $item->judul ?? $item->nama ?? $item->keterangan ?? 'Dokumentasi Sekolah' }}</h3>
                                @if(!empty($item->kategori))
                                    <span class="badge bg-success-subtle text-success small mb-2">{{ $item->kategori }}</span>
                                @endif
                                @if(!empty($item->deskripsi))
                                    <p class="small text-secondary mb-0">{{ $item->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection