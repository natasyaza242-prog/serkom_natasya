<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth; // Impor Facade Auth agar tidak merah

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = max((int) $request->input('per_page', 10), 1);

        $guru = Guru::when($search, function ($query) use ($search) {
            return $query->where('nama_guru', 'like', '%' . $search . '%')
                         ->orWhere('nip', 'like', '%' . $search . '%');
        })
        ->orderBy('nama_guru', 'asc')
        ->paginate($perPage)
        ->appends($request->all());

        return view('admin.guru.index', compact('guru', 'search', 'perPage'));
    }

    public function addEdit($id = null)
    {
        // Penggunaan Auth::user() menggantikan auth()->user()
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengedit data guru.');
        }

        $guru = null;

        if ($id) {
            try {
                $decryptedId = Crypt::decrypt($id);
                $guru = Guru::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.guru.index')
                    ->with('error', 'Data guru tidak ditemukan.');
            }
        }

        return view('admin.guru.form', compact('guru'));
    }

    public function save(Request $request, $id = null)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin menyimpan data guru.');
        }

        $decryptedId = null;

        if ($id) {
            try {
                $decryptedId = Crypt::decrypt($id);
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
            'nama_guru' => 'required|string|max:50',
            'mapel'     => 'required|string|max:50',
        ], [
            'nip.numeric'        => 'NIP harus berupa angka.',
            'nip.digits_between' => 'NIP harus di antara 10 hingga 18 digit.',
            'nip.unique'         => 'NIP sudah terdaftar.',
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'mapel.required'     => 'Mata pelajaran wajib diisi.',
        ]);

        $guru->nip       = $request->nip;
        $guru->nama_guru = $request->nama_guru;
        $guru->mapel     = $request->mapel;

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

    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk menghapus data guru.');
        }

        try {
            $decryptedId = Crypt::decrypt($id);
            $guru = Guru::findOrFail($decryptedId);
            $guru->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}