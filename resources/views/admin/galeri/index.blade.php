@extends('layouts.app')

@section('title', 'Galeri & Dokumentasi')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Kelola Galeri & Dokumentasi
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">
                Koleksi dokumentasi foto dan video aktivitas sekolah.
            </p>
        </div>

        <a href="{{ route('admin.galeri.addEdit') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#0B2319] hover:bg-[#143828] text-white text-sm font-semibold rounded-xl shadow-sm transition-all duration-200">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Galeri</span>
        </a>
    </div>

    {{-- PESAN --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 text-rose-700 border border-rose-200">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 text-rose-700 border border-rose-200">
            <p class="font-semibold mb-2">Data belum berhasil disimpan:</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABEL GALERI --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

        {{-- SEARCH --}}
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.galeri.index') }}"
                  method="GET"
                  id="searchForm"
                  class="flex flex-col sm:flex-row items-center justify-between gap-3 w-full">

                <div class="relative max-w-xs w-full sm:w-auto sm:min-w-[260px]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

                    <input type="text"
                           name="search"
                           id="searchInput"
                           value="{{ request('search') }}"
                           placeholder="Cari dokumentasi (Tekan Enter)..."
                           class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                </div>
            </form>
        </div>

        {{-- ISI TABEL --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-6">Dokumentasi</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Tanggal</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">

                    @forelse($galeri as $item)

                        @php
                            $file = str_replace('\\', '/', $item->file ?? '');
                            $fileUrl = '';
                            $extension = '';

                            if ($file !== '') {
                                if (str_starts_with($file, 'http://') ||
                                    str_starts_with($file, 'https://')) {

                                    $fileUrl = $file;

                                } else {
                                    $file = ltrim($file, '/');

                                    if (str_starts_with($file, 'public/')) {
                                        $file = substr($file, 7);
                                    }

                                    if (str_starts_with($file, 'storage/')) {
                                        $file = substr($file, 8);
                                    }

                                    if (!str_starts_with($file, 'galeri/')) {
                                        $file = 'galeri/' . $file;
                                    }

                                    $fileUrl = asset('storage/' . $file);
                                }

                                $extension = strtolower(
                                    pathinfo(
                                        parse_url($fileUrl, PHP_URL_PATH) ?? '',
                                        PATHINFO_EXTENSION
                                    )
                                );
                            }

                            $isVideo =
                                strtolower($item->kategori ?? '') === 'video'
                                || in_array(
                                    $extension,
                                    ['mp4', 'webm', 'ogg', 'mov']
                                );
                        @endphp

                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- DOKUMENTASI --}}
                            <td class="py-3.5 px-6 max-w-md">
                                <div class="flex items-center gap-3">

                                    @if($fileUrl !== '')

                                        @if($isVideo)

                                            <div class="w-12 h-12 rounded-xl bg-slate-900 text-white flex items-center justify-center flex-shrink-0 border border-slate-200 shadow-sm overflow-hidden relative">

                                                <video src="{{ $fileUrl }}"
                                                       class="w-full h-full object-cover"
                                                       muted
                                                       preload="metadata"></video>

                                                <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                                    <i class="fa-solid fa-video text-xs text-white"></i>
                                                </div>
                                            </div>

                                        @else

                                            <img src="{{ $fileUrl }}"
                                                 alt="{{ $item->judul }}"
                                                 loading="lazy"
                                                 class="w-12 h-12 rounded-xl object-cover border border-slate-200/80 shadow-sm flex-shrink-0"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                            <div style="display:none"
                                                 class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 border border-slate-200 flex-shrink-0 items-center justify-center">
                                                <i class="fa-solid fa-image text-lg"></i>
                                            </div>

                                        @endif

                                    @else

                                        <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 border border-slate-200 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-image text-lg"></i>
                                        </div>

                                    @endif

                                    <div class="min-w-0">
                                        <p class="font-semibold text-slate-800 leading-tight truncate">
                                            {{ $item->judul }}
                                        </p>

                                        <p class="text-xs text-slate-400 mt-1 line-clamp-1">
                                            {{ $item->keterangan ?: '-' }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            {{-- KATEGORI --}}
                            <td class="py-3.5 px-6 text-slate-600 text-xs font-medium whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">

                                    <i class="fa-solid {{ strtolower($item->kategori ?? 'foto') === 'video' ? 'fa-video' : 'fa-image' }} text-[10px]"></i>

                                    {{ ucfirst($item->kategori ?: 'Foto') }}

                                </span>
                            </td>

                            {{-- TANGGAL --}}
                            <td class="py-3.5 px-6 text-slate-600 text-xs font-medium whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->translatedFormat('d M Y') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="py-3.5 px-6 text-center">
                                <div class="inline-flex items-center justify-center gap-1.5">

                                    <a href="{{ route('admin.galeri.show', Crypt::encrypt($item->id)) }}"
                                       title="Detail"
                                       class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-200 border border-blue-100 flex items-center justify-center">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>

                                    <a href="{{ route('admin.galeri.addEdit', Crypt::encrypt($item->id)) }}"
                                       title="Edit Galeri"
                                       class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white transition-all duration-200 border border-amber-100 flex items-center justify-center">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <form action="{{ route('admin.galeri.destroy', Crypt::encrypt($item->id)) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Hapus Galeri"
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
                                <i class="fa-solid fa-images text-2xl text-slate-300 mb-2 block"></i>
                                Data galeri tidak ditemukan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($galeri, 'hasPages') && $galeri->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $galeri->links() }}
            </div>
        @endif

    </div>
</div>

{{-- PENCARIAN DENGAN ENTER --}}
<script>
    document.getElementById('searchInput').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            document.getElementById('searchForm').submit();
        }
    });
</script>
@endsection