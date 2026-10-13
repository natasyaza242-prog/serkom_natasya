<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Menampilkan semua data galeri
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = max((int) $request->input('per_page', 10), 1);

        $galeri = Galeri::when($search, function ($query) use ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate($perPage)
        ->appends($request->all());

        return view('admin.galeri.index', compact(
            'galeri',
            'search',
            'perPage'
        ));
    }

    // Membuka form tambah atau edit
    public function addEdit($id = null)
    {
        $galeri = null;

        if ($id !== null) {
            try {
                $idAsli = is_numeric($id)
                    ? $id
                    : Crypt::decrypt($id);

                $galeri = Galeri::findOrFail($idAsli);
            } catch (\Throwable $e) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }
        }

        return view('admin.galeri.form', compact('galeri'));
    }

    // Menyimpan data baru atau hasil edit
    public function store(Request $request, $id = null)
    {
        $galeri = null;

        if ($id !== null) {
            try {
                $idAsli = is_numeric($id)
                    ? $id
                    : Crypt::decrypt($id);

                $galeri = Galeri::findOrFail($idAsli);
            } catch (\Throwable $e) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }
        } else {
            $galeri = new Galeri();
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kategori' => 'nullable|string|max:50',
            'tanggal' => 'nullable|date',
            'file' => ($id !== null && $galeri->file
                ? 'nullable'
                : 'required')
                . '|file|mimes:jpeg,jpg,png,gif,webp,mp4,webm,ogg,mov|max:20480',
        ]);

        // Upload file baru jika dipilih
        if ($request->hasFile('file')) {
            $fileBaru = $request->file('file');

            $namaFile = time() . '_' .
                preg_replace(
                    '/[^A-Za-z0-9_.-]/',
                    '_',
                    $fileBaru->getClientOriginalName()
                );

            $pathBaru = $fileBaru->storeAs(
                'galeri',
                $namaFile,
                'public'
            );

            // Hapus file lama setelah file baru berhasil disimpan
            if ($galeri->file) {
                $pathLama = $galeri->file;

                $pathLama = preg_replace(
                    '#^/?(storage/|public/)#',
                    '',
                    $pathLama
                );

                if (!filter_var($pathLama, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($pathLama);
                }
            }

            $galeri->file = $pathBaru;
        }

        // Simpan data galeri
        $galeri->judul = $request->judul;

        // Pertahankan keterangan lama jika kolom tidak dikirim
        if ($request->has('keterangan')) {
            $galeri->keterangan = $request->input('keterangan');
        }

        $galeri->kategori = $request->filled('kategori')
            ? $request->kategori
            : ($galeri->kategori ?: 'Foto');

        $galeri->tanggal = $request->filled('tanggal')
            ? $request->tanggal
            : ($galeri->tanggal ?: now()->toDateString());

        $galeri->save();

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                $id !== null
                    ? 'Galeri berhasil diperbarui.'
                    : 'Galeri berhasil ditambahkan.'
            );
    }

    // Menampilkan detail galeri
    public function show($id)
    {
        try {
            $idAsli = is_numeric($id)
                ? $id
                : Crypt::decrypt($id);

            $galeri = Galeri::findOrFail($idAsli);
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        return view('admin.galeri.show', compact('galeri'));
    }

    // Menghapus data galeri
    public function destroy($id)
    {
        try {
            $idAsli = is_numeric($id)
                ? $id
                : Crypt::decrypt($id);

            $galeri = Galeri::findOrFail($idAsli);
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        // Hapus file lokal jika ada
        if ($galeri->file) {
            $pathFile = preg_replace(
                '#^/?(storage/|public/)#',
                '',
                $galeri->file
            );

            if (!filter_var($pathFile, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($pathFile);
            }
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}