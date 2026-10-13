<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        // Ambil data profil sekolah yang sudah tersimpan.
        $profil = ProfilSekolah::first();

        // Jika belum ada data, buat data awal agar form tidak error.
        if (!$profil) {
            $profil = new ProfilSekolah();

            $profil->nama_sekolah = 'SMPN 1 Mangunreja';
            $profil->kepala_sekolah = '';
            $profil->npsn = '';
            $profil->kontak = '';
            $profil->email = '';
            $profil->tahun_berdiri = '';
            $profil->alamat = '';
            $profil->deskripsi = '';
            $profil->visi_misi = '';
        }

        return view('admin.profil-sekolah.index', compact('profil'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form.
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string|max:50',
            'kontak' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'tahun_berdiri' => 'required|string|max:10',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
            'visi_misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
        ]);

        /*
         * Ambil data yang sudah ada.
         * Jika belum ada, buat data baru.
         * Data lama tidak dihapus ketika form disimpan.
         */
        $profil = ProfilSekolah::first();

        if (!$profil) {
            $profil = new ProfilSekolah();
        }

        // Simpan informasi sekolah.
        $profil->nama_sekolah = $request->nama_sekolah;
        $profil->kepala_sekolah = $request->kepala_sekolah;
        $profil->npsn = $request->npsn;
        $profil->kontak = $request->kontak;
        $profil->email = $request->email;
        $profil->tahun_berdiri = $request->tahun_berdiri;
        $profil->alamat = $request->alamat;
        $profil->deskripsi = $request->deskripsi;
        $profil->visi_misi = $request->visi_misi;

        // Upload logo baru jika dipilih.
        if ($request->hasFile('logo')) {
            if (
                $profil->logo &&
                Storage::disk('public')->exists($profil->logo)
            ) {
                Storage::disk('public')->delete($profil->logo);
            }

            $profil->logo = $request->file('logo')
                ->store('profil-sekolah', 'public');
        }

        // Upload foto gedung baru jika dipilih.
        if ($request->hasFile('foto')) {
            if (
                $profil->foto &&
                Storage::disk('public')->exists($profil->foto)
            ) {
                Storage::disk('public')->delete($profil->foto);
            }

            $profil->foto = $request->file('foto')
                ->store('profil-sekolah', 'public');
        }

        // Simpan ke database.
        $profil->save();

        // Kembali ke halaman profil dengan pesan berhasil.
        return redirect()
            ->route('admin.profil-sekolah.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}