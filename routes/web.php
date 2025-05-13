<?php

use Illuminate\Support\Facades\Route;
// User side controllers
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
// use App\Http\Controllers\ReservasiController; // Konflik, lihat di bawah
use App\Http\Controllers\TransaksiController; // Pastikan ini ada atau sesuaikan
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\UserGalleryController;
use App\Http\Controllers\Auth\KritikSaranController;
use App\Http\Controllers\Auth\CartController;
use App\Http\Controllers\Auth\PromoEventController;
use App\Http\Controllers\Auth\ReservationPublicController;
use App\Http\Controllers\Auth\TablePublicController;
use App\Http\Controllers\Auth\OrderController;

// Admin side controllers
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\KritikSaranController as AdminKritikSaranController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PromoEventController as AdminPromoEventController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController; // Pastikan ada jika dipakai
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


// ====================
// ✨ Public (User Area)
// ====================

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/tentang-kami', [LandingPageController::class, 'tentangkami'])->name('tentangkami');
Route::get('/kontak', [LandingPageController::class, 'kontak'])->name('kontak');

// Galeri
Route::get('/galleries', [UserGalleryController::class, 'index'])->name('gallery');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Reservasi
// Anda memilih TablePublicController untuk GET /reservasi
Route::get('/reservasi', [TablePublicController::class, 'index'])->name('reservasi');
Route::post('/reservasi/kirim', [ReservationPublicController::class, 'kirim'])->name('reservasi.kirim');

// Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Kritik & Saran
Route::middleware('auth')->group(function () {
    Route::get('/kritik-saran/create', [KritikSaranController::class, 'create'])->name('kritik-saran.create');
    Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');
});
Route::get('/daftar-kritik-saran', [KritikSaranController::class, 'list'])->name('kritik-saran.list');

// Cart Routes
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

// KOMENTARI ATAU HAPUS RUTE LAMA JIKA SUDAH TIDAK DIPAKAI UNTUK SUBMIT FORM BIASA
// Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');

// RUTE BARU untuk AJAX Add to Cart (dari halaman menu)
Route::post('/cart/ajax-add', [CartController::class, 'ajaxAdd'])
      ->name('cart.ajaxAdd')
      ->middleware('auth'); // Lindungi dengan auth

// AJAX Cart Routes (untuk tombol +/- dan hapus di halaman cart)
Route::post('/cart/update', [CartController::class, 'ajaxUpdate'])
      ->name('cart.ajaxUpdate')
      ->middleware('auth'); // Lindungi dengan auth
Route::post('/cart/remove', [CartController::class, 'ajaxRemove'])
      ->name('cart.remove')
      ->middleware('auth'); // Lindungi dengan auth

// Promo & Event
Route::get('/promo-event', [PromoEventController::class, 'index'])->name('user.promo-event');
// Pastikan UserPromoEventController ada jika rute show diaktifkan
// Route::get('/promo-event/{id}', [UserPromoEventController::class, 'show'])->name('promo-event.show');

// Order Placement Route (Checkout)
Route::post('/order/place', [OrderController::class, 'placeOrder'])
      ->name('order.place')
      ->middleware('auth');


// ========================
// 🔐 Admin Area (Protected)
// ========================
// Tambahkan middleware 'is_admin' jika Anda punya role/permission
Route::middleware(['auth'/* , 'is_admin' */])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pengguna
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Menu & Kategori
    Route::resource('menus', AdminMenuController::class);
    Route::resource('categories', CategoryController::class);

    // Galeri
    Route::resource('gallery', AdminGalleryController::class);

    // Kritik & Saran Admin
    Route::get('/kritik-saran', [AdminKritikSaranController::class, 'index'])->name('kritik-saran.index');
    Route::post('/kritik-saran/{id}/update-tampilkan', [AdminKritikSaranController::class, 'updateTampilkan'])->name('kritik-saran.updateTampilkan');
    Route::get('/kritik-saran/export/pdf', [AdminKritikSaranController::class, 'exportPdf'])->name('kritik-saran.export.pdf');

    // Promo & Event Admin
    Route::resource('promo-event', AdminPromoEventController::class);

    // Meja (Tables) Admin
    Route::resource('table', TableController::class);

    // Reservasi Admin (Contoh, sesuaikan dengan implementasi Anda)
    // Route::resource('reservations', AdminReservationController::class); // Jika menggunakan resource controller
    // Jika Anda punya metode spesifik di AdminReservationController:
    // Route::get('/reservations/{reservation}/edit', [AdminReservationController::class, 'edit'])->name('reservations.edit');
    // Route::put('/reservations/{reservation}', [AdminReservationController::class, 'update'])->name('reservations.update');


    // Order Management Admin Routes
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

});