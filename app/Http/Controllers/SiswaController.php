<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    // ==========================================
    // MENAMPILKAN DAFTAR SISWA
    // ==========================================
    public function index(Request $request)
    {
        $query = Siswa::query();

        // Pencarian berdasarkan NISN atau nama siswa
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nisn', 'like', "%{$search}%")
                  ->orWhere('nama_siswa', 'like', "%{$search}%");
            });
        }

        // Filter jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where(
                'jenis_kelamin',
                $request->jenis_kelamin
            );
        }

        $siswa = $query->latest()->get();

        return view('admin.siswa.index', compact('siswa'));
    }


    // ==========================================
    // MENGUBAH ID BIASA ATAU TERENKRIPSI
    // ==========================================
    private function resolveSiswaId($id)
    {
        if ($id === null || $id === '') {
            return null;
        }

        // Jika ID berupa angka biasa
        if (ctype_digit((string) $id)) {
            return (int) $id;
        }

        // Jika ID berupa hasil Crypt::encrypt()
        try {
            $decryptedId = Crypt::decrypt($id);

            if (
                is_int($decryptedId) ||
                (
                    is_string($decryptedId) &&
                    ctype_digit($decryptedId)
                )
            ) {
                return (int) $decryptedId;
            }
        } catch (\Throwable $e) {
            // ID tidak valid atau bukan ID terenkripsi
        }

        return null;
    }


    // ==========================================
    // FORM TAMBAH DAN EDIT SISWA
    // ==========================================
    public function addEdit($id = null)
    {
        $siswa = null;

        if ($id !== null) {
            $siswaId = $this->resolveSiswaId($id);

            if ($siswaId === null) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'ID siswa tidak valid.');
            }

            $siswa = Siswa::find($siswaId);

            if (!$siswa) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }
        }

        return view('admin.siswa.form', compact('siswa'));
    }


    // ==========================================
    // MENYIMPAN DAN MEMPERBARUI SISWA
    // ==========================================
    public function save(Request $request, $id = null)
    {
        // Cari siswa jika sedang mengedit
        if ($id !== null) {
            $siswaId = $this->resolveSiswaId($id);

            if ($siswaId === null) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'ID siswa tidak valid.');
            }

            $siswa = Siswa::find($siswaId);

            if (!$siswa) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }
        } else {
            // Membuat siswa baru
            $siswa = new Siswa();
        }

        // Ambil nama tabel dari model Siswa
        $namaTabel = $siswa->getTable();

        // Validasi data
        $validated = $request->validate([
            'nisn' => [
                'required',
                'string',
                'digits:10',
                Rule::unique($namaTabel, 'nisn')
                    ->ignore($siswa->id),
            ],

            'nama_siswa' => [
                'required',
                'string',
                'max:255',
            ],

            'jenis_kelamin' => [
                'required',
                Rule::in(['Laki-Laki', 'Perempuan']),
            ],

            'tahun_masuk' => [
                'required',
                'integer',
                'min:1900',
                'max:2100',
            ],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',
            'nisn.unique' => 'NISN sudah terdaftar.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max' => 'Nama siswa maksimal 255 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',
            'tahun_masuk.min' => 'Tahun masuk tidak valid.',
            'tahun_masuk.max' => 'Tahun masuk tidak valid.',
        ]);

        // Isi data siswa
        $siswa->nisn = $validated['nisn'];
        $siswa->nama_siswa = $validated['nama_siswa'];
        $siswa->jenis_kelamin = $validated['jenis_kelamin'];
        $siswa->tahun_masuk = $validated['tahun_masuk'];

        // Simpan ke database
        $siswa->save();

        $pesan = $siswa->wasRecentlyCreated
            ? 'Data siswa berhasil ditambahkan.'
            : 'Data siswa berhasil diperbarui.';

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', $pesan);
    }


    // ==========================================
    // ROUTE STORE
    // ==========================================
    public function store(Request $request, $id = null)
    {
        return $this->save($request, $id);
    }


    // ==========================================
    // DETAIL SISWA
    // ==========================================
    public function show($id)
    {
        $siswaId = $this->resolveSiswaId($id);

        if ($siswaId === null) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'ID siswa tidak valid.');
        }

        $siswa = Siswa::find($siswaId);

        if (!$siswa) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('admin.siswa.show', compact('siswa'));
    }


    // ==========================================
    // MENGHAPUS SISWA
    // ==========================================
    public function destroy($id)
    {
        $siswaId = $this->resolveSiswaId($id);

        if ($siswaId === null) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'ID siswa tidak valid.');
        }

        $siswa = Siswa::find($siswaId);

        if (!$siswa) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}