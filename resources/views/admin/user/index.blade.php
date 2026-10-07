@extends('layouts.app')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Data User</h1>
            <p class="text-slate-500 text-sm">Daftar seluruh pengguna sistem SMPN 1 Mangunreja.</p>
        </div>
        
        {{-- Tombol Tambah User --}}
        <a href="{{ route('admin.user.addEdit') }}" 
           class="bg-emerald-900 hover:bg-emerald-800 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            + Tambah User
        </a>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error --}}
    @if (session('error'))
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Card Main Content --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        {{-- Tabel Data User --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-wider font-semibold text-slate-400">
                        <th class="px-6 py-4 w-16 text-center">NO</th>
                        <th class="px-6 py-4">USERNAME</th>
                        <th class="px-6 py-4">EMAIL</th>
                        <th class="px-6 py-4">ROLE</th>
                        <th class="px-6 py-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($users as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition duration-150">
                            <td class="px-6 py-4 text-slate-500 text-center font-medium">
                                {{ method_exists($users, 'firstItem') ? $users->firstItem() + $index : $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $item->name ?? $item->nama }}</div>
                                <div class="text-xs text-slate-400 font-normal">Username: {{ $item->username }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $item->email }}</td>
                            <td class="px-6 py-4">
                                @if(strtolower($item->role) === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                   {{-- Detail / Lihat --}}
                                    <a href="{{ route('admin.user.show', Crypt::encrypt($item->id)) }}" 
                                         class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition duration-200" title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.user.addEdit', Crypt::encrypt($item->id)) }}" 
                                        class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition duration-200" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                    </a>

                                    {{-- Hapus (Tanpa Crypt) --}}
                                    @if (auth()->id() !== $item->id)
                                        <form action="{{ route('admin.user.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                Tidak ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($users, 'hasPages') && $users->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif

    </div>
</div>
@endsection