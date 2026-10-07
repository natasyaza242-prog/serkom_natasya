@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Data Pengguna</h1>
            <p class="text-slate-500 text-sm">Informasi lengkap akun pengguna sistem.</p>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        {{-- Profile Banner & Avatar Section --}}
        <div class="bg-gradient-to-r from-emerald-800 to-emerald-900 p-8 text-white flex flex-col md:flex-row items-center gap-6">
            <div class="w-24 h-24 rounded-full bg-white/10 border-2 border-white/20 flex items-center justify-center text-3xl font-bold text-white shadow-inner uppercase">
                {{ substr($user->name ?? 'A', 0, 2) }}
            </div>
            <div class="text-center md:text-left space-y-1">
                <h2 class="text-2xl font-bold">{{ $user->name ?? 'Administrator' }}</h2>
                <p class="text-emerald-200 text-sm font-medium">@<span>{{ $user->username ?? 'admin' }}</span></p>
                <div class="pt-1">
                    <span class="inline-block px-3 py-1 bg-emerald-500/30 border border-emerald-400/30 rounded-full text-xs font-semibold uppercase tracking-wider text-emerald-100">
                        {{ $user->role ?? 'Admin' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Detail Information --}}
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Nama Lengkap</span>
                    <p class="text-slate-800 font-medium text-base">{{ $user->name ?? '-' }}</p>
                </div>

                {{-- Username --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Username</span>
                    <p class="text-slate-800 font-medium text-base">{{ $user->username ?? '-' }}</p>
                </div>

                {{-- Alamat Email --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Alamat Email</span>
                    <p class="text-slate-800 font-medium text-base">{{ $user->email ?? '-' }}</p>
                </div>

                {{-- Role / Hak Akses --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Role / Hak Akses</span>
                    <p class="text-slate-800 font-medium text-base">
                        {{ ucfirst($user->role ?? 'Admin') }}
                        <span class="text-xs text-slate-500 font-normal block mt-0.5">
                            {{ ($user->role ?? 'admin') === 'admin' ? '(Akses Penuh Seluruh Sistem)' : '(Akses Terbatas)' }}
                        </span>
                    </p>
                </div>

                {{-- Tanggal Terdaftar --}}
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 md:col-span-2">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Tanggal Terdaftar</span>
                    <p class="text-slate-800 font-medium text-base">
                        {{ isset($user->created_at) ? \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y, H:i') : '-' }}
                    </p>
                </div>
            </div>

            {{-- Bottom Actions --}}
            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('admin.user.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium text-sm hover:bg-slate-50 transition">
                    Kembali
                </a>
                <a href="{{ route('admin.user.show', $user->id) }}" class="px-5 py-2.5 rounded-xl bg-emerald-900 hover:bg-emerald-800 text-white font-medium text-sm flex items-center gap-2 transition">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
    </svg>
    Edit Data User
</a>
            </div>
        </div>
    </div>
</div>
@endsection