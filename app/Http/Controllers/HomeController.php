<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah; // Sesuaikan dengan nama model Anda
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Berita;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Profil Sekolah
        $profil = ProfilSekolah::first();

        // 2. Hitung jumlah data
        $jumlahSiswa = Siswa::count();
        $jumlahGuru  = Guru::count();
        $jumlahEkskul = Ekstrakurikuler::count();
        
        // Karena tidak ada model Jurusan, set nilai manual/default (atau sesuaikan dari field profil jika ada)
        $jumlahJurusan = 11; 

        // 3. Ambil data list
        $ekstrakurikuler = Ekstrakurikuler::all();
        $guru   = Guru::all();
        $berita = Berita::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(6)->get();

        // 4. Return view
        return view('landing', compact(
            'profil',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahEkskul',
            'jumlahJurusan',
            'ekstrakurikuler',
            'guru',
            'berita',
            'galeri'
        ));
    }
    public function detailProfil()
{
    $profil = ProfilSekolah::first() ?? new ProfilSekolah();

    // Memanggil file: resources/views/admin/detail/profil_detail.blade.php
    return view('admin.detail.profil_detail', compact('profil'));
}
}