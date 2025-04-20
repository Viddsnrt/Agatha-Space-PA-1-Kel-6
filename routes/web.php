<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController; // <--- ini yang sebelumnya belum ada

// ====================
// ✨ Public (User Area)
// ====================

// Halaman utama
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/tentang-kami', [LandingPageController::class, 'tentangkami'])->name('tentangkami');
Route::get('/kontak', [LandingPageController::class, 'kontak'])->name('kontak');
Route::get('/gallery', fn () => view('user.gallery'))->name('gallery');

// Menu (user side)
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Reservasi
Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi');
Route::post('/reservasi', [ReservasiController::class, 'store']);

// Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ========================
// 🔐 Admin Area (Protected)
// ========================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin (menampilkan jumlah menu & kategori)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Menu
    Route::resource('menus', AdminMenuController::class);

    // CRUD Kategori
    Route::resource('categories', CategoryController::class);
});
