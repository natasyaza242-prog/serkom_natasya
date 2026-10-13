@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Kelola Berita & Artikel</h1>
            <p class="text-muted small mb-0">Kelola publikasi informasi dan kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.berita.addEdit') }}" class="btn btn-dark rounded-3 px-3 py-2 fw-semibold d-flex align-items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Berita
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-3 mb-4" role="alert">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase fs-7 text-secondary">
                        <tr>
                            <th class="py-3">Berita</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Penulis</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($berita as $item)
                            <tr>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/berita/' . $item->gambar) }}" class="rounded-3 border object-fit-cover" style="width: 48px; height: 48px;" alt="Gambar">
                                        @else
                                            <div class="bg-light rounded-3 border d-flex align-items-center justify-content-center text-muted small" style="width: 48px; height: 48px;">Foto</div>
                                        @endif
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0">{{ $item->judul }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted small">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                                <td><span class="badge bg-light text-secondary border px-2 py-1">{{ $item->penulis ?? 'Administrator' }}</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.berita.addEdit', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('admin.berita.destroy', Crypt::encrypt($item->id)) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Tidak ada data berita.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection