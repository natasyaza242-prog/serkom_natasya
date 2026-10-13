@extends('layouts.public')

@section('title', 'Ekstrakurikuler')

@section('content')

<section class="bg-success text-white py-4 px-3" style="background-color: #0B2319 !important;">
    <div class="container">
        <p class="small text-success-subtle mb-1">
            <a href="{{ route('landing') }}" class="text-success-subtle text-decoration-none">Beranda</a> / Ekstrakurikuler
        </p>
        <h1 class="h3 fw-bold mb-1">
            <i class="fas fa-school me-2 text-success"></i> Ekstrakurikuler
        </h1>
        <p class="small text-light mb-0">Kembangkan bakat dan potensi terbaik melalui berbagai kegiatan sekolah.</p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="h3 fw-bold text-dark">Pilihan Ekstrakurikuler</h2>
            <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
        </div>

        {{-- FILTER KATEGORI --}}
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
            <button type="button" onclick="filterEkskul('semua', this)" class="btn btn-sm btn-success rounded-3 px-3 py-2 filter-btn fw-semibold">Semua</button>
            @foreach($ekstrakurikuler->pluck('kategori')->filter()->unique() as $kategori)
                <button type="button" onclick="filterEkskul('{{ strtolower($kategori) }}', this)" class="btn btn-sm btn-outline-success rounded-3 px-3 py-2 filter-btn fw-semibold">{{ $kategori }}</button>
            @endforeach
        </div>

        @if($ekstrakurikuler->count() > 0)
            <div class="row g-4">
                @foreach($ekstrakurikuler as $item)
                    @php
                        $foto = $item->foto ?? $item->gambar ?? null;
                        if ($foto) {
                            if (\Illuminate\Support\Str::startsWith($foto, ['http://', 'https://'])) {
                                $fotoUrl = $foto;
                            } else {
                                $foto = ltrim($foto, '/');
                                $foto = preg_replace('#^(public/|storage/)#', '', $foto);
                                $fotoUrl = asset('storage/' . $foto);
                            }
                        } else {
                            $fotoUrl = null;
                        }
                        $kategoriItem = strtolower($item->kategori ?? 'lainnya');
                    @endphp

                    <div class="col-md-6 col-lg-4 ekskul-card" data-kategori="{{ $kategoriItem }}">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                            <div class="bg-light" style="height: 200px;">
                                @if($fotoUrl)
                                    <img src="{{ $fotoUrl }}" alt="{{ $item->nama ?? 'Ekskul' }}" class="w-100 h-100 object-fit-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-100 h-100 d-none align-items-center justify-content-center text-success">
                                        <i class="fa-solid fa-people-group fs-1"></i>
                                    </div>
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-success">
                                        <i class="fa-solid fa-people-group fs-1"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                    <h3 class="h5 fw-bold text-dark mb-0">{{ $item->nama ?? $item->nama_ekskul ?? 'Ekstrakurikuler' }}</h3>
                                    @if($item->kategori)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle small">{{ $item->kategori }}</span>
                                    @endif
                                </div>
                                <p class="small text-secondary mb-3">{{ $item->deskripsi ?? $item->keterangan ?? 'Kegiatan untuk mengembangkan minat dan bakat siswa.' }}</p>
                                @if($item->pembina ?? false)
                                    <div class="small text-muted"><i class="fa-solid fa-user-tie text-success me-1"></i> Pembina: {{ $item->nama_guru }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-light rounded-4">
                <i class="fa-solid fa-people-group fs-1 text-success mb-3 d-block"></i>
                <h3 class="h5 fw-bold text-dark">Belum Ada Data Ekstrakurikuler</h3>
                <p class="small text-muted">Data ekstrakurikuler yang ditambahkan akan tampil di sini.</p>
            </div>
        @endif
    </div>
</section>

<script>
    function filterEkskul(kategori, tombol) {
        const kartu = document.querySelectorAll('.ekskul-card');
        const tombolFilter = document.querySelectorAll('.filter-btn');

        tombolFilter.forEach(btn => {
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-success');
        });

        tombol.classList.remove('btn-outline-success');
        tombol.classList.add('btn-success');

        kartu.forEach(item => {
            const kategoriItem = item.dataset.kategori;
            item.style.display = (kategori === 'semua' || kategoriItem === kategori) ? '' : 'none';
        });
    }
</script>
@endsection