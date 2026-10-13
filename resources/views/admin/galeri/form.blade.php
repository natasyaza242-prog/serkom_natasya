
@extends('layouts.app')

@section('title', isset($galeri) && $galeri ? 'Edit Dokumentasi Galeri' : 'Tambah Dokumentasi Galeri')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- JUDUL HALAMAN -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            {{ isset($galeri) && $galeri ? 'Form Edit Dokumentasi Galeri' : 'Form Tambah Dokumentasi Galeri' }}
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Tambahkan dokumentasi kegiatan atau informasi sekolah.
        </p>
    </div>

    <!-- PESAN BERHASIL ATAU GAGAL -->
    @if (session('success'))
        <div class="p-4 rounded-xl bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 rounded-xl bg-red-100 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-100 text-red-700">
            <p class="font-semibold">Data belum berhasil disimpan:</p>
            <ul class="list-disc ml-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- CARD FORM -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <!-- HEADER CARD -->
        <div class="px-6 py-5 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div>
                    <h2 class="font-bold text-slate-800">
                        Dokumentasi Galeri
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Isi data dokumentasi dengan lengkap.
                    </p>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <form
            action="{{ isset($galeri) && $galeri
                ? route('admin.galeri.store', $galeri->id)
                : route('admin.galeri.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <!-- ISI FORM -->
            <div class="p-6 space-y-6">

                <!-- JUDUL -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">
                        Judul Kegiatan / Dokumentasi
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul', $galeri->judul ?? '') }}"
                        maxlength="255"
                        placeholder="Masukkan judul kegiatan"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
                    >
                </div>

                <!-- KATEGORI -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="kategori"
                        name="kategori"
                        required
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700"
                    >
                        <option value="Foto"
                            {{ old('kategori', $galeri->kategori ?? 'Foto') == 'Foto' ? 'selected' : '' }}>
                            Foto
                        </option>
                        <option value="Video"
                            {{ old('kategori', $galeri->kategori ?? '') == 'Video' ? 'selected' : '' }}>
                            Video
                        </option>
                    </select>
                </div>

                <!-- TANGGAL -->
                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-slate-700 mb-2">
                        Tanggal Dokumentasi
                    </label>

                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        value="{{ old('tanggal', isset($galeri) && $galeri->tanggal ? \Illuminate\Support\Carbon::parse($galeri->tanggal)->format('Y-m-d') : date('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700"
                    >
                </div>

                <!-- FILE FOTO / VIDEO -->
                <div>
                    <label for="file" class="block text-sm font-semibold text-slate-700 mb-2">
                        File Gambar / Foto / Video

                        @if (!isset($galeri) || !$galeri || !$galeri->file)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 hover:border-emerald-400 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                            </div>

                            <div class="flex-1">
                                <input
                                    type="file"
                                    id="file"
                                    name="file"
                                    accept=".jpg,.jpeg,.png,.gif,.webp,.mp4,.webm,.ogg,.mov"
                                    {{ (!isset($galeri) || !$galeri || !$galeri->file) ? 'required' : '' }}
                                    class="w-full text-sm text-slate-600"
                                >

                                <p class="text-xs text-slate-500 mt-2">
                                    Format foto: JPG, JPEG, PNG, GIF, WEBP.
                                    Format video: MP4, WEBM, OGG, MOV.
                                    Maksimal 20 MB.
                                </p>

                                @if (isset($galeri) && $galeri && $galeri->file)
                                    <p class="text-xs text-emerald-600 mt-2">
                                        File saat ini: {{ basename($galeri->file) }}.
                                        Kosongkan jika tidak ingin menggantinya.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KETERANGAN -->
                <div>
                    <label for="keterangan" class="block text-sm font-semibold text-slate-700 mb-2">
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        rows="4"
                        placeholder="Masukkan keterangan dokumentasi"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700"
                    >{{ old('keterangan', $galeri->keterangan ?? '') }}</textarea>
                </div>

            </div>

            <!-- TOMBOL -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-end gap-3">

                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-100 transition"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition shadow-sm"
                >
                    <i class="fa-solid fa-upload"></i>
                    {{ isset($galeri) && $galeri ? 'Simpan Perubahan' : 'Unggah Dokumentasi' }}
                </button>

            </div>
        </form>
    </div>
</div>
@endsection