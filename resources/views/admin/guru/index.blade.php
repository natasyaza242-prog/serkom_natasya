@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Data Guru</h1>
            <p class="text-slate-500 text-sm">Daftar seluruh tenaga pendidik SMKN 2 Tasikmalaya.</p>
        </div>
        
        {{-- Tombol Tambah Guru hanya untuk Admin --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.guru.addEdit') }}" 
               class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Guru
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex justify-start">
            <form action="{{ route('admin.guru.index') }}" method="GET" class="relative max-w-xs w-full">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari NIP atau Nama..." 
                       class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-wider font-semibold text-slate-400">
                        <th class="px-6 py-4">NIP</th>
                        <th class="px-6 py-4">Nama Guru</th>
                        <th class="px-6 py-4">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($guru as $item)
                        <tr class="hover:bg-slate-50/50 transition duration-150">
                            <td class="px-6 py-4 text-slate-600 font-medium">{{ $item->nip ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-900 font-bold">{{ $item->nama_guru }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $item->mapel }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Tombol Detail / Lihat (Bisa diakses Admin & Operator) --}}
                                    <a href="{{ route('admin.guru.show', Crypt::encrypt($item->id)) }}" 
                                       class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition duration-200" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>

                                    {{-- Tombol Edit & Hapus hanya untuk Admin --}}
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.guru.addEdit', Crypt::encrypt($item->id)) }}" 
                                           class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition duration-200" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.guru.delete', Crypt::encrypt($item->id)) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg transition duration-200" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                                Tidak ada data guru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div>
                Menampilkan {{ $guru->firstItem() ?? 0 }} sampai {{ $guru->lastItem() ?? 0 }} dari {{ $guru->total() }} data
            </div>
            <div>
                {{ $guru->links() }}
            </div>
        </div>
    </div>
</div>
@endsection