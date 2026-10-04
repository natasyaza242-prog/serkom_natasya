@extends('layouts.app') {{-- Sesuaikan dengan nama layout admin kamu --}}

@section('title', 'Profil Sekolah')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white font-weight-bold mb-0">Profil Sekolah</h3>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-emerald-500/10 border-emerald-500/30 text-emerald-400" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- KARTU KIRI: Identitas Sekolah (Preview) -->
        <div class="col-lg-4">
            <div class="card bg-slate-800 border-slate-700 text-slate-200 shadow-lg rounded-3">
                <div class="card-header bg-slate-800 border-bottom border-slate-700 py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fa-solid fa-circle-info me-2 text-emerald-400"></i>Identitas Sekolah
                    </h6>
                </div>
                <div class="card-body text-center p-4">
                    <!-- Logo Sekolah -->
                    <div class="mb-3 d-inline-block p-2 bg-slate-900 rounded-3 border border-slate-700">
                        <img src="{{ $profil->logo ? asset('storage/' . $profil->logo) : 'https://via.placeholder.com/120' }}" 
                             alt="Logo Sekolah" 
                             class="img-fluid rounded" 
                             style="max-height: 120px; object-fit: contain;">
                    </div>

                    <!-- Nama & Kepala Sekolah -->
                    <h5 class="text-white font-weight-bold mb-1">{{ $profil->nama_sekolah ?? 'SMKN 2 Tasikmalaya' }}</h5>
                    <p class="text-slate-400 small mb-4">
                        <i class="fa-solid fa-user me-1"></i> {{ $profil->nama_kepala_sekolah ?? 'KURNIAWAN, S.Pd., M.Pd.' }}
                    </p>

                    <!-- Informasi Detail -->
                    <div class="border-top border-slate-700 pt-3 text-start small">
                        <div class="d-flex justify-content-between py-2 border-bottom border-slate-700/50">
                            <span class="text-slate-400"><i class="fa-solid fa-qrcode me-2"></i>NPSN:</span>
                            <span class="text-white font-weight-bold">{{ $profil->npsn ?? '20210890' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-slate-700/50">
                            <span class="text-slate-400"><i class="fa-regular fa-calendar-days me-2"></i>Tahun Berdiri:</span>
                            <span class="text-white font-weight-bold">{{ $profil->tahun_berdiri ?? '2000' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-slate-400"><i class="fa-solid fa-phone me-2"></i>Kontak:</span>
                            <span class="text-white font-weight-bold">{{ $profil->no_kontak ?? '087722188842' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KARTU KANAN: Form Pengaturan Profil Sekolah -->
        <div class="col-lg-8">
            <div class="card bg-slate-800 border-slate-700 text-slate-200 shadow-lg rounded-3">
                <div class="card-header bg-slate-800 border-bottom border-slate-700 py-3">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fa-regular fa-pen-to-square me-2 text-emerald-400"></i>Form Pengaturan Profil Sekolah
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.profil-sekolah.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Nama Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label text-slate-300 small font-weight-bold">Nama Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? 'SMKN 2 Tasikmalaya') }}" 
                                    class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>
                            </div>

                            <!-- Nama Kepala Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label text-slate-300 small font-weight-bold">Nama Kepala Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $profil->nama_kepala_sekolah ?? 'KURNIAWAN, S.Pd., M.Pd.') }}" 
                                    class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>
                            </div>

                            <!-- NPSN -->
                            <div class="col-md-4">
                                <label class="form-label text-slate-300 small font-weight-bold">NPSN <span class="text-danger">*</span></label>
                                <input type="text" name="npsn" value="{{ old('npsn', $profil->npsn ?? '20210890') }}" 
                                    class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>
                            </div>

                            <!-- Tahun Berdiri -->
                            <div class="col-md-4">
                                <label class="form-label text-slate-300 small font-weight-bold">Tahun Berdiri <span class="text-danger">*</span></label>
                                <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '1961') }}" 
                                    class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>
                            </div>

                            <!-- No Kontak / Telepon -->
                            <div class="col-md-4">
                                <label class="form-label text-slate-300 small font-weight-bold">No. Kontak / Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="no_kontak" value="{{ old('no_kontak', $profil->no_kontak ?? '087722188842') }}" 
                                    class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>
                            </div>

                            <!-- Alamat Lengkap -->
                            <div class="col-12">
                                <label class="form-label text-slate-300 small font-weight-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" rows="2" class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>{{ old('alamat', $profil->alamat ?? 'Jl. Noenoeng Tisnasaputra No.2, Kahuripan, Kec. Tawang, Kab. Tasikmalaya, Jawa Barat 46115') }}</textarea>
                            </div>

                            <!-- Visi & Misi Sekolah -->
                            <div class="col-12">
                                <label class="form-label text-slate-300 small font-weight-bold">Visi & Misi Sekolah <span class="text-danger">*</span></label>
                                <textarea name="visi_misi" rows="4" class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2" required>{{ old('visi_misi', $profil->visi_misi ?? "Visi:\n Menghasilkan tenaga kerja yang terampil, profesional, komunikatif, dan berakhlak mulia.\n\nMisi:\n1. Menyelenggarakan pendidikan dan pelatihan kejuruan yang berstandar nasional maupun global.") }}</textarea>
                            </div>

                            <!-- Deskripsi / Sambutan Sekolah -->
                            <div class="col-12">
                                <label class="form-label text-slate-300 small font-weight-bold">Deskripsi / Sambutan Sekolah</label>
                                <textarea name="deskripsi" rows="3" class="form-control bg-slate-900 border-slate-700 text-white focus:border-emerald-500 rounded-2">{{ old('deskripsi', $profil->deskripsi ?? 'SMK YPC Tasikmalaya merupakan sekolah menengah kejuruan terakreditasi A yang berfokus mencetak lulusan kompeten, siap kerja, dan berkarakter unggul.') }}</textarea>
                            </div>

                            <!-- Upload Ganti Logo Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label text-slate-300 small font-weight-bold">Ganti Logo Sekolah</label>
                                <input type="file" name="logo" class="form-control bg-slate-900 border-slate-700 text-slate-300 rounded-2">
                                <span class="text-slate-500 small d-block mt-1" style="font-size: 11px;">Biarkan kosong jika tidak diubah. Format JPG/PNG (Maks: 2MB).</span>
                            </div>

                            <!-- Upload Ganti Foto Gedung Sekolah -->
                            <div class="col-md-6">
                                <label class="form-label text-slate-300 small font-weight-bold">Ganti Foto Gedung Sekolah</label>
                                <input type="file" name="foto_gedung" class="form-control bg-slate-900 border-slate-700 text-slate-300 rounded-2">
                                <span class="text-slate-500 small d-block mt-1" style="font-size: 11px;">Biarkan kosong jika tidak diubah. Format JPG/PNG (Maks: 2MB).</span>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top border-slate-700">
                            <button type="submit" class="btn btn-primary bg-primary border-0 px-4 py-2 font-weight-bold rounded-2">
                                <i class="fa-regular fa-floppy-disk me-2"></i>Simpan Profil Sekolah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Kustomisasi CSS Dark Theme Spark Admin */
    .bg-slate-800 { background-color: #1e293b !important; }
    .bg-slate-900 { background-color: #0f172a !important; }
    .border-slate-700 { border-color: #334155 !important; }
    .text-slate-200 { color: #e2e8f0 !important; }
    .text-slate-300 { color: #cbd5e1 !important; }
    .text-slate-400 { color: #94a3b8 !important; }
    .text-slate-500 { color: #64748b !important; }
    
    /* Custom Input Style */
    .form-control:focus {
        background-color: #0f172a !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endsection