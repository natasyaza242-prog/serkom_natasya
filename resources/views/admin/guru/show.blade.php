@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Page & Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Informasi Guru</h1>
            <p class="text-slate-500 text-sm">Informasi lengkap data tenaga pendidik.</p>
        </div>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-6">
        
        <!-- Profile Header with Photo / Initial -->
        <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
            @if (!empty($guru->foto))
                @php
                    // Normalisasi path foto agar selalu mengarah dengan benar ke public/storage
                    $fotoPath = $guru->foto;
                    if (!str_starts_with($fotoPath, 'http') && !str_starts_with($fotoPath, 'storage/')) {
                        $fotoPath = 'storage/' . ltrim($fotoPath, '/');
                    }
                @endphp
                <img src="{{ asset($fotoPath) }}" 
                     alt="{{ $guru->nama_guru }}" 
                     class="w-24 h-24 object-cover rounded-2xl border-2 border-emerald-100 shadow-md"
                     onerror="this.onerror=null; this.remove(); document.getElementById('avatar-fallback').classList.remove('hidden');">
                
                <!-- Fallback jika image link broken / file terhapus -->
                <div id="avatar-fallback" class="hidden w-24 h-24 bg-emerald-700 text-white font-bold text-2xl rounded-2xl flex items-center justify-center border-2 border-emerald-100 shadow-sm">
                    {{ strtoupper(substr($guru->nama_guru ?? 'G', 0, 2)) }}
                </div>
            @else
                <!-- Fallback jika foto belum pernah diunggah -->
                <div class="w-24 h-24 bg-emerald-700 text-white font-bold text-2xl rounded-2xl flex items-center justify-center border-2 border-emerald-100 shadow-sm">
                    {{ strtoupper(substr($guru->nama_guru ?? 'G', 0, 2)) }}
                </div>
            @endif

            <div class="text-center sm:text-left space-y-1">
                <h2 class="text-xl font-bold text-slate-900">{{ $guru->nama_guru }}</h2>
                <p class="text-slate-500 text-sm font-mono">NIP: {{ $guru->nip ?? '-' }}</p>
                <div class="pt-1">
                    <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-full text-xs font-medium">
                        {{ $guru->mapel ?? 'Tenaga Pendidik' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detail Grid Data Guru -->
        <div class="py-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 bg-slate-50/60 rounded-xl border border-slate-100">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">Nama Lengkap</span>
                <span class="text-sm font-semibold text-slate-800">{{ $guru->nama_guru }}</span>
            </div>

            <div class="p-4 bg-slate-50/60 rounded-xl border border-slate-100">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">NIP / NUPTK</span>
                <span class="text-sm font-mono font-semibold text-slate-800">{{ $guru->nip ?? '-' }}</span>
            </div>

            <div class="p-4 bg-slate-50/60 rounded-xl border border-slate-100 md:col-span-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block mb-1">Mata Pelajaran</span>
                <span class="text-sm font-semibold text-slate-800">{{ $guru->mapel ?? '-' }}</span>
            </div>
        </div>

        <!-- Footer Action Buttons -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-4">
            <a href="{{ route('admin.guru.index') }}" 
               class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection