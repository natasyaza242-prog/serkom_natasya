<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
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
     * Tampilkan daftar data ekstrakurikuler
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $ekstrakurikuler = Ekstrakurikuler::with('guru')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_ekskul', 'LIKE', '%' . $search . '%')
                      ->orWhere('deskripsi', 'LIKE', '%' . $search . '%')
                      ->orWhereHas('guru', function ($qGuru) use ($search) {
                          $qGuru->where('nama_guru', 'LIKE', '%' . $search . '%');
                      });
                });
            })
            ->orderBy('nama_ekskul', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    /**
     * Form Tambah / Edit Ekstrakurikuler
     */
    public function addEdit($id = null)
    {
        $ekstrakurikuler = null;

        if ($id) {
            $decryptedId = $this->resolveId($id);
            $ekstrakurikuler = Ekstrakurikuler::findOrFail($decryptedId);
        }

        $guru = class_exists(Guru::class) ? Guru::all() : collect();

        return view('admin.ekstrakurikuler.form', compact('ekstrakurikuler', 'guru'));
    }

    /**
     * Simpan / Update Ekstrakurikuler
     */
    public function store(Request $request, $id = null)
    {
        $decryptedId = $this->resolveId($id);

        // 1. Ambil id_guru baik dari atribut id_guru maupun guru_id
        $idGuru = $request->input('id_guru') ?? $request->input('guru_id');

        // 2. Validasi input
        $request->validate([
            'nama_ekskul'    => 'required|string|max:255',
            'id_guru'        => 'required', // Wajib diisi agar tidak memicu Integrity Constraint Violation
            'jadwal_latihan' => 'nullable|string|max:255',
            'deskripsi'      => 'nullable|string',
            'gambar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'id_guru.required'     => 'Guru pembina wajib dipilih.',
        ]);

        $data = [
            'nama_ekskul'    => $request->input('nama_ekskul'),
            'id_guru'        => $idGuru,
            'jadwal_latihan' => $request->input('jadwal_latihan') ?? $request->input('jadwal'),
            'deskripsi'      => $request->input('deskripsi'),
        ];

        if ($decryptedId) {
            $ekstrakurikuler = Ekstrakurikuler::findOrFail($decryptedId);

            if ($request->hasFile('gambar') || $request->hasFile('foto')) {
                $file = $request->file('gambar') ?? $request->file('foto');

                if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
                    Storage::disk('public')->delete($ekstrakurikuler->gambar);
                }
                $data['gambar'] = $file->store('ekstrakurikuler', 'public');
            }

            $ekstrakurikuler->update($data);
            $message = 'Data ekstrakurikuler berhasil diperbarui!';
        } else {
            if ($request->hasFile('gambar') || $request->hasFile('foto')) {
                $file = $request->file('gambar') ?? $request->file('foto');
                $data['gambar'] = $file->store('ekstrakurikuler', 'public');
            }

            Ekstrakurikuler::create($data);
            $message = 'Data ekstrakurikuler berhasil ditambahkan!';
        }

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', $message);
    }

    /**
     * Alias save()
     */
    public function save(Request $request, $id = null)
    {
        return $this->store($request, $id);
    }

    /**
     * Detail Ekstrakurikuler
     */
    public function show($id)
    {
        $decryptedId = $this->resolveId($id);
        $ekstrakurikuler = Ekstrakurikuler::with('guru')->findOrFail($decryptedId);

        return view('admin.ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    /**
     * Hapus Ekstrakurikuler
     */
    public function destroy($id)
    {
        $decryptedId = $this->resolveId($id);
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($decryptedId);

        if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil dihapus!');
    }
}