<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $search  = $request->get('search');

        $guru = Guru::when($search, function ($query, $search) {
            return $query->where('nip', 'LIKE', '%' . $search . '%')
                         ->orWhere('nama_guru', 'LIKE', '%' . $search . '%')
                         ->orWhere('mapel', 'LIKE', '%' . $search . '%');
        })
        ->orderBy('nama_guru', 'asc')
        ->paginate($perPage)
        ->withQueryString();

        return view('admin.guru.index', compact('guru'));
    }

    public function addEdit($id = null)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Akses ditolak. Anda belum login.');
        }

        $guru = null;

        if ($id) {
            try {
                $decryptedId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                $decryptedId = $id;
            }

            try {
                $guru = Guru::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.guru.index')
                    ->with('error', 'Data guru tidak ditemukan.');
            }
        }

        return view('admin.guru.form', compact('guru'));
    }

    public function store(Request $request, $id = null)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Akses ditolak. Anda belum login.');
        }

        $decryptedId = null;

        if ($id) {
            try {
                $decryptedId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                $decryptedId = $id;
            }

            try {
                $guru = Guru::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.guru.index')
                    ->with('error', 'Data guru tidak ditemukan.');
            }
        } else {
            $guru = new Guru();
        }

        $request->validate([
            'nip'       => 'nullable|numeric|digits_between:10,18|unique:guru,nip,' . ($decryptedId ?? 'NULL') . ',id',
            'nama_guru' => 'required|string|max:100',
            'mapel'     => 'required|string|max:100',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nip.numeric'        => 'NIP harus berupa angka.',
            'nip.digits_between' => 'NIP harus di antara 10 hingga 18 digit.',
            'nip.unique'         => 'NIP sudah terdaftar.',
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'mapel.required'     => 'Mata pelajaran wajib diisi.',
            'foto.image'         => 'File foto harus berupa gambar.',
            'foto.max'           => 'Ukuran foto maksimal 2MB.',
        ]);

        $guru->nip       = $request->nip;
        $guru->nama_guru = $request->nama_guru;
        $guru->mapel     = $request->mapel;

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $guru->foto = $request->file('foto')->store('guru', 'public');
        }

        $guru->save();

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'success',
                $decryptedId
                    ? 'Data guru berhasil diperbarui.'
                    : 'Data guru berhasil disimpan.'
            );
    }

    public function save(Request $request, $id = null)
    {
        return $this->store($request, $id);
    }

    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            $decryptedId = $id;
        }

        try {
            $guru = Guru::findOrFail($decryptedId);
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return view('admin.guru.show', compact('guru'));
    }

    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $guru = Guru::findOrFail($decryptedId);
            
            // Hapus file foto guru jika ada di storage
            if ($guru->foto && Storage::disk('public')->exists('guru/' . $guru->foto)) {
                Storage::disk('public')->delete('guru/' . $guru->foto);
            }

            $guru->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Data guru tidak ditemukan.');
        }

       return redirect()->to(route('admin.guru.index'))
            ->with('success', 'Data guru berhasil dihapus.');
    }
}