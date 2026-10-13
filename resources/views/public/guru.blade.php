@extends('layouts.public')

@section('title', 'Data Guru')

@section('content')
<section class="bg-success text-white py-4 px-3" style="background-color: #0B2319 !important;">
    <div class="container">
        <p class="small text-success-subtle mb-1">
            <a href="{{ route('landing') }}" class="text-success-subtle text-decoration-none">Beranda</a> / Guru
        </p>
        <h1 class="h3 fw-bold mb-1">
            <i class="fas fa-school me-2 text-success"></i> Guru & Staf Pengajar
        </h1>
        <p class="small text-light mb-0">Kenali guru dan tenaga pendidik kami.</p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h3 fw-bold text-dark">Data Guru & Staf Pengajar</h2>
            <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
        </div>

        @if($guru->isEmpty())
            <div class="text-center py-5 bg-light rounded-4">
                <i class="fas fa-users fs-1 text-success mb-3 d-block"></i>
                <p class="small text-muted">Data guru belum tersedia.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($guru as $item)
                    @php
                        $foto = $item->foto ?? null;
                        $fotoUrl = $foto ? (\Illuminate\Support\Str::startsWith($foto, ['http://', 'https://']) ? $foto : asset('storage/' . ltrim($foto, '/'))) : null;
                    @endphp

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden text-center">
                            @if($fotoUrl)
                                <img src="{{ $fotoUrl }}" alt="{{ $item->nama ?? 'Foto Guru' }}" class="w-100 object-fit-cover" style="height: 250px;" loading="lazy">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light text-success" style="height: 250px;">
                                    <i class="fas fa-user-tie fs-1"></i>
                                </div>
                            @endif

                            <div class="card-body p-3">
                                <h3 class="h6 fw-bold text-dark mb-1">{{ $item->nama ?? $item->nama_guru ?? 'Nama Guru' }}</h3>
                                @if(!empty($item->jabatan))
                                    <p class="small fw-semibold text-success mb-1">{{ $item->jabatan }}</p>
                                @endif
                                @if(!empty($item->mata_pelajaran ?? $item->mapel))
                                    <p class="small text-secondary mb-0">{{ $item->mata_pelajaran ?? $item->mapel }}</p>
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