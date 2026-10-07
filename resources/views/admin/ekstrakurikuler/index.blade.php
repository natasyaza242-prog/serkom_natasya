@extends('layouts.app')

@section('title', 'Ekstrakurikuler')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Kelola Ekstrakurikuler
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">
                Daftar kegiatan pengembangan bakat dan minat siswa.
            </p>
        </div>
        <a href="{{ route('admin.ekstrakurikuler.addEdit') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#0B2319] hover:bg-[#143828] text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Ekskul</span>
        </a>
    </div>

    {{-- KONTEN TABEL --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        {{-- FILTER & SEARCH BAR --}}
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            {{-- Form Pencarian & Per Page (Menggunakan justify-between agar kiri-kanan) --}}
            <form action="{{ route('admin.ekstrakurikuler.index') }}"
                  method="GET"
                  id="searchForm"
                  class="flex flex-col sm:flex-row items-center justify-between gap-3 w-full">

                {{-- Input Cari (Sebelah Kanan) --}}
                <div class="relative max-w-xs w-full sm:w-auto sm:min-w-[260px]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text"
                           name="search"
                           id="searchInput"
                           value="{{ request('search') }}"
                           placeholder="Cari nama ekskul..."
                           autofocus
                           onfocus="var val=this.value; this.value=''; this.value=val;"
                           class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>
            </form>
        </div>

        {{-- TABEL --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-6">Ekstrakurikuler</th>
                        <th class="py-3.5 px-6">Nama Pembina</th>
                        <th class="py-3.5 px-6">Jadwal Latihan</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($ekstrakurikuler as $item)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        {{-- EKSTRAKURIKULER --}}
                        <td class="py-3.5 px-6 max-w-md">
                            <div class="flex items-center gap-3">
                                {{-- GAMBAR --}}
                                @php
                                    $imagePath = $item->gambar ?? $item->foto;
                                @endphp
                                @if($imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}"
                                         alt="{{ $item->nama_ekskul }}"
                                         class="w-12 h-12 rounded-xl object-cover border border-slate-200/80 shadow-sm flex-shrink-0">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 border border-slate-200 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-trophy text-lg"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 leading-tight truncate">
                                        {{ $item->nama_ekskul }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1 line-clamp-1">
                                        {{ $item->deskripsi ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- NAMA PEMBINA --}}
                        <td class="py-3.5 px-6 text-slate-600 text-xs font-medium whitespace-nowrap">
                            @if($item->guru)
                                {{ $item->guru->nama_guru ?? $item->guru->nama ?? 'Belum ada nama' }}
                            @else
                                {{ $item->nama_pembina ?? 'Belum ada pembina' }}
                            @endif
                        </td>

                        {{-- JADWAL LATIHAN --}}
                        <td class="py-3.5 px-6 text-slate-600 text-xs font-medium">
                            {{ $item->jadwal_latihan ?? '-' }}
                        </td>

                        {{-- AKSI --}}
                        <td class="py-3.5 px-6 text-center">
                            <div class="inline-flex items-center justify-center gap-1.5">
                                {{-- DETAIL --}}
                                <a href="{{ route('admin.ekstrakurikuler.show', Crypt::encrypt($item->id)) }}"
                                   title="Detail"
                                   class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-200 border border-blue-100 flex items-center justify-center">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.ekstrakurikuler.addEdit', Crypt::encrypt($item->id)) }}"
                                   title="Edit Ekskul"
                                   class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all duration-200 border border-amber-100 flex items-center justify-center">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ route('admin.ekstrakurikuler.delete', Crypt::encrypt($item->id)) }}"
                                      method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="Hapus Ekskul"
                                            class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all duration-200 border border-rose-100 flex items-center justify-center">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-400 text-sm">
                            <i class="fa-solid fa-trophy text-2xl text-slate-300 mb-2 block"></i>
                            Data ekstrakurikuler tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($ekstrakurikuler->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $ekstrakurikuler->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    // Debounce function agar form pencarian otomatis terkirim 500ms setelah selesai mengetik
    let timeout = null;
    document.getElementById('searchInput').addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            document.getElementById('searchForm').submit();
        }, 500);
    });
</script>
@endsection