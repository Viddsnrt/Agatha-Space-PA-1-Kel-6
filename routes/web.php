<?php

use Illuminate\Support\Facades\Route;

// User side controllers
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController; // Pastikan ini ada atau sesuaikan
use App\Http\Controllers\AuthController; // Controller untuk login/register
use App\Http\Controllers\Auth\UserGalleryController; // Controller untuk galeri pengguna
use App\Http\Controllers\Auth\KritikSaranController; // Controller untuk Kritik & Saran pengguna
use App\Http\Controllers\Auth\CartController; // Controller untuk keranjang belanja
use App\Http\Controllers\Auth\PromoEventController; // Controller untuk promo & event pengguna
use App\Http\Controllers\Auth\ReservationPublicController; // Controller untuk submit reservasi
use App\Http\Controllers\Auth\TablePublicController; // Controller untuk menampilkan meja untuk reservasi
use App\Http\Controllers\Auth\OrderController; // Controller untuk proses order

// Admin side controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\KritikSaranController as AdminKritikSaranController;
use App\Http\Controllers\Admin\TableController; // Controller untuk manajemen meja admin
use App\Http\Controllers\Admin\PromoEventController as AdminPromoEventController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController; // Controller untuk manajemen reservasi admin
use App\Http\Controllers\Admin\OrderController as AdminOrderController; // Controller untuk manajemen order admin


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
Route::get('/reservasi', [TablePublicController::class, 'index'])->name('reservasi'); // Menampilkan form/meja reservasi
Route::post('/reservasi/kirim', [ReservationPublicController::class, 'kirim'])->name('reservasi.kirim'); // Submit reservasi

// Transaksi (Pastikan controller ini ada dan berfungsi sesuai kebutuhan)
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate'); // Perhatikan nama route ini
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']); // Ini POST ke AuthController@register

// Kritik & Saran (Sesuai Perubahan Baru)
// Halaman utama Kritik & Saran (menampilkan daftar dan form jika ada parameter/error)
Route::get('/kritik-saran', [KritikSaranController::class, 'list'])->name('kritik-saran.list');

Route::middleware('auth')->group(function () {
    // Rute untuk menyimpan data dari form (Membutuhkan login)
    Route::post('/kritik-saran/store', [KritikSaranController::class, 'store'])->name('kritik-saran.store');

    // Rute /kritik-saran/create sekarang redirect ke /kritik-saran dengan parameter
    // Ini berguna jika ada link lama atau tombol di navbar yang mengarah ke 'kritik-saran.create'
    Route::get('/kritik-saran/create', function(){
        return redirect()->route('kritik-saran.list', ['show_form' => 'true']);
    })->name('kritik-saran.create');
});
// Route::get('/daftar-kritik-saran', [KritikSaranController::class, 'list'])->name('kritik-saran.list'); // Komentari atau hapus ini


// Cart Routes
Route::get('/cart', [CartController::class, 'view'])->name('cart.view')->middleware('auth'); // Lindungi view keranjang dengan auth

// AJAX Add to Cart (dari halaman menu)
Route::post('/cart/ajax-add', [CartController::class, 'ajaxAdd'])
      ->name('cart.ajaxAdd')
      ->middleware('auth');

// AJAX Cart Update & Remove (untuk tombol +/- dan hapus di halaman cart)
Route::post('/cart/update', [CartController::class, 'ajaxUpdate'])
      ->name('cart.ajaxUpdate')
      ->middleware('auth');
Route::post('/cart/remove', [CartController::class, 'ajaxRemove'])
      ->name('cart.remove')
      ->middleware('auth');

// Promo & Event
Route::get('/promo-event', [PromoEventController::class, 'index'])->name('user.promo-event');
// Contoh route show jika diperlukan:
// Route::get('/promo-event/{promoEvent}', [PromoEventController::class, 'show'])->name('user.promo-event.show');

// Order Placement Route (Checkout)
Route::post('/order/place', [OrderController::class, 'placeOrder'])
      ->name('order.place')
      ->middleware('auth');


// ========================
// 🔐 Admin Area (Protected)
// ========================
Route::middleware(['auth', ]) // Pastikan middleware 'is_admin' sudah Anda buat dan daftarkan
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pengguna
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Menu & Kategori
    Route::resource('menus', AdminMenuController::class);
    Route::resource('categories', CategoryController::class)->except(['show']); // Umumnya kategori tidak butuh halaman show

    // Galeri Admin
    Route::resource('gallery', AdminGalleryController::class);

    // Kritik & Saran Admin
    Route::get('/kritik-saran', [AdminKritikSaranController::class, 'index'])->name('kritik-saran.index');
    Route::post('/kritik-saran/{kritiksaran}/update-tampilkan', [AdminKritikSaranController::class, 'updateTampilkan'])->name('kritik-saran.updateTampilkan'); // Gunakan route model binding
    Route::delete('/kritik-saran/{kritiksaran}', [AdminKritikSaranController::class, 'destroy'])->name('kritik-saran.destroy'); // Tambahkan route delete
    Route::get('/kritik-saran/export/pdf', [AdminKritikSaranController::class, 'exportPdf'])->name('kritik-saran.export.pdf');

    // Promo & Event Admin
    Route::resource('promo-event', AdminPromoEventController::class);

    // Meja (Tables) Admin
    Route::resource('table', TableController::class); // Ini sudah mencakup create, store, edit, update, destroy, index

    // Reservasi Admin
    Route::resource('reservations', AdminReservationController::class)->except(['create', 'store']); // Admin biasanya hanya melihat & mengelola

    // Order Management Admin Routes
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show'); // Route model binding untuk order
    Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy'); // Tambahkan route delete
});