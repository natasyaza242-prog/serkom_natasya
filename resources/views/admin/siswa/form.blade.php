@extends('layouts.app')

@section('title', isset($siswa) ? 'Edit Data Siswa' : 'Tambah Data Siswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Halaman (Tombol Kembali Atas Dihapus) -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
            {{ isset($siswa) ? 'Edit Data Siswa' : 'Form Tambah Data Siswa Baru' }}
        </h1>
        <p class="text-sm text-slate-500 mt-0.5">Isi formulir di bawah ini untuk menyimpan data siswa.</p>
    </div>

    <!-- Alert Validasi Error -->
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
        <form action="{{ route('admin.siswa.save', isset($siswa) ? Crypt::encrypt($siswa->id) : null) }}" method="POST" class="space-y-6">
            @csrf

            <!-- NISN & Nama Lengkap -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nisn" class="block text-sm font-semibold text-slate-700 mb-2">
                        NISN (10 Digit Angka) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="nisn" 
                           name="nisn" 
                           maxlength="10" 
                           value="{{ old('nisn', $siswa->nisn ?? '') }}" 
                           placeholder="Contoh: 0071234567" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>

                <div>
                    <label for="nama_siswa" class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Lengkap Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama_siswa" 
                           name="nama_siswa" 
                           value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}" 
                           placeholder="Contoh: Muhammad Farhan" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>
            </div>

            <!-- Jenis Kelamin -->
<div>
    <label class="block text-sm font-semibold text-slate-700 mb-2">
        Jenis Kelamin <span class="text-rose-500">*</span>
    </label>
    <div class="flex items-center gap-6 pt-2">
        <label class="inline-flex items-center gap-2 cursor-pointer text-sm text-slate-700">
            <input type="radio" 
                   name="jenis_kelamin" 
                   value="Laki-Laki" 
                   {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? 'Laki-Laki') == 'Laki-Laki' ? 'checked' : '' }} 
                   class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 border-slate-300">
            <span>Laki-Laki</span>
        </label>
        <label class="inline-flex items-center gap-2 cursor-pointer text-sm text-slate-700">
            <input type="radio" 
                   name="jenis_kelamin" 
                   value="Perempuan" 
                   {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }} 
                   class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 border-slate-300">
            <span>Perempuan</span>
        </label>
    </div>
</div>

                <div>
                    <label for="tahun_masuk" class="block text-sm font-semibold text-slate-700 mb-2">
                        Tahun Masuk / Angkatan <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" 
                           id="tahun_masuk" 
                           name="tahun_masuk" 
                           value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? date('Y')) }}" 
                           placeholder="Contoh: 2026" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>
            </div>

            <!-- Tombol Aksi Bawah -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.siswa.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                    Kembali
                </a>
                <button type="submit" class="px-5 py-2.5 bg-[#0B2319] hover:bg-[#143828] text-white text-sm font-semibold rounded-xl shadow-sm transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Data Siswa</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection