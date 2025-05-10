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
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Auth\ReservationPublicController;


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
Route::middleware('auth')->group(function () {
    Route::get('/kritik-saran/create', [KritikSaranController::class, 'create'])->name('kritik-saran.create');
    Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');
});


// ✅ Kritik & Saran (public list - tampilkan yang disetujui)
Route::get('/daftar-kritik-saran', [KritikSaranController::class, 'list'])->name('kritik-saran.list');

// Cart Routes
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

// Rute untuk AJAX
Route::post('/cart/update', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate');
Route::post('/cart/remove', [CartController::class, 'ajaxRemove'])->name('cart.remove'); // Ini akan memanggil metode ajaxRemove di controller

// Promo & Event
Route::get('/promo-event', [PromoEventController::class, 'index'])->name('user.promo-event');
Route::get('/promo-event/{id}', [UserPromoEventController::class, 'show'])->name('promo-event.show');



Route::get('/reservasi', [ReservationPublicController::class, 'daftar'])->name('reservasi');
Route::post('/reservasi/kirim', [ReservationPublicController::class, 'kirim'])->name('reservasi.kirim');

Route::get('/reservasi', [\App\Http\Controllers\Auth\TablePublicController::class, 'index'])->name('reservasi');



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

    Route::resource('table', \App\Http\Controllers\Admin\TableController::class);

    Route::get('/admin/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('admin.reservation.edit');
Route::put('/admin/reservation/{id}', [ReservationController::class, 'update'])->name('admin.reservation.update');

Route::resource('reservation', \App\Http\Controllers\Admin\ReservationController::class);

});

