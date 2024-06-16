<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PenghuniController;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAnggota;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/get-user/{id}', [AnggotaController::class, 'getUser']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/get-anggota/{id}', [TransaksiController::class, 'getAnggota']);
    Route::get('/get-produk/{id}', [TransaksiController::class, 'getProduk']);

    Route::middleware([IsSuperAdmin::class])->group(function () {
        Route::resource('anggota', AnggotaController::class);
        Route::resource('user', UserController::class);
        Route::resource('kamar', KamarController::class);
        Route::resource('pemilik', PemilikController::class);
        Route::resource('penghuni', PenghuniController::class);
    });

    Route::middleware([IsAdmin::class])->group(function () {
        //sidebar yang diakses IsAdmin
    });

    Route::middleware([IsAnggota::class])->group(function () {
        //sidebar yang diakses IsAnggota
    });
});
