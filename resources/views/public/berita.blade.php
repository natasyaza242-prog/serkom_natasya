@extends('layouts.public')

@section('title', 'Berita Sekolah')

@section('content')
<section class="bg-success text-white py-4 px-3" style="background-color: #0B2319 !important;">
    <div class="container">
        <p class="small text-success-subtle mb-1">
            <a href="{{ route('landing') }}" class="text-success-subtle text-decoration-none">Beranda</a> / Berita
        </p>
        <h1 class="h3 fw-bold mb-1">
            <i class="fas fa-school me-2 text-success"></i> Berita Sekolah
        </h1>
        <p class="small text-light mb-0">Informasi terbaru dan kegiatan SMPN 1 Mangunreja.</p>
    </div>
</section>

<section class="bg-white py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="h2 fw-bold text-dark">Berita Sekolah</h1>
            <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
        </div>

        @if(isset($berita) && $berita->count() > 0)
            <div class="row g-4">
                @foreach($berita as $item)
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                            <div class="bg-light position-relative" style="height: 200px;">
                                @php
                                    $foto = $item->gambar ?? '';
                                    if ($foto != '') {
                                        $foto = str_replace('\\', '/', $foto);
                                        $foto = ltrim($foto, '/');
                                        if (str_starts_with($foto, 'public/')) $foto = substr($foto, 7);
                                        if (str_starts_with($foto, 'storage/')) $foto = substr($foto, 8);
                                        if (!str_contains($foto, '/')) $foto = 'berita/' . $foto;
                                        $urlFoto = asset('storage/' . $foto);
                                    }
                                @endphp

                                @if(!empty($foto))
                                    <img src="{{ $urlFoto }}" alt="{{ $item->judul }}" class="w-100 h-100 object-fit-cover" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-100 h-100 d-none align-items-center justify-content-center text-muted">
                                        <i class="fa-regular fa-image fs-3"></i>
                                    </div>
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-success-subtle">
                                        <i class="fa-regular fa-image fs-1"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="small text-muted mb-2">
                                        <i class="fa-regular fa-calendar me-1"></i>
                                        {{ !empty($item->tanggal) ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : 'Tanggal tidak tersedia' }}
                                    </div>
                                    <h2 class="h5 fw-bold text-dark mb-2 line-clamp-2">{{ $item->judul }}</h2>
                                    <p class="small text-secondary mb-3 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? $item->konten ?? $item->keterangan ?? ''), 120) }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            @if(method_exists($berita, 'links'))
                <div class="d-flex justify-content-center mt-5">
                    {{ $berita->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fa-regular fa-newspaper fs-1 text-muted mb-3 d-block"></i>
                <h3 class="h5 fw-bold text-secondary">Belum Ada Berita</h3>
                <p class="small text-muted">Berita sekolah belum tersedia atau tidak ditemukan.</p>
            </div>
        @endif
    </div>
</section>
@endsection