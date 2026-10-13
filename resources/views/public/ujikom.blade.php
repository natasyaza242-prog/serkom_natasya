@extends('layouts.public')

@section('title', 'Form Ujikom')

@section('content')
<section class="bg-success text-white py-4 px-3" style="background-color: #0B2319 !important;">
    <div class="container">
        <p class="small text-success-subtle mb-1">
            <a href="{{ route('landing') }}" class="text-success-subtle text-decoration-none">Beranda</a> / Ujikom
        </p>
        <h1 class="h3 fw-bold mb-1">
            <i class="fas fa-school me-2 text-success"></i> Form Ujikom
        </h1>
        <p class="small text-light mb-0">Ujikom SMK YPC</p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container" style="max-width: 900px;">
        <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">

            {{-- NAMA SISWA --}}
            <div class="mb-4">
                <label for="nama_siswa" class="form-label fw-semibold text-dark small">Nama Siswa</label>
                <input type="text" id="nama_siswa" placeholder="Masukkan nama siswa" class="form-control rounded-3 py-2">
            </div>

            {{-- INPUT NILAI --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="nilai1" class="form-label fw-semibold text-dark small">Nilai 1</label>
                    <input type="number" id="nilai1" min="0" max="100" placeholder="0 - 100" oninput="hitungNilai()" class="form-control rounded-3 py-2">
                </div>
                <div class="col-md-4">
                    <label for="nilai2" class="form-label fw-semibold text-dark small">Nilai 2</label>
                    <input type="number" id="nilai2" min="0" max="100" placeholder="0 - 100" oninput="hitungNilai()" class="form-control rounded-3 py-2">
                </div>
                <div class="col-md-4">
                    <label for="nilai3" class="form-label fw-semibold text-dark small">Nilai 3</label>
                    <input type="number" id="nilai3" min="0" max="100" placeholder="0 - 100" oninput="hitungNilai()" class="form-control rounded-3 py-2">
                </div>
            </div>

            {{-- HASIL NILAI --}}
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark small">Rata-rata Nilai</label>
                    <div id="rataRata" class="p-3 bg-light border rounded-3 fw-bold text-dark">0</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark small">Status Kelulusan</label>
                    <div id="status" class="p-3 bg-light border rounded-3 fw-bold text-secondary">Belum dihitung</div>
                </div>
            </div>

            {{-- KETERANGAN --}}
            <div class="alert alert-success rounded-3 small mb-4">
                <strong>Keterangan:</strong> Siswa dinyatakan <strong>Lulus</strong> jika rata-rata nilai <strong>lebih dari 75</strong>.
            </div>

            {{-- BUTTON RESET --}}
            <div class="d-flex justify-content-end">
                <button type="button" onclick="resetForm()" class="btn btn-dark px-4 py-2 rounded-3 fw-semibold" style="background-color: #0B2319;">Reset</button>
            </div>

        </div>
    </div>
</section>

<script>
    function hitungNilai() {
        const nilai1 = document.getElementById('nilai1').value;
        const nilai2 = document.getElementById('nilai2').value;
        const nilai3 = document.getElementById('nilai3').value;

        const rataRata = document.getElementById('rataRata');
        const status = document.getElementById('status');

        if (nilai1 === '' || nilai2 === '' || nilai3 === '') {
            rataRata.textContent = '0';
            status.textContent = 'Belum dihitung';
            status.className = 'p-3 bg-light border rounded-3 fw-bold text-secondary';
            return;
        }

        const hasil = (Number(nilai1) + Number(nilai2) + Number(nilai3)) / 3;
        rataRata.textContent = hasil.toFixed(2);

        if (hasil > 75) {
            status.textContent = 'LULUS';
            status.className = 'p-3 bg-success-subtle border border-success text-success rounded-3 fw-bold';
        } else {
            status.textContent = 'TIDAK LULUS';
            status.className = 'p-3 bg-danger-subtle border border-danger text-danger rounded-3 fw-bold';
        }
    }

    function resetForm() {
        document.getElementById('nama_siswa').value = '';
        document.getElementById('nilai1').value = '';
        document.getElementById('nilai2').value = '';
        document.getElementById('nilai3').value = '';

        document.getElementById('rataRata').textContent = '0';
        const status = document.getElementById('status');
        status.textContent = 'Belum dihitung';
        status.className = 'p-3 bg-light border rounded-3 fw-bold text-secondary';
    }
</script>
@endsection