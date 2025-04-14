<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;

// Route halaman utama
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/tentang-kami', [LandingPageController::class, 'tentangkami'])->name('tentangkami');
Route::get('/menu', [LandingPageController::class, 'menu'])->name('menu');
Route::get('/kontak', [LandingPageController::class, 'kontak'])->name('kontak');

// Route halaman gallery
Route::get('/gallery', function () {
    return view('user.gallery');
})->name('gallery');

// Reservasi
Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi');
Route::post('/reservasi', [ReservasiController::class, 'store']);

// Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin (butuh auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menu', \App\Http\Controllers\Admin\MenuController::class);
});
