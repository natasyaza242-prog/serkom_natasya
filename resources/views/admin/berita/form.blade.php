@extends('layouts.app')

@section('title', isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Halaman (Tombol Kembali Atas Dihapus) -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
            {{ isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru' }}
        </h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola dan publikasikan informasi atau berita terbaru sekolah.</p>
    </div>

    <!-- Alert Error Validasi (Jika Ada) -->
    @if ($errors->any())
        <div class="p-4 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-200">
            <div class="font-semibold mb-1 flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Terdapat kesalahan input:</span>
            </div>
            <ul class="list-disc list-inside space-y-1 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form Utama -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8">
        <form action="{{ route('admin.berita.save', isset($berita) ? Crypt::encrypt($berita->id) : null) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf

            <!-- Judul Berita & Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Judul Berita (2 Kolom) -->
                <div class="md:col-span-2">
                    <label for="judul" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                        Judul Berita <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="judul" 
                           name="judul" 
                           value="{{ old('judul', $berita->judul ?? '') }}" 
                           placeholder="Masukkan judul berita..." 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>

                <!-- Tanggal Berita (1 Kolom) -->
                <div>
                    <label for="tanggal" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                        Tanggal Berita <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" 
                           id="tanggal" 
                           name="tanggal" 
                           value="{{ old('tanggal', isset($berita) ? $berita->tanggal : date('Y-m-d')) }}" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>
            </div>

            <!-- Foto Sampul / Gambar -->
            <div>
                <label for="gambar" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Foto Sampul / Gambar
                </label>
                <div class="relative border-2 border-dashed border-slate-200 hover:border-emerald-400 rounded-2xl p-6 text-center bg-slate-50/30 transition group cursor-pointer">
                    <input type="file" 
                           id="gambar" 
                           name="gambar" 
                           accept="image/*" 
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    
                    <div class="flex flex-col items-center justify-center gap-2">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-emerald-600">Pilih / Upload foto sampul</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, JPEG, PNG (Maksimal 2MB)</p>
                        </div>
                    </div>
                </div>
                
                @if(isset($berita) && $berita->gambar)
                    <p class="text-xs text-slate-500 mt-2">Gambar saat ini: <span class="font-medium text-slate-700">{{ $berita->gambar }}</span></p>
                @endif
            </div>

            <!-- Isi Berita Lengkap -->
            <div>
                <label for="isi" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    Isi Berita Lengkap <span class="text-rose-500">*</span>
                </label>
                <textarea id="isi" 
                          name="isi" 
                          rows="6" 
                          placeholder="Tuliskan isi berita secara lengkap..." 
                          required 
                          class="w-full px-4 py-3 bg-slate-50/50 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">{{ old('isi', $berita->isi ?? '') }}</textarea>
            </div>

            <!-- Tombol Aksi Bawah -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.berita.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-[#0B2319] hover:bg-[#143828] text-white text-sm font-semibold rounded-xl shadow-sm transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    <span>Publikasikan Berita</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection