<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman Utama / Landing Page (Ubah baris ini)
Route::get('/', [HomeController::class, 'index']);

// Autentikasi (Diberi nama 'login' agar route('login') di landing page berfungsi)
Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-proses', [AuthController::class, 'processLogin'])->name('proses.login');
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');

// Group Route Admin (Hanya untuk pengguna terautentikasi)
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('admin.profil-sekolah');
    Route::post('/profil-sekolah/save', [ProfilSekolahController::class, 'save'])->name('admin.profil-sekolah.save');
    Route::get('/profil', [ProfilSekolahController::class, 'index'])->name('admin.profil');

    Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('admin.berita.index');
        Route::get('/add-edit/{id?}', [BeritaController::class, 'addEdit'])->name('admin.berita.addEdit');
        Route::post('/save/{id?}', [BeritaController::class, 'save'])->name('admin.berita.save');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('admin.berita.show');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.delete');
    });

    Route::prefix('ekstrakurikuler')->group(function () {
        Route::get('/', [EkstrakurikulerController::class, 'index'])->name('admin.ekstrakurikuler.index');
        Route::get('/add-edit/{id?}', [EkstrakurikulerController::class, 'addEdit'])->name('admin.ekstrakurikuler.addEdit');
        Route::post('/save/{id?}', [EkstrakurikulerController::class, 'save'])->name('admin.ekstrakurikuler.save');
        Route::get('/{id}', [EkstrakurikulerController::class, 'show'])->name('admin.ekstrakurikuler.show');
        Route::delete('/{id}', [EkstrakurikulerController::class, 'destroy'])->name('admin.ekstrakurikuler.delete');
    });

    Route::prefix('galeri')->group(function () {
        Route::get('/', [GaleriController::class, 'index'])->name('admin.galeri.index');
        Route::get('/add-edit/{id?}', [GaleriController::class, 'addEdit'])->name('admin.galeri.addEdit');
        Route::post('/save/{id?}', [GaleriController::class, 'save'])->name('admin.galeri.save');
        Route::get('/{id}', [GaleriController::class, 'show'])->name('admin.galeri.show');
        Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.delete');
    });

    Route::prefix('guru')->group(function () {
        Route::get('/', [GuruController::class, 'index'])->name('admin.guru.index');
        Route::get('/{id}', [GuruController::class, 'show'])->name('admin.guru.show');
    });

    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/{id}', [SiswaController::class, 'show'])->name('admin.siswa.show');
    });

    // Route Khusus Role Admin
    Route::middleware('role:admin')->group(function () {
        
        Route::prefix('guru')->group(function () {
            Route::get('/add-edit/{id?}', [GuruController::class, 'addEdit'])->name('admin.guru.addEdit');
            Route::post('/save/{id?}', [GuruController::class, 'save'])->name('admin.guru.save');
            Route::delete('/{id}', [GuruController::class, 'destroy'])->name('admin.guru.delete');
        });

        Route::prefix('siswa')->group(function () {
            Route::get('/add-edit/{id?}', [SiswaController::class, 'addEdit'])->name('admin.siswa.addEdit');
            Route::post('/save/{id?}', [SiswaController::class, 'save'])->name('admin.siswa.save');
            Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.delete');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
            Route::get('/add-edit/{id?}', [UserController::class, 'addEdit'])->name('admin.user.addEdit');
            Route::post('/save/{id?}', [UserController::class, 'save'])->name('admin.user.save');
            Route::post('/store/{id?}', [UserController::class, 'save'])->name('admin.user.store');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
        });

    });

});