<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Helper untuk mendekripsi ID
     */
    private function resolveId($id)
    {
        if (!$id) {
            return null;
        }

        try {
            return Crypt::decrypt($id);
        } catch (\Exception $e) {
            return $id;
        }
    }

    /**
     * Tampilkan daftar data siswa
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $jenisKelamin = $request->get('jenis_kelamin');

        $siswa = Siswa::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nisn', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama_siswa', 'LIKE', '%' . $search . '%');
            });
        })
        ->when($jenisKelamin, function ($query, $jenisKelamin) {
            return $query->where('jenis_kelamin', $jenisKelamin);
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage)
        ->withQueryString();

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Form Tambah / Edit Siswa
     */
    public function addEdit($id = null)
    {
        $siswa = null;

        if ($id) {
            $decryptedId = $this->resolveId($id);
            $siswa = Siswa::findOrFail($decryptedId);
        }

        return view('admin.siswa.form', compact('siswa'));
    }

    /**
     * Simpan / Update Data Siswa
     */
    public function store(Request $request, $id = null)
    {
        $decryptedId = $this->resolveId($id);

        $rules = [
            'nisn'          => 'required|numeric|unique:siswa,nisn,' . $decryptedId,
            'nama_siswa'    => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|numeric',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $request->validate($rules);

        $data = $request->only(['nisn', 'nama_siswa', 'jenis_kelamin', 'tahun_masuk']);

        if ($decryptedId) {
            $siswa = Siswa::findOrFail($decryptedId);

            if ($request->hasFile('foto')) {
                if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                    Storage::disk('public')->delete($siswa->foto);
                }
                $data['foto'] = $request->file('foto')->store('siswa', 'public');
            }

            $siswa->update($data);
            $message = 'Data siswa berhasil diperbarui!';
        } else {
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('siswa', 'public');
            }

            Siswa::create($data);
            $message = 'Data siswa berhasil ditambahkan!';
        }

        return redirect()->route('admin.siswa.index')->with('success', $message);
    }

    /**
     * Alias save()
     */
    public function save(Request $request, $id = null)
    {
        return $this->store($request, $id);
    }

    /**
     * Detail Data Siswa
     */
    public function show($id)
    {
        $decryptedId = $this->resolveId($id);
        $siswa = Siswa::findOrFail($decryptedId);

        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Hapus Data Siswa
     */
    public function destroy($id)
    {
        $decryptedId = $this->resolveId($id);
        $siswa = Siswa::findOrFail($decryptedId);

        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus!');
    }
}