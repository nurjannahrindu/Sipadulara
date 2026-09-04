<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MasyarakatAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\LandingController;

use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengajuanController as AdminPengajuanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenangananController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Masyarakat\PengajuanController;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

/*
|--------------------------------------------------------------------------
| LOGIN GABUNGAN
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN LAMA
|--------------------------------------------------------------------------
|
| URL /admin/login tetap diarahkan ke halaman login yang sama.
|
*/

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');


/*
|--------------------------------------------------------------------------
| REGISTER MASYARAKAT
|--------------------------------------------------------------------------
*/

Route::get('/register', [MasyarakatAuthController::class, 'showRegister'])
    ->name('masyarakat.register');

Route::post('/register', [MasyarakatAuthController::class, 'register'])
    ->name('masyarakat.register.submit');


/*
|--------------------------------------------------------------------------
| LOGOUT MASYARAKAT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [MasyarakatAuthController::class, 'logout'])
    ->name('masyarakat.logout');


/*
|--------------------------------------------------------------------------
| LOGOUT ADMIN
|--------------------------------------------------------------------------
*/

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');



/*
|--------------------------------------------------------------------------
| DASHBOARD MASYARAKAT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [MasyarakatDashboardController::class, 'index'])
    ->middleware('masyarakat')
    ->name('masyarakat.dashboard');

Route::middleware('masyarakat')
    ->prefix('pengajuan')
    ->name('masyarakat.pengajuan.')
    ->group(function () {

        Route::get('/', [PengajuanController::class, 'index'])
            ->name('index');

        Route::get('/create', [PengajuanController::class, 'create'])
            ->name('create');

        Route::post('/', [PengajuanController::class, 'store'])
            ->name('store');

        Route::get('/{pengajuan}', [PengajuanController::class, 'show'])
            ->name('show');

        Route::get('/{pengajuan}/edit', [PengajuanController::class, 'edit'])
            ->name('edit');

        Route::put('/{pengajuan}', [PengajuanController::class, 'update'])
            ->name('update');

        Route::delete('/{pengajuan}', [PengajuanController::class, 'destroy'])
            ->name('destroy');
    });


Route::middleware('admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard Admin
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | CRUD Kategori
        |--------------------------------------------------------------------------
        */

        Route::resource('kategori', KategoriController::class);


        /*
        |--------------------------------------------------------------------------
        | Pengajuan
        |--------------------------------------------------------------------------
        */

        Route::get('/pengajuan', [
            AdminPengajuanController::class,
            'index'
        ])->name('pengajuan.index');

        Route::get('/pengajuan/{pengajuan}', [
            AdminPengajuanController::class,
            'show'
        ])->name('pengajuan.show');


        /*
        |--------------------------------------------------------------------------
        | Penanganan Pengajuan
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/pengajuan/{pengajuan}/penanganan/create',
            [PenangananController::class, 'create']
        )->name('penanganan.create');

        Route::post(
            '/pengajuan/{pengajuan}/penanganan',
            [PenangananController::class, 'store']
        )->name('penanganan.store');

        Route::get(
            '/penanganan/{penanganan}/edit',
            [PenangananController::class, 'edit']
        )->name('penanganan.edit');

        Route::put(
            '/penanganan/{penanganan}',
            [PenangananController::class, 'update']
        )->name('penanganan.update');

        /*
        |--------------------------------------------------------------------------
        | Laporan
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan', [
            LaporanController::class,
            'index'
        ])->name('laporan.index');

         Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])
        ->name('laporan.cetak');

    });