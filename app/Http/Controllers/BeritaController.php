<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = max((int) $request->input('per_page', 10), 1);

        $berita = Berita::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })
        ->orderBy('judul', 'asc') // Urutkan berdasarkan judul berita A-Z
        ->paginate($perPage)
        ->appends($request->all());

        return view('admin.berita.index', compact('berita', 'search', 'perPage'));
    }

    public function addEdit($id = null)
    {
        $berita = null;

        if ($id) {
            try {
                $decryptedId = Crypt::decrypt($id);
                $berita = Berita::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }
        }

        return view('admin.berita.form', compact('berita'));
    }

    public function save(Request $request, $id = null)
    {
        $decryptedId = null;

        if ($id) {
            try {
                $decryptedId = Crypt::decrypt($id);
                $berita = Berita::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }
        } else {
            $berita = new Berita();
        }

        $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'gambar.image'   => 'File harus berupa gambar.',
            'gambar.mimes'   => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max'     => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage/berita'), $imageName);
            $berita->gambar = 'storage/berita/' . $imageName;
        }

        $berita->judul = $request->judul;

        // Cek terlebih dahulu apakah kolom 'penulis' ada di tabel database sebelum menyimpan
        if (Schema::hasColumn('berita', 'penulis')) {
            $berita->penulis = $request->penulis ?? 'Administrator';
        }

        $berita->save();

        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                $decryptedId
                    ? 'Berita berhasil diperbarui.'
                    : 'Berita berhasil disimpan.'
            );
    }

    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $berita = Berita::findOrFail($decryptedId);
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin.berita.show', compact('berita'));
    }

    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $berita = Berita::findOrFail($decryptedId);
            $berita->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}