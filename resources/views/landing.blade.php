@extends('layouts.public')

@section('title', 'Beranda - ' . ($profil->nama_sekolah ?? 'SMPN 1 Mangunreja'))

@section('content')

    <!-- ================= HERO ================= -->
    <section id="hero" class="position-relative text-white py-5 d-flex align-items-center" 
             style="background: linear-gradient(rgba(5,17,12,0.8), rgba(5,17,12,0.8)), url('{{ !empty($profil->foto_gedung) ? asset('storage/' . $profil->foto_gedung) : 'https://images.unsplash.com/photo-1562774053-701939374585' }}') center/cover no-repeat; min-height: 65vh;">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-extrabold mb-3 text-white">
                Selamat Datang di<br>
                <span class="text-success">{{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</span>
            </h1>
            <p class="lead fs-5 text-light mx-auto opacity-90" style="max-width: 750px;">
                {{ $profil->deskripsi ?? 'Pendidikan Berkualitas untuk Masa Depan Cemerlang.' }}
            </p>
        </div>
    </section>

    <!-- ================= STATISTIK ================= -->
    <div class="container" style="margin-top: -45px; position: relative; z-index: 10;">
        <div class="card bg-success text-white border-0 shadow rounded-4 p-4" style="background-color: #0B2319 !important;">
            <div class="row text-center g-3">
                <div class="col-6 col-md-3 border-end border-success-subtle">
                    <h3 class="fw-bold text-warning display-6 mb-1">{{ $profil->akreditasi ?? 'A' }}</h3>
                    <span class="small text-uppercase text-light opacity-75 fw-semibold">Akreditasi</span>
                </div>
                <div class="col-6 col-md-3 border-end border-success-subtle">
                    <h3 class="fw-bold display-6 mb-1">{{ $jumlahSiswa ?? 0 }}</h3>
                    <span class="small text-uppercase text-light opacity-75 fw-semibold">Siswa</span>
                </div>
                <div class="col-6 col-md-3 border-end border-success-subtle">
                    <h3 class="fw-bold display-6 mb-1">{{ $jumlahGuru ?? 0 }}</h3>
                    <span class="small text-uppercase text-light opacity-75 fw-semibold">Guru & Staf</span>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="fw-bold display-6 mb-1">{{ $jumlahEkskul ?? 0 }}</h3>
                    <span class="small text-uppercase text-light opacity-75 fw-semibold">Ekstrakurikuler</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= PROFIL SEKOLAH ================= -->
    <section id="profil" class="py-5 bg-light">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase text-dark h3">Profil Sekolah</h2>
                <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
            </div>

            <div class="row g-4 align-items-stretch mb-5">
                <!-- Kepala Sekolah -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="rounded-circle overflow-hidden border border-success border-3 mx-auto mb-3 bg-light shadow-sm" style="width: 130px; height: 130px;">
                                <img src="{{ !empty($profil->foto_kepala) ? asset('storage/' . $profil->foto_kepala) : asset('images/kepala-sekolah.png') }}" class="w-100 h-100 object-fit-cover" alt="Kepala Sekolah">
                            </div>
                            <h4 class="fw-bold fs-5 text-dark mb-1">{{ $profil->kepala_sekolah ?? 'Dendin Wirdina S.Pd.M.M.' }}</h4>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill small">Kepala Sekolah</span>
                        </div>
                        <div class="mt-4 bg-light p-3 rounded-3 text-start small text-muted fst-italic position-relative">
                            <p class="mb-0">{{ $profil->sambutan ?? 'Selamat datang di website resmi SMPN 1 Mangunreja.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Sekolah -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                                <h3 class="fw-bold fs-4 text-dark mb-0">Tentang Sekolah</h3>
                                <span class="badge bg-success text-white px-3 py-1">{{ $profil->status ?? 'Negeri' }}</span>
                            </div>
                            <p class="text-muted small lh-lg mb-4">
                                {{ $profil->deskripsi ?? 'Lingkungan belajar modern dengan tenaga pendidik profesional untuk membentuk karakter dan kompetensi siswa.' }}
                            </p>
                        </div>

                        <div class="row g-2 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-2 bg-light rounded-3 border">
                                    <span class="d-block text-muted fw-bold text-uppercase" style="font-size: 10px;">NPSN</span>
                                    <span class="fw-bold text-dark small d-block">{{ $profil->npsn ?? '20210890' }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-2 bg-light rounded-3 border">
                                    <span class="d-block text-muted fw-bold text-uppercase" style="font-size: 10px;">BERDIRI</span>
                                    <span class="fw-bold text-dark small d-block">{{ $profil->tahun_berdiri ?? '1967' }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-2 bg-light rounded-3 border">
                                    <span class="d-block text-muted fw-bold text-uppercase" style="font-size: 10px;">AKREDITASI</span>
                                    <span class="fw-bold text-success small d-block">{{ $profil->akreditasi ?? 'A' }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="p-2 bg-light rounded-3 border">
                                    <span class="d-block text-muted fw-bold text-uppercase" style="font-size: 10px;">KONTAK</span>
                                    <span class="fw-bold text-dark small d-block">{{ $profil->kontak ?? '0897654212345' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visi Misi -->
            <div class="card border-0 text-white rounded-4 p-4 p-md-5 shadow" style="background-color: #0B2319;">
                <h3 class="h4 fw-bold mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-bullseye text-success"></i> Visi & Misi Sekolah
                </h3>
                <div class="row g-4 text-light">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 h-100" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <h5 class="fw-bold text-success mb-2">Visi:</h5>
                            <p class="small fst-italic mb-0">"{{ $profil->visi ?? 'Terwujudnya Peserta Didik yang Berakhlak Mulia, Cerdas, Terampil, Mandiri, dan Berwawasan Lingkungan.' }}"</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 h-100" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <h5 class="fw-bold text-success mb-2">Misi Utama:</h5>
                            <ul class="small ps-3 mb-0">
                                <li>Menyelenggarakan pembelajaran berkualitas berbasis karakter.</li>
                                <li>Mengembangkan minat dan bakat siswa melalui ekstrakurikuler.</li>
                                <li>Menciptakan lingkungan sekolah yang bersih, asri, dan kondusif.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= GURU & STAF ================= -->
    @if(isset($guru) && $guru->count() > 0)
    <section id="guru" class="py-5 bg-white">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase text-dark h3">Guru & Staf Pengajar</h2>
                <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
            </div>
            <div class="row g-4">
                @foreach($guru->take(4) as $item)
                    @php
                        $foto = $item->foto ?? null;
                        $fotoUrl = $foto ? (\Illuminate\Support\Str::startsWith($foto, ['http://', 'https://']) ? $foto : asset('storage/' . ltrim($foto, '/'))) : null;
                    @endphp
                    <div class="col-sm-6 col-md-3">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden text-center p-3">
                            @if($fotoUrl)
                                <img src="{{ $fotoUrl }}" alt="Guru" class="rounded-circle border border-success border-2 mx-auto mb-3 object-fit-cover shadow-sm" style="width: 100px; height: 100px;">
                            @else
                                <div class="rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px;">
                                    <i class="fas fa-user-tie fs-3"></i>
                                </div>
                            @endif
                            <h5 class="fw-bold fs-6 text-dark mb-1">{{ $item->nama ?? $item->nama_guru }}</h5>
                            <p class="small text-success fw-semibold mb-0">{{ $item->mata_pelajaran ?? $item->mapel ?? 'Guru Pengajar' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ================= EKSTRAKURIKULER ================= -->
    @if(isset($ekstrakurikuler) && $ekstrakurikuler->count() > 0)
    <section id="ekstrakurikuler" class="py-5 bg-light">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase text-dark h3">Ekstrakurikuler</h2>
                <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
            </div>
            <div class="row g-4">
                @foreach($ekstrakurikuler->take(4) as $item)
                    @php
                        $fotoEkskul = $item->foto ?? $item->gambar ?? null;
                        $fotoEkskulUrl = $fotoEkskul ? asset('storage/' . ltrim($fotoEkskul, '/')) : null;
                    @endphp
                    <div class="col-sm-6 col-md-3">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden text-center p-3">
                            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center mx-auto mb-3 overflow-hidden border border-success" style="width: 90px; height: 90px;">
                                @if($fotoEkskulUrl)
                                    <img src="{{ $fotoEkskulUrl }}" alt="Ekskul" class="w-100 h-100 object-fit-cover">
                                @else
                                    <i class="fas fa-people-group fs-4"></i>
                                @endif
                            </div>
                            <h5 class="fw-bold fs-6 text-dark mb-1">{{ $item->nama ?? $item->nama_ekskul ?? $item->nama_ekstrakurikuler }}</h5>
                            <p class="small text-secondary mb-0 text-truncate">{{ $item->deskripsi ?? 'Kegiatan pengembangan bakat.' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ================= BERITA TERBARU ================= -->
    @if(isset($berita) && $berita->count() > 0)
    <section id="berita" class="py-5 bg-white">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase text-dark h3">Berita Terbaru</h2>
                <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
            </div>
            <div class="row g-4">
                @foreach($berita->take(3) as $item)
                    @php
                        $gambarBerita = $item->gambar ? asset('storage/berita/' . $item->gambar) : null;
                    @endphp
                    <div class="col-md-4">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                            <div class="bg-light" style="height: 180px;">
                                @if($gambarBerita)
                                    <img src="{{ $gambarBerita }}" alt="Berita" class="w-100 h-100 object-fit-cover">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="fa-regular fa-image fs-2"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <span class="small text-muted d-block mb-2">
                                    <i class="fa-regular fa-calendar me-1"></i> {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                </span>
                                <h5 class="fw-bold fs-6 text-dark mb-2 text-truncate">{{ $item->judul }}</h5>
                                <p class="small text-secondary mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? $item->konten ?? ''), 90) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ================= GALERI SEKOLAH ================= -->
    @if(isset($galeri) && $galeri->count() > 0)
    <section id="galeri" class="py-5 bg-light">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase text-dark h3">Galeri Sekolah</h2>
                <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
            </div>
            <div class="row g-4">
                @foreach($galeri->take(3) as $item)
                    @php
                        $fileGaleri = $item->file ?? $item->gambar ?? $item->foto ?? null;
                        $fileGaleriUrl = $fileGaleri ? asset('storage/' . ltrim($fileGaleri, '/')) : null;
                    @endphp
                    <div class="col-md-4">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                            @if($fileGaleriUrl)
                                <img src="{{ $fileGaleriUrl }}" alt="Galeri" class="w-100 object-fit-cover" style="height: 200px;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light text-success" style="height: 200px;">
                                    <i class="fas fa-image fs-2"></i>
                                </div>
                            @endif
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-dark mb-0 text-truncate">{{ $item->judul ?? $item->nama ?? 'Dokumentasi' }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ================= FORM UJIKOM ================= -->
    <section id="ujikom" class="py-5 bg-white">
        <div class="container py-3" style="max-width: 900px;">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase text-dark h3">Form Simulasi Ujikom</h2>
                <div class="mx-auto bg-success rounded-pill mt-2" style="width: 60px; height: 4px;"></div>
            </div>
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
                <div class="mb-4">
                    <label for="nama_siswa" class="form-label fw-semibold text-dark small">Nama Siswa</label>
                    <input type="text" id="nama_siswa" placeholder="Masukkan nama siswa" class="form-control rounded-3 py-2">
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="nilai1" class="form-label fw-semibold text-dark small">Nilai 1</label>
                        <input type="number" id="nilai1" min="0" max="100" placeholder="0 - 100" oninput="hitungNilai()" class="form-control rounded-3 py-2">
                    </div>
                    <div class="col-md-4">
                        <label for="nilai2" class="form-label fw-semibold text-dark small">Nilai 2</label>
                        <input type="number" id="nilai2" min="0" max="100" placeholder="0 - 100" oninput="hitungNilai()" class="form-control rounded-3 py-2">
                    </div>
                    <div class="col-md-4">
                        <label for="nilai3" class="form-label fw-semibold text-dark small">Nilai 3</label>
                        <input type="number" id="nilai3" min="0" max="100" placeholder="0 - 100" oninput="hitungNilai()" class="form-control rounded-3 py-2">
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Rata-rata Nilai</label>
                        <div id="rataRata" class="p-3 bg-light border rounded-3 fw-bold text-dark">0</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-dark small">Status Kelulusan</label>
                        <div id="status" class="p-3 bg-light border rounded-3 fw-bold text-secondary">Belum dihitung</div>
                    </div>
                </div>
                <div class="alert alert-success rounded-3 small mb-4">
                    <strong>Keterangan:</strong> Siswa dinyatakan <strong>Lulus</strong> jika rata-rata nilai <strong>lebih dari 75</strong>.
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" onclick="resetForm()" class="btn btn-dark px-4 py-2 rounded-3 fw-semibold" style="background-color: #0B2319;">Reset</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        function hitungNilai() {
            const nilai1 = document.getElementById('nilai1').value;
            const nilai2 = document.getElementById('nilai2').value;
            const nilai3 = document.getElementById('nilai3').value;

            const rataRata = document.getElementById('rataRata');
            const status = document.getElementById('status');

            if (nilai1 === '' || nilai2 === '' || nilai3 === '') {
                rataRata.textContent = '0';
                status.textContent = 'Belum dihitung';
                status.className = 'p-3 bg-light border rounded-3 fw-bold text-secondary';
                return;
            }

            const hasil = (Number(nilai1) + Number(nilai2) + Number(nilai3)) / 3;
            rataRata.textContent = hasil.toFixed(2);

            if (hasil > 75) {
                status.textContent = 'LULUS';
                status.className = 'p-3 bg-success-subtle border border-success text-success rounded-3 fw-bold';
            } else {
                status.textContent = 'TIDAK LULUS';
                status.className = 'p-3 bg-danger-subtle border border-danger text-danger rounded-3 fw-bold';
            }
        }

        function resetForm() {
            document.getElementById('nama_siswa').value = '';
            document.getElementById('nilai1').value = '';
            document.getElementById('nilai2').value = '';
            document.getElementById('nilai3').value = '';

            document.getElementById('rataRata').textContent = '0';
            const status = document.getElementById('status');
            status.textContent = 'Belum dihitung';
            status.className = 'p-3 bg-light border rounded-3 fw-bold text-secondary';
        }
    </script>

@endsection