<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Auth\UserGalleryController;
use App\Http\Controllers\Auth\KritikSaranController;
use App\Http\Controllers\Admin\KritikSaranController as AdminKritikSaranController;
use App\Http\Controllers\Auth\CartController;
use App\Http\Controllers\Auth\PromoEventController;

// ====================
// ✨ Public (User Area)
// ====================

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/tentang-kami', [LandingPageController::class, 'tentangkami'])->name('tentangkami');
Route::get('/kontak', [LandingPageController::class, 'kontak'])->name('kontak');

// Galeri (user side)
Route::get('/Galleries', [UserGalleryController::class, 'index'])->name('gallery');

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

// Kritik & Saran (user input)
Route::get('/kritik-saran', [KritikSaranController::class, 'create'])->name('kritik-saran.create');
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');

// ✅ Kritik & Saran (public list - tampilkan yang disetujui)
Route::get('/daftar-kritik-saran', [KritikSaranController::class, 'list'])->name('kritik-saran.list');

// Tambah ke keranjang
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// Lihat keranjang
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');

// Promo & Event
Route::get('/promo-event', [PromoEventController::class, 'index'])->name('user.promo-event');
Route::get('/promo-event/{id}', [UserPromoEventController::class, 'show'])->name('promo-event.show');




// ========================
// 🔐 Admin Area (Protected)
// ========================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu 
    Route::resource('menus', AdminMenuController::class);

    // Kategori
    Route::resource('categories', CategoryController::class);

    // Galeri
    Route::resource('gallery', AdminGalleryController::class);

    // Kritik & Saran 
    Route::get('/kritik-saran', [AdminKritikSaranController::class, 'index'])->name('kritik-saran.index');
    Route::post('/kritik-saran/{id}/update-tampilkan', [AdminKritikSaranController::class, 'updateTampilkan'])->name('kritik-saran.updateTampilkan');

    // Promo & Event
    Route::resource('promo-event', \App\Http\Controllers\Admin\PromoEventController::class);

});

