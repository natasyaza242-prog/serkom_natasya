@extends('layouts.app')

@section('title', 'Detail Ekstrakurikuler')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    {{-- HEADER & BREADCRUMB --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="hover:text-emerald-600 transition-colors">Ekstrakurikuler</a>
                <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                <span class="text-slate-800 font-medium">Detail Ekstrakurikuler</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Detail Ekstrakurikuler
            </h1>
        </div>

        {{-- TOMBOL KEMBALI ATAS --}}
        <div>
            <a href="{{ route('admin.ekstrakurikuler.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- KARTU UTAMA DETAIL --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
            
            {{-- PRATINJAU LOGO / FOTO EKSKUL --}}
            <div class="lg:col-span-5 bg-slate-950/90 flex items-center justify-center p-6 min-h-[280px] lg:min-h-[380px]">
                @if($ekstrakurikuler->foto || $ekstrakurikuler->logo || $ekstrakurikuler->gambar || $ekstrakurikuler->file)
                    @php
                        $imagePath = $ekstrakurikuler->foto ?? $ekstrakurikuler->logo ?? $ekstrakurikuler->gambar ?? $ekstrakurikuler->file;
                    @endphp
                    <img src="{{ asset('storage/' . $imagePath) }}"
                         alt="{{ $ekstrakurikuler->nama_ekskul ?? $ekstrakurikuler->nama }}"
                         class="w-full max-h-[350px] rounded-xl object-contain shadow-lg">
                @else
                    <div class="flex flex-col items-center justify-center text-slate-500 gap-2">
                        <i class="fa-solid fa-trophy text-5xl"></i>
                        <span class="text-xs">Foto/Logo tidak tersedia</span>
                    </div>
                @endif
            </div>

            {{-- INFORMASI DETAIL --}}
            <div class="lg:col-span-7 p-6 sm:p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-5">
                    {{-- NAMA EKSTRAKURIKULER --}}
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60 mb-2">
                            <i class="fa-solid fa-trophy text-[10px]"></i> Ekstrakurikuler
                        </span>
                        <h2 class="text-2xl font-bold text-slate-900 leading-snug">
                            {{ $ekstrakurikuler->nama_ekskul ?? $ekstrakurikuler->nama }}
                        </h2>
                    </div>

                    <hr class="border-slate-100">

                    {{-- DETAIL PROPERTI --}}
                    <div class="space-y-4 text-sm">
                        {{-- GURU PEMBINA --}}
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-user-tie text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Guru Pembina</p>
                                <p class="font-semibold text-slate-700 mt-0.5">
                                    {{ 
                                        $ekstrakurikuler->guru->nama_guru 
                                        ?? $ekstrakurikuler->guru->nama 
                                        ?? $ekstrakurikuler->pembina 
                                        ?? $ekstrakurikuler->nama_pembina 
                                        ?? $ekstrakurikuler->guru_pembina 
                                        ?? '-' 
                                    }}
                                </p>
                            </div>
                        </div>

                        {{-- JADWAL PERTEMUAN --}}
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-clock text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Jadwal Latihan</p>
                                <p class="font-semibold text-slate-700 mt-0.5">
                                    @if(!empty($ekstrakurikuler->hari) || !empty($ekstrakurikuler->jam) || !empty($ekstrakurikuler->waktu))
                                        {{ $ekstrakurikuler->hari }} {{ $ekstrakurikuler->jam ?? $ekstrakurikuler->waktu }}
                                    @elseif(!empty($ekstrakurikuler->jadwal))
                                        {{ $ekstrakurikuler->jadwal }}
                                    @elseif(!empty($ekstrakurikuler->jadwal_kegiatan))
                                        {{ $ekstrakurikuler->jadwal_kegiatan }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- DESKRIPSI KEGIATAN --}}
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-align-left text-xs"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Deskripsi Kegiatan</p>
                                <p class="text-slate-600 mt-1 leading-relaxed text-sm">
                                    {{ $ekstrakurikuler->deskripsi ?? $ekstrakurikuler->keterangan ?? 'Tidak ada deskripsi kegiatan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER KARTU & TOMBOL EDIT DI BAWAH --}}
                <div class="pt-4 border-t border-slate-100 space-y-4">
                    <div class="flex items-center justify-between text-xs text-slate-400">
                        <span>Dibuat: {{ \Carbon\Carbon::parse($ekstrakurikuler->created_at)->diffForHumans() }}</span>
                    </div>

                    {{-- TOMBOL EDIT --}}
                    <a href="{{ route('admin.ekstrakurikuler.addEdit', Crypt::encrypt($ekstrakurikuler->id)) }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                        <span>Edit Data Ekskul</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection