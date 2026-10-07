@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Profil Sekolah</h1>
        <p class="text-slate-500 text-sm">Kelola dan perbarui informasi identitas utama sekolah Anda.</p>
    </div>

    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profil-sekolah.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Nama Sekolah --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nama Sekolah *</label>
                    <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
                </div>

                {{-- Kepala Sekolah --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Kepala Sekolah *</label>
                    <input type="text" name="kepala_sekolah" value="{{ old('kepala_sekolah', $profil->kepala_sekolah ?? '') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
                </div>

                {{-- NPSN --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">NPSN *</label>
                    <input type="text" name="npsn" value="{{ old('npsn', $profil->npsn ?? '') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
                </div>

                {{-- Nomor Telepon / Kontak --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nomor Telepon / Kontak *</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $profil->kontak ?? '') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
                </div>

                {{-- Tahun Berdiri --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tahun Berdiri *</label>
                    <input type="text" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
                </div>

                {{-- Alamat Lengkap --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Alamat Lengkap *</label>
                    <textarea name="alamat" rows="3" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                </div>

                {{-- Deskripsi / Sambutan Sekolah --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Deskripsi / Sambutan Sekolah</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                </div>
            </div>

            {{-- Preview & Input Gambar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-2">Logo Sekolah</label>
                    @if(!empty($profil->logo))
                        <div class="mb-3 p-2 border rounded-xl inline-block">
                            <img src="{{ asset('storage/' . $profil->logo) }}" class="h-16 w-auto object-contain">
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase mb-2">Foto Gedung Utama</label>
                    @if(!empty($profil->foto_gedung))
                        <div class="mb-3 p-2 border rounded-xl inline-block">
                            <img src="{{ asset('storage/' . $profil->foto_gedung) }}" class="h-16 w-auto object-cover">
                        </div>
                    @endif
                    <input type="file" name="foto_gedung" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="bg-emerald-900 hover:bg-emerald-800 text-white px-6 py-2.5 rounded-xl font-medium text-sm flex items-center gap-2 transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection