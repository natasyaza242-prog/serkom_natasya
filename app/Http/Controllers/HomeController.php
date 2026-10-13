<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Berita;
use App\Models\Galeri;

class HomeController extends Controller
{
    // HALAMAN BERANDA
    public function index()
    {
        $profil = ProfilSekolah::first();

        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahEkskul = Ekstrakurikuler::count();

        $ekstrakurikuler = Ekstrakurikuler::latest()->take(4)->get();
        $guru = Guru::latest()->take(4)->get();
        $berita = Berita::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(6)->get();

        return view('landing', compact(
            'profil',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahEkskul',
            'ekstrakurikuler',
            'guru',
            'berita',
            'galeri'
        ));
    }

    // HALAMAN PROFIL SEKOLAH
    public function profil()
    {
        $profil = ProfilSekolah::first();

        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahEkstrakurikuler = Ekstrakurikuler::count();

        return view('public.profil', compact(
            'profil',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahEkstrakurikuler'
        ));
    }

    // HALAMAN GURU
    public function guru()
    {
        $profil = ProfilSekolah::first();

        // Menampilkan semua data guru di halaman Guru
        $guru = Guru::latest()->get();

        return view('public.guru', compact(
            'profil',
            'guru'
        ));
    }

    // HALAMAN EKSTRAKURIKULER
    public function ekstrakurikuler()
    {
        $profil = ProfilSekolah::first();
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();

        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();

        return view('public.ekstrakurikuler', compact(
            'profil',
            'ekstrakurikuler',
            'jumlahSiswa',
            'jumlahGuru'
        ));
    }

    // HALAMAN BERITA
    public function berita()
    {
        $profil = ProfilSekolah::first();
        $berita = Berita::latest()->get();

        return view('public.berita', compact(
            'profil',
            'berita'
        ));
    }

    // HALAMAN GALERI
    public function galeri()
    {
        $profil = ProfilSekolah::first();
        $galeri = Galeri::latest()->get();

        return view('public.galeri', compact(
            'profil',
            'galeri'
        ));
    }

    // HALAMAN DETAIL PROFIL LAMA
    public function detailProfil()
    {
        $profil = ProfilSekolah::first() ?? new ProfilSekolah();

        return view(
            'admin.detail.profil_detail',
            compact('profil')
        );
    }
}
