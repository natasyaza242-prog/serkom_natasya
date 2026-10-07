@extends('layouts.app')

@section('title', isset($guru) ? 'Edit Data Guru' : 'Tambah Data Guru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Halaman -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                {{ isset($guru) ? 'Edit Data Guru' : 'Tambah Guru Baru' }}
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">Isi formulir di bawah ini untuk menyimpan data guru.</p>
        </div>
        <a href="{{ route('admin.guru.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8">
        <form action="{{ route('admin.guru.save', isset($guru) ? Crypt::encrypt($guru->id) : null) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- NIP & Nama -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nip" class="block text-sm font-semibold text-slate-700 mb-2">
                        NIP / NUPTK
                    </label>
                    <input type="text" id="nip" name="nip" value="{{ old('nip', $guru->nip ?? '') }}" placeholder="Contoh: 198501152010011" class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="nama_guru" class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Lengkap Guru <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama_guru" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru ?? '') }}" placeholder="Contoh: Ahmad Fauzi, S.Kom." required class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div>
                <label for="mapel" class="block text-sm font-semibold text-slate-700 mb-2">
                    Mata Pelajaran <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="mapel" name="mapel" value="{{ old('mapel', $guru->mapel ?? '') }}" placeholder="Contoh: Informatika" required class="w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>

            <!-- Upload Foto -->
            <div>
                <label for="foto" class="block text-sm font-semibold text-slate-700 mb-2">
                    Foto Profil Guru
                </label>
                <input type="file" id="foto" name="foto" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-start gap-3">
                
                <a href="{{ route('admin.guru.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition">
                    Kembali
                </a>
                <button type="submit" class="px-5 py-2.5 bg-[#0B2319] hover:bg-[#143828] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    Simpan Data Guru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection