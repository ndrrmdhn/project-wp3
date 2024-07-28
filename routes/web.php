<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;

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

    Route::middleware([IsAdmin::class])->group(function () {
        Route::resource('anggota', AnggotaController::class);
        Route::resource('user', UserController::class);
        Route::resource('kamar', KamarController::class);
        Route::resource('penyewa', PenyewaController::class);
        Route::resource('pembayaran', PembayaranController::class);
    });

    Route::middleware([IsUser::class])->group(function () {
        Route::resource('kamar', KamarController::class)->only(['index', 'show']); // Hanya index dan show untuk Kamar
        Route::resource('pembayaran', PembayaranController::class)->only(['index', 'show']); // Hanya index dan show untuk Pembayaran
    });
});
