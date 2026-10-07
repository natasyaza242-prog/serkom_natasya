@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Page & Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Data Siswa</h1>
            <p class="text-slate-500 text-sm">Informasi lengkap profil dan identitas siswa.</p>
        </div>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-6">
        
        <!-- Profile Photo / Avatar & Info Header -->
        <div class="flex flex-col items-center text-center pb-6 border-b border-slate-100">
            @if (!empty($siswa->foto) && Storage::exists('public/' . $siswa->foto))
                <img src="{{ asset('storage/' . $siswa->foto) }}" 
                     alt="{{ $siswa->nama_siswa }}" 
                     class="w-28 h-28 object-cover rounded-full border-4 border-emerald-100 shadow-md mb-3">
            @elseif (!empty($siswa->foto) && file_exists(public_path('uploads/siswa/' . $siswa->foto)))
                <img src="{{ asset('uploads/siswa/' . $siswa->foto) }}" 
                     alt="{{ $siswa->nama_siswa }}" 
                     class="w-28 h-28 object-cover rounded-full border-4 border-emerald-100 shadow-md mb-3">
            @else
                <div class="w-24 h-24 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center border-2 border-emerald-100 shadow-sm mb-3">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            @endif

            <h2 class="text-xl font-bold text-slate-900">{{ $siswa->nama_siswa }}</h2>
            <span class="mt-1 px-3 py-1 bg-slate-100 text-slate-600 text-xs font-mono font-medium rounded-full">
                NISN: {{ $siswa->nisn }}
            </span>
        </div>

        <!-- Detail Data Table / Grid -->
        <div class="py-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-3 border-b border-slate-100 text-sm">
                <span class="font-semibold text-slate-500">NISN</span>
                <span class="md:col-span-2 font-mono font-medium text-slate-900">{{ $siswa->nisn }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-3 border-b border-slate-100 text-sm">
                <span class="font-semibold text-slate-500">Nama Lengkap</span>
                <span class="md:col-span-2 font-medium text-slate-900">{{ $siswa->nama_siswa }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-3 border-b border-slate-100 text-sm">
                <span class="font-semibold text-slate-500">Jenis Kelamin</span>
                <div class="md:col-span-2">
                    @if ($siswa->jenis_kelamin == 'Laki-Laki')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-md border border-blue-100">
                            Laki-Laki
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 text-xs font-medium rounded-md border border-rose-100">
                            Perempuan
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-3 border-b border-slate-100 text-sm">
                <span class="font-semibold text-slate-500">Tahun Masuk / Angkatan</span>
                <span class="md:col-span-2 text-slate-900">{{ $siswa->tahun_masuk }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 py-3 text-sm">
                <span class="font-semibold text-slate-500">Tanggal Terdaftar</span>
                <span class="md:col-span-2 text-slate-900">
                    {{ $siswa->created_at ? $siswa->created_at->format('d F Y, H:i') : '-' }}
                </span>
            </div>
        </div>

        <!-- Footer Action Buttons -->
        <div class="pt-6 border-t border-slate-100 flex items-center justify-between gap-4">
            <a href="{{ route('admin.siswa.index') }}" 
               class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>

            {{-- Tombol Edit HANYA Tampil untuk Admin --}}
            @if(strtolower(auth()->user()->role) === 'admin')
                <a href="{{ route('admin.siswa.addEdit', Crypt::encrypt($siswa->id)) }}" 
                   class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Data Siswa
                </a>
            @endif
        </div>
    </div>
</div>
@endsection