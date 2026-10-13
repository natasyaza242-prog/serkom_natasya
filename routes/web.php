<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\UjikomController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| ROUTE HALAMAN PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('landing');

Route::get('/profil', [HomeController::class, 'profil'])
    ->name('profil');

Route::get('/profil-detail', [HomeController::class, 'detailProfil'])
    ->name('profil.detail');

Route::get('/guru', [HomeController::class, 'guru'])
    ->name('guru');

Route::get('/ekstrakurikuler', [HomeController::class, 'ekstrakurikuler'])
    ->name('ekstrakurikuler');

Route::get('/berita', [HomeController::class, 'berita'])
    ->name('berita');

Route::get('/galeri', [HomeController::class, 'galeri'])
    ->name('galeri');


/*
|--------------------------------------------------------------------------
| ROUTE UJIKOM PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/ujikom', [UjikomController::class, 'index'])
    ->name('ujikom');


/*
|--------------------------------------------------------------------------
| ROUTE LOGIN DAN LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | GURU
        |--------------------------------------------------------------------------
        */

        Route::get('/guru', [GuruController::class, 'index'])
            ->name('guru.index');

        Route::get('/guru/form/{id?}', [GuruController::class, 'addEdit'])
            ->name('guru.addEdit');

        Route::get('/guru/{id}/edit', [GuruController::class, 'addEdit'])
            ->name('guru.edit');

        Route::get('/guru/detail/{id}', [GuruController::class, 'show'])
            ->name('guru.show');

        Route::post('/guru/store/{id?}', [GuruController::class, 'store'])
            ->name('guru.store');

        Route::post('/guru/save/{id?}', [GuruController::class, 'store'])
            ->name('guru.save');

        Route::delete('/guru/{id}', [GuruController::class, 'destroy'])
            ->name('guru.destroy');


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        Route::get('/siswa', [SiswaController::class, 'index'])
            ->name('siswa.index');

        Route::get('/siswa/form/{id?}', [SiswaController::class, 'addEdit'])
            ->name('siswa.addEdit');

        Route::get('/siswa/{id}/edit', [SiswaController::class, 'addEdit'])
            ->name('siswa.edit');

        Route::get('/siswa/detail/{id}', [SiswaController::class, 'show'])
            ->name('siswa.show');

        Route::post('/siswa/store/{id?}', [SiswaController::class, 'store'])
            ->name('siswa.store');

        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
            ->name('siswa.destroy');


        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        Route::get('/berita', [BeritaController::class, 'index'])
            ->name('berita.index');

        Route::get('/berita/form/{id?}', [BeritaController::class, 'addEdit'])
            ->name('berita.addEdit');

        Route::get('/berita/detail/{id}', [BeritaController::class, 'show'])
            ->name('berita.show');

        Route::post('/berita/store/{id?}', [BeritaController::class, 'store'])
            ->name('berita.store');

        Route::post('/berita/save/{id?}', [BeritaController::class, 'save'])
            ->name('berita.save');

        Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])
            ->name('berita.destroy');


        /*
        |--------------------------------------------------------------------------
        | EKSTRAKURIKULER
        |--------------------------------------------------------------------------
        */

        Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])
            ->name('ekstrakurikuler.index');

        Route::get('/ekstrakurikuler/form/{id?}', [EkstrakurikulerController::class, 'addEdit'])
            ->name('ekstrakurikuler.addEdit');

        Route::get('/ekstrakurikuler/detail/{id}', [EkstrakurikulerController::class, 'show'])
            ->name('ekstrakurikuler.show');

        Route::post('/ekstrakurikuler/store/{id?}', [EkstrakurikulerController::class, 'store'])
            ->name('ekstrakurikuler.store');

        Route::post('/ekstrakurikuler/save/{id?}', [EkstrakurikulerController::class, 'store'])
            ->name('ekstrakurikuler.save');

        Route::delete('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'destroy'])
            ->name('ekstrakurikuler.destroy');


        /*
        |--------------------------------------------------------------------------
        | GALERI
        |--------------------------------------------------------------------------
        */

        Route::get('/galeri', [GaleriController::class, 'index'])
            ->name('galeri.index');

        Route::get('/galeri/form/{id?}', [GaleriController::class, 'addEdit'])
            ->name('galeri.addEdit');

        Route::get('/galeri/detail/{id}', [GaleriController::class, 'show'])
            ->name('galeri.show');

        Route::post('/galeri/store/{id?}', [GaleriController::class, 'store'])
            ->name('galeri.store');

        Route::post('/galeri/update/{id}', [GaleriController::class, 'store'])
            ->name('galeri.update');

        Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])
            ->name('galeri.destroy');


        /*
        |--------------------------------------------------------------------------
        | PROFIL SEKOLAH
        |--------------------------------------------------------------------------
        */

        Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])
            ->name('profil-sekolah.index');

        Route::get('/profil-sekolah-view', [ProfilSekolahController::class, 'index'])
            ->name('profil-sekolah');

        Route::post('/profil-sekolah/store', [ProfilSekolahController::class, 'store'])
            ->name('profil-sekolah.store');

        Route::post('/profil-sekolah/save', [ProfilSekolahController::class, 'store'])
            ->name('profil-sekolah.save');


        /*
        |--------------------------------------------------------------------------
        | PENGELOLA USER
        |--------------------------------------------------------------------------
        */

        Route::get('/user', [UserController::class, 'index'])
            ->name('user.index');

        Route::get('/user/form/{id?}', [UserController::class, 'addEdit'])
            ->name('user.addEdit');

        Route::post('/user/store/{id?}', [UserController::class, 'store'])
            ->name('user.store');

        Route::get('/user/detail/{id}', [UserController::class, 'show'])
            ->name('user.show');

        Route::delete('/user/{id}', [UserController::class, 'destroy'])
            ->name('user.destroy');

    });