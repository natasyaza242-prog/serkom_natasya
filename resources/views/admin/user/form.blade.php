@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    {{-- Header & Tombol Kembali --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                {{ isset($user) ? 'Edit Data User' : 'Tambah User Baru' }}
            </h1>
            <p class="text-slate-500 text-sm">
                {{ isset($user) ? 'Ubah informasi pengguna sistem.' : 'Lengkapi formulir di bawah ini untuk menambahkan pengguna baru.' }}
            </p>
        </div>
    </div>

    {{-- Card Form --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8">
        <form action="{{ isset($user) ? route('admin.user.store', Crypt::encrypt($user->id)) : route('admin.user.store') }}" 
            method="POST" 
            class="space-y-5">
            @csrf

            {{-- Nama Pengguna --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">
                    Nama Pengguna <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name ?? $user->nama ?? '') }}" 
                       placeholder="Contoh: Ahmad Fauzi" 
                       required
                       class="w-full px-4 py-2.5 border @error('name') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                @error('name')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">
                    Alamat Email <span class="text-rose-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email ?? '') }}" 
                       placeholder="Contoh: user@sekolah.sch.id" 
                       required
                       class="w-full px-4 py-2.5 border @error('email') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                @error('email')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Username --}}
            <div>
                <label for="username" class="block text-sm font-semibold text-slate-700 mb-1">
                    Username <span class="text-slate-400 font-normal text-xs">(Maksimal 30 karakter)</span>
                </label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="{{ old('username', $user->username ?? '') }}" 
                       placeholder="Kosongkan jika ingin dibuat otomatis dari nama" 
                       class="w-full px-4 py-2.5 border @error('username') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                @error('username')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role / Hak Akses --}}
            <div>
                <label for="role" class="block text-sm font-semibold text-slate-700 mb-1">
                    Role / Hak Akses <span class="text-rose-500">*</span>
                </label>
                <select id="role" 
                        name="role" 
                        required
                        class="w-full px-4 py-2.5 border @error('role') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm bg-white text-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
                        Admin (Akses Penuh Seluruh Sistem)
                    </option>
                    <option value="operator" {{ old('role', $user->role ?? '') == 'operator' ? 'selected' : '' }}>
                        Operator (Akses Pengelolaan Data Terbatas)
                    </option>
                </select>
                @error('role')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">
                    Password {{ isset($user) ? '' : '*' }}
                    @if(isset($user))
                        <span class="text-slate-400 font-normal text-xs">(Kosongkan jika tidak ingin mengubah password)</span>
                    @endif
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       placeholder="{{ isset($user) ? 'Masukkan password baru...' : 'Minimal 6 karakter' }}" 
                       {{ isset($user) ? '' : 'required' }}
                       class="w-full px-4 py-2.5 border @error('password') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                @error('password')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.user.index') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-medium transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2 shadow-sm shadow-emerald-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Data User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection