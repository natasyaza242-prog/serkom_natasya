
@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Data Guru
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">
                Daftar seluruh tenaga pendidik sekolah.
            </p>
        </div>

        <!-- Tombol Tambah Guru hanya untuk Admin -->
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.guru.addEdit') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#0B2319] hover:bg-[#143828] text-white text-sm font-semibold rounded-xl shadow-sm transition">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Guru</span>
            </a>
        @endif
    </div>

    <!-- Alert Notifikasi -->
    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-3">
            <i class="fa-regular fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-2xl flex items-center gap-3">
            <i class="fa-regular fa-circle-xmark text-base"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Card Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">

        <!-- Filter & Search -->
        <div class="p-4 border-b border-slate-100 flex items-center justify-between gap-4">
            <form action="{{ route('admin.guru.index') }}"
                  method="GET"
                  class="relative w-full max-w-xs">

                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari NIP atau Nama..."
                       class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500">
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5">NIP</th>
                        <th class="px-6 py-3.5">Foto</th>
                        <th class="px-6 py-3.5">Nama Guru</th>
                        <th class="px-6 py-3.5">Mata Pelajaran</th>
                        <th class="px-6 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">

                    @forelse ($guru as $item)
                        <tr class="hover:bg-slate-50/50 transition">

                            <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-600">
                                {{ $item->nip ?? '-' }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!empty($item->foto))
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         alt="{{ $item->nama_guru }}"
                                         class="w-10 h-10 object-cover rounded-full border border-slate-200 shadow-sm">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                        {{ strtoupper(substr($item->nama_guru, 0, 2)) }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-900">
                                {{ $item->nama_guru }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                {{ $item->mapel }}
                            </td>

                            <!-- Tombol Aksi -->
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">

                                <!-- Detail: Admin dan Operator -->
                                <a href="{{ route('admin.guru.show', Crypt::encrypt($item->id)) }}"
                                   class="text-sky-600 hover:text-sky-800 p-1"
                                   title="Lihat Detail">
                                    <i class="fa-regular fa-eye"></i>
                                </a>

                                <!-- Edit dan Hapus: Admin saja -->
                                @if(auth()->user()->role === 'admin')

                                    <a href="{{ route('admin.guru.addEdit', Crypt::encrypt($item->id)) }}"
                                       class="text-amber-600 hover:text-amber-800 p-1"
                                       title="Edit Guru">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('admin.guru.destroy', Crypt::encrypt($item->id)) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-rose-600 hover:text-rose-800 p-1"
                                                title="Hapus Guru">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>

                                @endif

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-8 text-center text-slate-400 text-sm">
                                Data guru belum tersedia.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($guru->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $guru->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
