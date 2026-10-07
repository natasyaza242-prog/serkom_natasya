@extends('layouts.app')

@section('title', 'Detail Galeri & Dokumentasi')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    {{-- HEADER & BREADCRUMB --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('admin.galeri.index') }}" class="hover:text-emerald-600 transition-colors">Galeri</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                <span class="text-slate-800 font-medium">Detail Dokumentasi</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Detail Galeri & Dokumentasi
            </h1>
        </div>

        {{-- TOMBOL KEMBALI ATAS --}}
        <div>
            <a href="{{ route('admin.galeri.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- KARTU UTAMA DETAIL --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
            
            {{-- PRATINJAU MEDIA (FOTO / VIDEO) --}}
            <div class="lg:col-span-7 bg-slate-950/90 flex items-center justify-center p-4 sm:p-6 min-h-[320px] lg:min-h-[420px]">
                @if($galeri->file)
                    @php
                        $extension = pathinfo($galeri->file, PATHINFO_EXTENSION);
                    @endphp

                    @if(in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                        <video controls class="w-full max-h-[450px] rounded-xl object-contain shadow-lg">
                            <source src="{{ asset('storage/' . $galeri->file) }}" type="video/{{ $extension }}">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $galeri->file) }}"
                             alt="{{ $galeri->judul }}"
                             class="w-full max-h-[450px] rounded-xl object-contain shadow-lg">
                    @endif
                @else
                    <div class="flex flex-col items-center justify-center text-slate-500 gap-2">
                        <i class="fa-solid fa-image text-4xl"></i>
                        <span class="text-xs">File media tidak tersedia</span>
                    </div>
                @endif
            </div>

            {{-- INFORMASI DETAIL --}}
            <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-5">
                    {{-- BADGE KATEGORI --}}
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <i class="fa-solid {{ strtolower($galeri->kategori ?? 'foto') == 'video' ? 'fa-video' : 'fa-image' }}"></i>
                            {{ ucfirst($galeri->kategori ?? 'Foto') }}
                        </span>
                    </div>

                    {{-- JUDUL DOKUMENTASI --}}
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 leading-snug">
                            {{ $galeri->judul }}
                        </h2>
                    </div>

                    <hr class="border-slate-100">

                    {{-- DETAIL PROPERTI --}}
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-calendar-day text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal Kegiatan</p>
                                <p class="font-semibold text-slate-700 mt-0.5">
                                    {{ \Carbon\Carbon::parse($galeri->tanggal ?? $galeri->created_at)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-file-invoice text-xs"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nama File Original</p>
                                <p class="text-xs text-slate-600 mt-0.5 font-mono truncate" title="{{ $galeri->file }}">
                                    {{ $galeri->file ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-align-left text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Keterangan / Deskripsi</p>
                                <p class="text-slate-600 mt-1 leading-relaxed text-sm">
                                    {{ $galeri->keterangan ?? $galeri->deskripsi ?? 'Tidak ada keterangan tambahan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER KARTU & TOMBOL EDIT DI BAWAH --}}
                <div class="pt-4 border-t border-slate-100 space-y-4">
                    <div class="flex items-center justify-between text-xs text-slate-400">
                        <span>Diupload: {{ \Carbon\Carbon::parse($galeri->created_at)->diffForHumans() }}</span>
                    </div>

                    {{-- TOMBOL EDIT GALERI DI SIMPAN DI BAWAH --}}
                    <a href="{{ route('admin.galeri.addEdit', Crypt::encrypt($galeri->id)) }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                        <span>Edit Galeri</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection