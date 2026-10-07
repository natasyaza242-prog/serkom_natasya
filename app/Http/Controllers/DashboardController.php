<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfilSekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru            = Guru::count();
        $totalSiswa           = Siswa::count();
        $totalBerita          = Berita::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $totalGaleri          = Galeri::count();

        $profilSekolah = ProfilSekolah::first();

        $beritaTerbaru = Berita::with('user')->latest('tanggal')->take(5)->get();

        return view('admin.dashboard', [
            'title'                => 'Dashboard',
            'totalGuru'            => $totalGuru,
            'totalSiswa'           => $totalSiswa,
            'totalBerita'          => $totalBerita,
            'totalEkstrakurikuler' => $totalEkstrakurikuler,
            'totalGaleri'          => $totalGaleri,
            'profilSekolah'        => $profilSekolah,
            'beritaTerbaru'        => $beritaTerbaru,
        ]);
    }

    public function publicDashboard()
    {
        $profilSekolah = ProfilSekolah::first();

        return view('public.dashboard', [
            'title'         => 'Beranda Website Sekolah',
            'profilSekolah' => $profilSekolah,
        ]);
    }
}
