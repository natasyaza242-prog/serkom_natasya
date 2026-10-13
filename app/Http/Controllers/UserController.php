<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.index', compact('users'));
    }

    // Menampilkan form tambah atau edit pengguna
    public function addEdit($id = null)
    {
        $user = null;

        if ($id !== null) {
            try {
                $user = User::findOrFail(Crypt::decrypt($id));
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.user.index')
                    ->with('error', 'Data pengguna tidak ditemukan.');
            }
        }

        return view('admin.user.form', compact('user'));
    }

    // Menyimpan atau memperbarui pengguna
    public function save(Request $request, $id = null)
    {
        $user = null;

        if ($id !== null) {
            try {
                $id = Crypt::decrypt($id);
                $user = User::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.user.index')
                    ->with('error', 'Data pengguna tidak ditemukan.');
            }
        } else {
            $user = new User();
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'username' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => 'required|in:Admin,Operator,admin,operator',
            'password' => $user->exists
                ? 'nullable|string|min:6'
                : 'required|string|min:6',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar pada akun lain.',
            'role.required' => 'Pilih role pengguna.',
            'role.in' => 'Pilihan role tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = ucfirst(strtolower($request->role));

        if ($request->filled('username')) {
            $user->username = $request->username;
        } elseif (!$user->exists) {
            $baseUsername = strtolower(
                explode('@', $request->email)[0]
            );

            $username = $baseUsername;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $user->username = $username;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with(
                'success',
                $user->wasRecentlyCreated
                    ? 'Data pengguna berhasil disimpan.'
                    : 'Data pengguna berhasil diperbarui.'
            );
    }

    // Alias untuk route POST /admin/user/store
    public function store(Request $request)
    {
        return $this->save($request);
    }

    // Menampilkan detail pengguna
    public function show($id)
    {
        try {
            $user = User::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('admin.user.show', compact('user'));
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            $decryptedId = $id;
        }

        $user = User::find($decryptedId);

        if (!$user) {
            return redirect()
                ->back()
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        if (Auth::id() == $user->id) {
            return redirect()
                ->back()
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'Pengguna berhasil dihapus!');
    }
}
