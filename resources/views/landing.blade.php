<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_sekolah ?? 'Profil Sekolah' }}</title>
    
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CDN AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="bg-gray-50 text-gray-800 font-sans overflow-x-hidden">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-blue-600">
                        {{ $profil->nama_sekolah ?? 'Nama Sekolah' }}
                    </span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="#profil" class="hover:text-blue-600 font-medium transition">Profil</a>
                    <a href="#ekstrakurikuler" class="hover:text-blue-600 font-medium transition">Ekstrakurikuler</a>
                    <a href="#guru" class="hover:text-blue-600 font-medium transition">Guru</a>
                    <a href="#berita" class="hover:text-blue-600 font-medium transition">Berita</a>
                    <a href="#galeri" class="hover:text-blue-600 font-medium transition">Galeri</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium shadow-sm transition">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- SECTION HERO (id="hero") -->
    <section id="hero" 
        class="relative bg-cover bg-center pt-28 pb-36 text-white" 
        style="background-image: url('{{ !empty($profil->foto_gedung) ? asset('storage/' . $profil->foto_gedung) : 'https://images.unsplash.com/photo-1562774053-701939374585' }}');">
        
        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Konten Utama Hero -->
        <div class="relative max-w-7xl mx-auto px-4 text-center z-10" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-4xl font-extrabold sm:text-6xl mb-4 tracking-tight">
                Selamat Datang di <br><span class="text-blue-400">{{ $profil->nama_sekolah ?? 'Sekolah Kami' }}</span>
            </h1>
            <p class="text-lg sm:text-xl max-w-3xl mx-auto text-gray-200 font-light leading-relaxed">
                {{ $profil->deskripsi ?? 'Pendidikan Berkualitas untuk Masa Depan Cemerlang.' }}
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="#profil" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg transition duration-200 hover:scale-105">
                    Jelajahi Profil
                </a>
            </div>
        </div>
    </section>

    <!-- BANNER STATISTIK (Melayang di bawah Hero) -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 z-20" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
        <div class="bg-blue-700 text-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-2 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-blue-600/60 text-center py-6 px-4">
                
                {{-- Akreditasi --}}
                <div class="p-4 flex flex-col justify-center items-center">
                    <span class="text-3xl lg:text-4xl font-extrabold tracking-tight">A</span>
                    <span class="text-xs sm:text-sm font-medium text-blue-100 mt-1 uppercase">Akreditasi</span>
                </div>

                {{-- Siswa --}}
                <div class="p-4 flex flex-col justify-center items-center">
                    <span class="text-3xl lg:text-4xl font-extrabold tracking-tight">1300+</span>
                    <span class="text-xs sm:text-sm font-medium text-blue-100 mt-1 uppercase">Siswa</span>
                </div>

                {{-- Guru & Staf --}}
                <div class="p-4 flex flex-col justify-center items-center">
                    <span class="text-3xl lg:text-4xl font-extrabold tracking-tight">100+</span>
                    <span class="text-xs sm:text-sm font-medium text-blue-100 mt-1 uppercase">Guru & Staf</span>
                </div>

                {{-- Ekstrakurikuler --}}
                <div class="p-4 flex flex-col justify-center items-center">
                    <span class="text-3xl lg:text-4xl font-extrabold tracking-tight">15+</span>
                    <span class="text-xs sm:text-sm font-medium text-blue-100 mt-1 uppercase">Ekstrakurikuler</span>
                </div>

                {{-- Jurusan / Program --}}
                <div class="p-4 col-span-2 md:col-span-1 flex flex-col justify-center items-center">
                    <span class="text-3xl lg:text-4xl font-extrabold tracking-tight">11</span>
                    <span class="text-xs sm:text-sm font-medium text-blue-100 mt-1 uppercase">Jurusan</span>
                </div>

            </div>
        </div>
    </div>

    <!-- SECTION PROFIL SEKOLAH (id="profil") -->
<section id="profil" class="pt-20 pb-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Judul Section --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold text-slate-800 uppercase tracking-wider">Profil Sekolah</h2>
            <div class="w-16 h-1 bg-blue-600 mx-auto mt-2 rounded-full"></div>
        </div>

        {{-- Grid Utama: Kartu Kepala Sekolah & Detail Informasi --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch mb-12">
            
            {{-- 1. Kartu Kepala Sekolah + Sambutan Singkat --}}
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 text-center flex flex-col items-center justify-between" data-aos="fade-right" data-aos-duration="800">
                <div class="w-full flex flex-col items-center">
                    <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-blue-500/20 shadow-md mb-4 bg-slate-100">
                        <img src="{{ !empty($profil->foto_kepala) ? asset('storage/' . $profil->foto_kepala) : asset('images/kepala-sekolah.png') }}" 
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($profil->kepala_sekolah ?? 'Dendin Wirdina') }}&background=0D8ABC&color=fff';" 
                             alt="Foto Kepala Sekolah" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">{{ $profil->kepala_sekolah ?? 'Dendin Wirdina, S.Pd., M.M.' }}</h3>
                    <span class="inline-block bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full mt-1 border border-blue-100">
                        Kepala Sekolah
                    </span>
                </div>

                {{-- Kutipan Sambutan --}}
                <div class="mt-6 bg-slate-50 p-4 rounded-xl border border-slate-100 text-xs text-slate-600 italic text-left relative">
                    <span class="text-blue-500 font-bold text-lg leading-none absolute -top-2 left-3">“</span>
                    <p class="pt-1">
                        {{ $profil->sambutan ?? 'Selamat datang di website resmi SMPN 1 Mangunreja. Kami berkomitmen untuk mewujudkan lingkungan belajar yang inovatif, berkarakter, dan berdaya saing global.' }}
                    </p>
                </div>
            </div>

            {{-- 2. Detail Informasi Sekolah & Grid Spesifikasi --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-slate-100 p-6 md:p-8 flex flex-col justify-between" data-aos="fade-left" data-aos-duration="800">
                <div>
                    <div class="flex justify-between items-center border-b pb-3 mb-4">
                        <h3 class="text-xl font-bold text-slate-800">Tentang {{ $profil->nama_sekolah ?? 'SMPN 1 Mangunreja' }}</h3>
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $profil->status ?? 'Negeri' }}
                        </span>
                    </div>

                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ $profil->deskripsi ?? 'Lingkungan belajar modern dengan tenaga pendidik profesional untuk membentuk karakter, kedisiplinan, dan kompetensi unggul pada setiap siswa.' }}
                    </p>
                </div>

                {{-- Grid Detail Lengkap (2 Baris x 4 Kolom) --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">NPSN</span>
                        <span class="font-bold text-slate-800 text-xs sm:text-sm">{{ $profil->npsn ?? '20210890' }}</span>
                    </div>

                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">Tahun Berdiri</span>
                        <span class="font-bold text-slate-800 text-xs sm:text-sm">{{ $profil->tahun_berdiri ?? '2000' }}</span>
                    </div>

                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">Akreditasi</span>
                        <span class="font-bold text-blue-600 text-xs sm:text-sm">{{ $profil->akreditasi ?? 'A (Sangat Baik)' }}</span>
                    </div>

                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">Kurikulum</span>
                        <span class="font-bold text-slate-800 text-xs sm:text-sm">{{ $profil->kurikulum ?? 'Kurikulum Merdeka' }}</span>
                    </div>

                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">Telepon</span>
                        <span class="font-bold text-slate-800 text-xs">{{ $profil->kontak ?? '0897654212345' }}</span>
                    </div>

                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">Email</span>
                        <span class="font-bold text-slate-800 text-xs truncate block" title="{{ $profil->email ?? 'info@smpn1mangunreja.sch.id' }}">
                            {{ $profil->email ?? 'info@smpn1mangunreja.sch.id' }}
                        </span>
                    </div>

                    <div class="p-2 bg-white rounded-lg border border-slate-100 shadow-2xs col-span-2">
                        <span class="block text-[10px] font-bold uppercase text-slate-400">Alamat Lengkap</span>
                        <span class="font-bold text-slate-800 text-xs line-clamp-1" title="{{ $profil->alamat ?? 'Jl. Kalapasewu / Jl. Kaum Tengah No. 12, Mangunreja' }}">
                            {{ $profil->alamat ?? 'Jl. Kalapasewu / Jl. Kaum Tengah No. 12' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        {{-- 3. Kartu Visi & Misi --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white rounded-2xl shadow-lg p-6 md:p-8" data-aos="fade-up" data-aos-duration="800">
            <h3 class="text-2xl font-bold mb-4 flex items-center gap-2 border-b border-blue-500/50 pb-3">
                <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Visi & Misi Sekolah
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-blue-50 text-sm md:text-base leading-relaxed">
                <div class="bg-blue-800/40 p-4 rounded-xl border border-blue-400/20">
                    <h4 class="font-bold text-white text-lg mb-2">Visi:</h4>
                    <p class="italic">
                        "{{ $profil->visi ?? 'Terwujudnya Peserta Didik yang Beralamat Mulia, Cerdas, Terampil, Mandiri, dan Berwawasan Lingkungan.' }}"
                    </p>
                </div>
                <div class="bg-blue-800/40 p-4 rounded-xl border border-blue-400/20">
                    <h4 class="font-bold text-white text-lg mb-2">Misi Utama:</h4>
                    <ul class="list-disc list-inside space-y-1 text-xs md:text-sm">
                        <li>Menyelenggarakan pembelajaran berkualitas berbasis karakter.</li>
                        <li>Mengembangkan minat dan bakat siswa melalui ektrakurikuler.</li>
                        <li>Menciptakan lingkungan sekolah yang bersih, asri, dan kondusif.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Guru & Staf -->
    <section id="guru" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Guru & Staf Pengajar</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($guru as $key => $item)
                    <div class="bg-white rounded-lg shadow p-4 text-center hover:shadow-md transition duration-300" data-aos="zoom-in" data-aos-delay="{{ $key * 50 }}">
                        <img src="{{ !empty($item->foto) ? asset('storage/' . $item->foto) : 'https://via.placeholder.com/150' }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                        <h4 class="font-bold text-lg">{{ $item->nama }}</h4>
                        <p class="text-sm text-gray-500">{{ $item->jabatan ?? $item->mata_pelajaran }}</p>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-4">Belum ada data guru.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Ekstrakurikuler -->
    <section id="ekstrakurikuler" class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Ekstrakurikuler</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($ekstrakurikuler as $key => $item)
                    <div class="bg-white p-6 rounded-xl shadow-md border hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="{{ $key * 100 }}">
                        @if(!empty($item->foto))
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-40 object-cover rounded-md mb-4" alt="{{ $item->nama }}">
                        @endif
                        <h3 class="text-xl font-bold mb-2">{{ $item->nama }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($item->deskripsi, 100) }}</p>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Belum ada data ekstrakurikuler.</p>
                @endforelse
            </div>
        </div>
    </section>


    <!-- Berita Terkini -->
    <section id="berita" class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Berita Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($berita as $key => $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300" data-aos="fade-up" data-aos-delay="{{ $key * 100 }}">
                        @if(!empty($item->gambar))
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <span class="text-xs text-gray-400 mb-2 block">{{ $item->created_at->format('d M Y') }}</span>
                            <h3 class="font-bold text-xl mb-2">{{ $item->judul }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($item->konten), 120) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Belum ada berita terbaru.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section id="galeri" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Galeri Kegiatan</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($galeri as $key => $item)
                    <div class="overflow-hidden rounded-lg shadow-md group" data-aos="zoom-in" data-aos-delay="{{ $key * 50 }}">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300" alt="{{ $item->judul ?? 'Galeri' }}">
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Belum ada foto galeri.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? 'Sekolah' }}. All rights reserved.</p>
            <p class="text-sm text-gray-400 mt-2">{{ $profil->alamat ?? '' }} | {{ $profil->kontak ?? $profil->telepon ?? '' }}</p>
        </div>
    </footer>

    <!-- CDN AOS (Animate On Scroll) JavaScript -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({
            once: true, // Animasi hanya berjalan sekali saat di-scroll
            duration: 800, // Durasi animasi (ms)
            easing: 'ease-in-out',
        });
    </script>

</body>
</html>