<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        // Mengambil data profil sekolah pertama (id = 1)
        $profil = ProfilSekolah::first();

        return view('admin.profil-sekolah.index', compact('profil'));
    }

    public function save(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_sekolah'   => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'npsn'           => 'required|string|max:50',
            'telepon'        => 'required|string|max:50',
            'tahun_berdiri'  => 'required|string|max:10',
            'alamat'         => 'required|string',
            'deskripsi'      => 'nullable|string',
            'visi'           => 'nullable|string',
            'misi'           => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_gedung'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data profil pertama atau buat objek baru jika belum ada
        $profil = ProfilSekolah::first();
        if (!$profil) {
            $profil = new ProfilSekolah();
        }

        // Simpan field biasa ke kolom yang sesuai di database
        $profil->nama_sekolah   = $request->nama_sekolah;
        $profil->kepala_sekolah = $request->kepala_sekolah;
        $profil->npsn           = $request->npsn;
        $profil->kontak         = $request->telepon; // Di DB nama kolomnya 'kontak'
        $profil->tahun_berdiri  = $request->tahun_berdiri;
        $profil->alamat         = $request->alamat;
        $profil->deskripsi      = $request->deskripsi;

        // Menggabungkan Visi & Misi ke kolom 'visi_misi' di database
        $visiMisiText = "";
        if ($request->filled('visi')) {
            $visiMisiText .= "Visi:\n" . $request->visi;
        }
        if ($request->filled('misi')) {
            if (!empty($visiMisiText)) {
                $visiMisiText .= "\n\n";
            }
            $visiMisiText .= "Misi:\n" . $request->misi;
        }
        $profil->visi_misi = $visiMisiText;

        // Upload Foto Gedung (Di DB nama kolomnya 'foto')
        if ($request->hasFile('foto_gedung')) {
            if (!empty($profil->foto) && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            $profil->foto = $request->file('foto_gedung')->store('profil', 'public');
        }

        // Upload Logo
        if ($request->hasFile('logo')) {
            if (!empty($profil->logo) && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $profil->logo = $request->file('logo')->store('profil', 'public');
        }

        // Simpan perubahan ke database
        $profil->save();

        return redirect()->back()->with('success', 'Profil Sekolah berhasil diperbarui!');
    }
}