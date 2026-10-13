@extends('layouts.app')

@section('title', isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru')

@section('content')
<div class="container-fluid px-0" style="max-width: 800px; margin: 0 auto;">
    <div class="mb-4">
        <h1 class="h3 fw-bold text-dark mb-1">{{ isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru' }}</h1>
        <p class="text-muted small mb-0">Kelola dan publikasikan informasi atau berita terbaru sekolah.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
        <form action="{{ route('admin.berita.store', isset($berita) ? Crypt::encrypt($berita->id) : null) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Judul Berita *</label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" class="form-control rounded-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Tanggal Berita *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', isset($berita) ? $berita->tanggal : date('Y-m-d')) }}" class="form-control rounded-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">Foto Sampul / Gambar</label>
                <input type="file" name="gambar" class="form-control form-control-sm rounded-3">
                @if(isset($berita) && $berita->gambar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/berita/' . $berita->gambar) }}" class="rounded-3 border" style="width: 70px; height: 70px; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small">Isi Berita Lengkap *</label>
                <textarea name="isi" rows="6" class="form-control rounded-3 py-2" required>{{ old('isi', $berita->isi ?? '') }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-light px-4 rounded-3">Batal</a>
                <button type="submit" class="btn btn-success px-4 rounded-3 fw-semibold"><i class="fa-solid fa-paper-plane me-1"></i> Simpan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection