<?php

use Illuminate\Support\Facades\Route;

// User side controllers
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\UserGalleryController;
// UBAH: Import controller baru untuk testimoni & saran pengguna
use App\Http\Controllers\Auth\TestimoniController as UserTestimoniController; // Ganti alias jika sudah ada
use App\Http\Controllers\Auth\CartController;
use App\Http\Controllers\Auth\PromoEventController;
use App\Http\Controllers\Auth\ReservationPublicController;
use App\Http\Controllers\Auth\TablePublicController;
use App\Http\Controllers\Auth\OrderController;

// Admin side controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
// UBAH: Import controller baru untuk testimoni & saran admin
use App\Http\Controllers\Admin\TestimoniController as AdminTestimoniController; // Ganti alias jika sudah ada
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\PromoEventController as AdminPromoEventController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
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

// --- UBAH: Testimoni & Saran Pengguna ---
// Halaman utama Testimoni & Saran (menampilkan daftar dan form jika ada parameter/error)
Route::get('/testimoni', [UserTestimoniController::class, 'list'])->name('testimoni.list');

Route::middleware('auth')->group(function () {
    // Rute untuk menyimpan data dari form (Membutuhkan login)
    Route::post('/testimoni/store', [UserTestimoniController::class, 'store'])->name('testimoni.store');

    // Rute /testimoni/create sekarang redirect ke /testimoni dengan parameter
    // Ini berguna jika ada link lama atau tombol di navbar yang mengarah ke 'kritik-saran.create' atau 'testimoni.create'
    Route::get('/testimoni/create', function(){
        return redirect()->route('testimoni.list', ['show_form' => 'true']);
    })->name('testimoni.create');
});
// ------------------------------------


// Cart Routes
Route::get('/cart', [CartController::class, 'view'])->name('cart.view')->middleware('auth');
Route::post('/cart/ajax-add', [CartController::class, 'ajaxAdd'])->name('cart.ajaxAdd')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate')->middleware('auth');
Route::post('/cart/remove', [CartController::class, 'ajaxRemove'])->name('cart.remove')->middleware('auth');

// Promo & Event
Route::get('/promo-event', [PromoEventController::class, 'index'])->name('user.promo-event');

// Order Placement Route (Checkout)
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place')->middleware('auth');


// ========================
// 🔐 Admin Area (Protected)
// ========================
Route::middleware(['auth']) // Pastikan middleware 'is_admin' sudah Anda buat dan daftarkan
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pengguna
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Menu & Kategori
    Route::resource('menus', AdminMenuController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Galeri Admin
    Route::resource('gallery', AdminGalleryController::class);

    // --- UBAH: Testimoni & Saran Admin ---
    // Ganti parameter route model binding dari 'kritiksaran' menjadi 'testimoni' (sesuai nama model)
    Route::get('/testimoni', [AdminTestimoniController::class, 'index'])->name('testimoni.index');
    Route::post('/testimoni/{testimoni}/update-tampilkan', [AdminTestimoniController::class, 'updateTampilkan'])->name('testimoni.updateTampilkan');
    Route::delete('/testimoni/{testimoni}', [AdminTestimoniController::class, 'destroy'])->name('testimoni.destroy');
    Route::get('/testimoni/export/pdf', [AdminTestimoniController::class, 'exportPdf'])->name('testimoni.export.pdf');
    // ------------------------------------

    // Promo & Event Admin
    Route::resource('promo-event', AdminPromoEventController::class);

    // Meja (Tables) Admin
    Route::resource('table', TableController::class);

    // Reservasi Admin
    Route::resource('reservations', AdminReservationController::class)->except(['create', 'store']);

    // Order Management Admin Routes
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/download-pdf', [AdminOrderController::class, 'downloadPdf'])->name('orders.downloadPdf');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
});