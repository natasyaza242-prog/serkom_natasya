@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Berita & Artikel</h1>
            <p class="text-slate-500 text-sm">Kelola publikasi informasi dan kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.berita.addEdit') }}" 
           class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-xl text-sm font-medium transition duration-200 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Berita
        </a>
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
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

            <!-- Form Search Instant (Awalan Kata) -->
            <div class="relative max-w-xs w-full">
                <span class="absolute left-3 top-2.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>

                <input type="text" 
                       id="clientSearchInput"
                       placeholder="Cari judul berita..." 
                       autocomplete="off"
                       class="w-full pl-9 pr-8 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">

                <button type="button" 
                        id="clearSearchBtn" 
                        class="hidden absolute right-3 top-2.5 text-slate-400 hover:text-slate-600" 
                        title="Bersihkan">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[11px] uppercase tracking-wider font-semibold text-slate-400">
                        <th class="px-6 py-4">Berita</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="beritaTableBody" class="divide-y divide-slate-100 text-sm">
                    @forelse ($berita as $item)
                        <tr class="berita-row hover:bg-slate-50/50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" class="w-12 h-12 object-cover rounded-lg border border-slate-100" alt="Gambar">
                                    @else
                                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 text-xs">
                                            Gambar
                                        </div>
                                    @endif
                                    <div>
                                        <p class="berita-judul font-bold text-slate-900 line-clamp-1">{{ $item->judul }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs whitespace-nowrap">
                                {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-medium rounded-md">
                                    {{ $item->penulis ?? 'Administrator' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.berita.addEdit', Crypt::encrypt($item->id)) }}" 
                                       class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition duration-200" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.berita.delete', Crypt::encrypt($item->id)) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg transition duration-200" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Tombol Detail (Modal) -->
                                    <button type="button" 
                                            onclick="showDetail('{{ addslashes($item->judul) }}', '{{ $item->penulis ?? 'Administrator' }}', '{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}', '{{ asset($item->gambar ?? '') }}', '{{ route('admin.berita.show', Crypt::encrypt($item->id)) }}')"
                                            class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition duration-200 flex items-center justify-center" 
                                            title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                                Tidak ada data berita.
                            </td>
                        </tr>
                    @endforelse
                    
                    <tr id="noMatchRow" class="hidden">
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                            Tidak ada berita yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div>
                Menampilkan {{ $berita->firstItem() ?? 0 }} sampai {{ $berita->lastItem() ?? 0 }} dari {{ $berita->total() }} data
            </div>
            <div>
                {{ $berita->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Pop-up Detail Berita -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-xl border border-slate-100">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800 text-base">Detail Berita</h3>
            <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>
        <div class="p-6 space-y-4">
            <div id="modalImageContainer" class="w-full h-48 rounded-xl bg-slate-100 overflow-hidden border border-slate-100 hidden">
                <img id="modalImage" src="" class="w-full h-full object-cover" alt="Gambar Berita">
            </div>
            <div>
                <span id="modalDate" class="text-xs text-slate-400 font-medium"></span>
                <h2 id="modalTitle" class="text-lg font-bold text-slate-900 mt-1"></h2>
                <p class="text-xs text-slate-500 mt-1">Penulis: <span id="modalAuthor" class="font-semibold text-slate-700"></span></p>
            </div>
        </div>
        <div class="p-4 border-t border-slate-100 flex justify-between items-center bg-slate-50/50">
            <a id="modalFullLink" href="#" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 hover:underline">Halaman Selengkapnya &rarr;</a>
            <button onclick="closeDetailModal()" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl text-xs font-medium transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Script Instant Live Search (Awalan Kata) & Modal Detail -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("clientSearchInput");
        const clearBtn = document.getElementById("clearSearchBtn");
        const rows = document.querySelectorAll(".berita-row");
        const noMatchRow = document.getElementById("noMatchRow");

        if (searchInput) {
            searchInput.addEventListener("input", function () {
                const keyword = this.value.toLowerCase().trim();

                if (keyword !== "") {
                    clearBtn.classList.remove("hidden");
                } else {
                    clearBtn.classList.add("hidden");
                }

                let hasVisibleRow = false;

                rows.forEach(row => {
                    const judulElement = row.querySelector(".berita-judul");
                    if (judulElement) {
                        const judulText = judulElement.innerText.toLowerCase().trim();
                        
                        // HANYA MUNCUL JIKA JUDUL DIAWALI OLEH KATA KUNCI (startsWith)
                        if (judulText.startsWith(keyword)) {
                            row.style.display = "";
                            hasVisibleRow = true;
                        } else {
                            row.style.display = "none";
                        }
                    }
                });

                if (noMatchRow) {
                    if (!hasVisibleRow && rows.length > 0) {
                        noMatchRow.classList.remove("hidden");
                    } else {
                        noMatchRow.classList.add("hidden");
                    }
                }
            });

            clearBtn.addEventListener("click", function () {
                searchInput.value = "";
                searchInput.dispatchEvent(new Event("input"));
                searchInput.focus();
            });
        }
    });

    function showDetail(title, author, date, imageSrc, fullUrl) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalAuthor').innerText = author;
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modalFullLink').href = fullUrl;

        const imgContainer = document.getElementById('modalImageContainer');
        const imgElement = document.getElementById('modalImage');

        if (imageSrc && !imageSrc.endsWith('/')) {
            imgElement.src = imageSrc;
            imgContainer.classList.remove('hidden');
        } else {
            imgContainer.classList.add('hidden');
        }

        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection