<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('admin.profil-sekolah.index', compact('profil'));
    }

    public function save(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_sekolah'   => 'required',
        'kepala_sekolah' => 'required',
        'npsn'           => 'required',
        'no_telepon'     => 'required', // input dari form (name="no_telepon")
        'tahun_berdiri'  => 'required',
        'alamat'         => 'required',
        // ...
    ]);

    $profil = ProfilSekolah::firstOrNew(['id' => 1]);

    $profil->nama_sekolah   = $request->nama_sekolah;
    $profil->kepala_sekolah = $request->kepala_sekolah;
    $profil->npsn           = $request->npsn;
    
    // SESUAIKAN DI SINI: Simpan nilai dari form ($request->no_telepon) ke kolom 'kontak'
    $profil->kontak         = $request->no_telepon; 
    
    $profil->tahun_berdiri  = $request->tahun_berdiri;
    $profil->alamat         = $request->alamat;
    $profil->deskripsi      = $request->deskripsi;

    // Upload Logo jika ada
    if ($request->hasFile('logo')) {
        if ($profil->logo) {
            Storage::disk('public')->delete($profil->logo);
        }
        $profil->logo = $request->file('logo')->store('profil', 'public');
    }

    // Upload Foto Gedung jika ada
    if ($request->hasFile('foto_gedung')) {
        if ($profil->foto_gedung) {
            Storage::disk('public')->delete($profil->foto_gedung);
        }
        $profil->foto_gedung = $request->file('foto_gedung')->store('profil', 'public');
    }

    $profil->save();

    return redirect()->back()->with('success', 'Profil Sekolah berhasil diperbarui!');
}

}