<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = max((int) $request->input('per_page', 10), 1);

        $berita = Berita::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })
        ->orderBy('judul', 'asc')
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

    // Alias agar method store() memanggil fungsi save()
    public function store(Request $request, $encryptedId = null)
    {
        return $this->save($request, $encryptedId);
    }

    public function save(Request $request, $encryptedId = null)
    {
        // Validasi input form
        $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi'     => 'required',
        ]);

        $id = $encryptedId ? Crypt::decrypt($encryptedId) : null;

        $berita = $id ? Berita::findOrFail($id) : new Berita();
        $berita->judul = $request->judul;
        $berita->tanggal = $request->tanggal;
        $berita->isi = $request->isi;
        
        // Mengisi id_user dengan ID admin yang sedang login saat ini
        if (!$id) {
            $berita->id_user = Auth::id();
        }

        // Handle upload gambar jika ada file baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada di disk public
            if ($berita->gambar && Storage::disk('public')->exists('berita/' . $berita->gambar)) {
                Storage::disk('public')->delete('berita/' . $berita->gambar);
            }

            $file = $request->file('gambar');
            $originalName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $originalName;
            
            $file->storeAs('berita', $filename, 'public');
            $berita->gambar = $filename;
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil disimpan!');
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
            
            if ($berita->gambar && Storage::disk('public')->exists('berita/' . $berita->gambar)) {
                Storage::disk('public')->delete('berita/' . $berita->gambar);
            }

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