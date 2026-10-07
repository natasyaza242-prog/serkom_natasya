<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah; // Sesuaikan dengan nama model profil Anda
use App\Models\Berita;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data dari database
        $profil = ProfilSekolah::first();
        $beritaTerbaru = Berita::latest()->take(3)->get();
        $gurus = Guru::take(4)->get();
        $ekskuls = Ekstrakurikuler::take(6)->get();
        $galeris = Galeri::latest()->take(6)->get();

        return view('welcome', compact('profil', 'beritaTerbaru', 'gurus', 'ekskuls', 'galeris'));
    }
}