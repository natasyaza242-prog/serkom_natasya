@extends('layouts.app')

@section('title', 'Profil Sekolah')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h1 class="h3 fw-bold text-dark mb-1">
            Profil Sekolah
        </h1>
        <p class="text-muted small mb-0">
            Kelola informasi dan identitas sekolah.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-3 mb-4" role="alert">
            <p class="fw-semibold mb-2">Data belum berhasil disimpan:</p>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <form action="{{ route('admin.profil-sekolah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body p-4 p-md-5">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Nama Sekolah *</label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" class="form-control rounded-3 py-2" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Kepala Sekolah *</label>
                        <input type="text" name="kepala_sekolah" value="{{ old('kepala_sekolah', $profil->kepala_sekolah) }}" class="form-control rounded-3 py-2" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">NPSN *</label>
                        <input type="text" name="npsn" value="{{ old('npsn', $profil->npsn) }}" class="form-control rounded-3 py-2" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Nomor Telepon / Kontak *</label>
                        <input type="text" name="kontak" value="{{ old('kontak', $profil->kontak) }}" class="form-control rounded-3 py-2" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small">Email Sekolah</label>
                    <input type="email" name="email" value="{{ old('email', $profil->email) }}" class="form-control rounded-3 py-2">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small">Tahun Berdiri *</label>
                    <input type="text" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri) }}" class="form-control rounded-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small">Alamat Lengkap *</label>
                    <textarea name="alamat" rows="3" class="form-control rounded-3 py-2" required>{{ old('alamat', $profil->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small">Deskripsi / Sambutan Sekolah</label>
                    <textarea name="deskripsi" rows="4" class="form-control rounded-3 py-2">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small">Visi & Misi</label>
                    <textarea name="visi_misi" rows="4" class="form-control rounded-3 py-2">{{ old('visi_misi', $profil->visi_misi) }}</textarea>
                </div>

                <div class="row g-4 pt-3 border-top">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small mb-2">Logo Sekolah</label>
                        @if($profil->logo)
                            @php
                                $logoPath = str_starts_with($profil->logo, 'storage/')
                                    ? asset($profil->logo)
                                    : asset('storage/' . $profil->logo);
                            @endphp
                            <div class="mb-2">
                                <img src="{{ $logoPath }}" alt="Logo Sekolah" class="rounded-3 border object-fit-cover" style="width: 80px; height: 80px;">
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small mb-2">Foto Gedung Utama</label>
                        @if($profil->foto)
                            @php
                                $fotoPath = str_starts_with($profil->foto, 'storage/')
                                    ? asset($profil->foto)
                                    : asset('storage/' . $profil->foto);
                            @endphp
                            <div class="mb-2">
                                <img src="{{ $fotoPath }}" alt="Foto Gedung" class="rounded-3 border object-fit-cover w-100" style="height: 140px;">
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/*" class="form-control form-control-sm">
                    </div>
                </div>

            </div>

            <div class="card-footer bg-light px-4 py-3 border-0 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4 py-2 rounded-3 fw-semibold shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>
@endsection