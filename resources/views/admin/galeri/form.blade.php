@extends('layouts.app')

@section('title', $galeri ? 'Edit Dokumentasi Galeri' : 'Tambah Dokumentasi Galeri')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    <!-- JUDUL HALAMAN -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            {{ $galeri ? 'Form Edit Dokumentasi Galeri' : 'Form Tambah Dokumentasi Galeri' }}
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Tambahkan dokumentasi kegiatan atau informasi sekolah.
        </p>
    </div>


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
            action="{{ $galeri
                ? route('admin.galeri.save', ['id' => \Illuminate\Support\Facades\Crypt::encrypt($galeri->id)])
                : route('admin.galeri.save') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <!-- ISI FORM -->
            <div class="p-6 space-y-6">


                <!-- JUDUL -->
                <div>

                    <label
                        for="judul"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Judul Kegiatan / Dokumentasi
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul', $galeri->judul ?? '') }}"
                        maxlength="50"
                        placeholder="Maksimal 50 karakter"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 @error('judul') border-red-500 @enderror"
                    >

                    @error('judul')
                        <p class="text-sm text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- KATEGORI DAN TANGGAL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    <!-- KATEGORI -->
                    <div>

                        <label
                            for="kategori"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Kategori Media
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="kategori"
                            name="kategori"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 @error('kategori') border-red-500 @enderror"
                        >

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option
                                value="Foto"
                                {{ old('kategori', $galeri->kategori ?? '') == 'Foto' ? 'selected' : '' }}
                            >
                                Foto (Gambar)
                            </option>

                            <option
                                value="Video"
                                {{ old('kategori', $galeri->kategori ?? '') == 'Video' ? 'selected' : '' }}
                            >
                                Video
                            </option>

                        </select>

                        @error('kategori')
                            <p class="text-sm text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- TANGGAL -->
                    <div>

                        <label
                            for="tanggal"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Tanggal Dokumentasi
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old('tanggal', $galeri->tanggal ?? date('Y-m-d')) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 @error('tanggal') border-red-500 @enderror"
                        >

                        @error('tanggal')
                            <p class="text-sm text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                <!-- FILE DOKUMENTASI -->
                <div>

                    <label
                        for="file"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        File Dokumentasi (Foto/Video)
                        @if (!$galeri)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>


                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 hover:border-emerald-400 transition">

                        <div class="flex flex-col md:flex-row md:items-center gap-4">

                            <!-- ICON -->
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">

                                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>

                            </div>


                            <!-- INPUT -->
                            <div class="flex-1">

                                <input
                                    type="file"
                                    id="file"
                                    name="file"
                                    accept=".jpg,.jpeg,.png,.mp4"
                                    class="w-full text-sm text-slate-600
                                    file:mr-4
                                    file:py-2.5
                                    file:px-4
                                    file:rounded-lg
                                    file:border-0
                                    file:bg-emerald-50
                                    file:text-emerald-700
                                    file:font-semibold
                                    hover:file:bg-emerald-100"
                                >


                                <p class="text-xs text-slate-500 mt-2">
                                    Mendukung format:
                                    JPG, JPEG, PNG, MP4
                                    (Maksimal 10MB).
                                </p>


                                @if ($galeri && $galeri->file)

                                    <p class="text-xs text-emerald-600 mt-2">
                                        <i class="fa-solid fa-check mr-1"></i>
                                        File saat ini sudah tersedia.
                                    </p>

                                    <p class="text-xs text-slate-500 mt-1">
                                        Kosongkan jika tidak ingin mengganti file.
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>


                    @error('file')
                        <p class="text-sm text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- KETERANGAN -->
                <div>

                    <label
                        for="keterangan"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Keterangan / Deskripsi Dokumentasi
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        rows="5"
                        placeholder="Tuliskan keterangan singkat kegiatan..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none resize-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 @error('keterangan') border-red-500 @enderror"
                    >{{ old('keterangan', $galeri->keterangan ?? '') }}</textarea>

                    @error('keterangan')
                        <p class="text-sm text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            <!-- BAGIAN TOMBOL -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-end gap-3">


                <!-- TOMBOL KEMBALI -->
                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-100 transition"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali

                </a>


                <!-- TOMBOL SIMPAN -->
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition shadow-sm"
                >

                    <i class="fa-solid fa-upload"></i>

                    {{ $galeri ? 'Simpan Perubahan' : 'Unggah Dokumentasi' }}

                </button>

            </div>

        </form>

    </div>

</div>

@endsection