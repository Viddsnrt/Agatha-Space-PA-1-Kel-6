@extends('user.layouts.app')

@section('title', 'Menu Agatha Space')

@push('styles')
{{-- Tambahkan SweetAlert2 CSS jika belum ada di layout utama --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> --}}
<style>
    /* ... (style Anda sebelumnya) ... */
    .btn-add-to-cart.loading { /* Style saat loading */
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Tambahan untuk deskripsi menu */
    .menu-description {
        /* Pastikan teks panjang bisa pindah baris dengan baik */
        word-wrap: break-word;
        overflow-wrap: break-word;
        /* Anda bisa mengatur min-height jika deskripsi sangat pendek agar card tidak terlalu kosong */
        /* Misalnya: min-height: 4.5em; (sekitar 3 baris teks) */
        /* Sesuaikan nilai em atau rem sesuai kebutuhan font Anda */
    }

    .card-body {
        /* Pastikan flexbox sudah benar, ini sudah ada di kode Anda */
        display: flex;
        flex-direction: column;
    }

    .card-body .card-text.flex-grow-1 {
        /* Ini adalah elemen deskripsi, pastikan ia tumbuh */
        flex-grow: 1 !important; /* !important mungkin tidak perlu jika tidak ada konflik */
    }

    .card-body .d-grid {
        /* Pastikan tombol selalu di bawah */
        margin-top: auto; /* Ini sudah ada via kelas .mt-auto */
    }
</style>
@endpush

@section('content')
<div class="container mt-4 py-3">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold playfair-font"><i class="fas fa-utensils text-primary-agatha me-2"></i>Menu Pilihan Agatha Space</h1>
        <p class="lead text-muted">Temukan hidangan dan minuman favorit Anda.</p>
    </div>

    {{-- Form Pencarian --}}
    <form action="{{ route('menu') }}" method="GET" class="row mb-5 justify-content-center align-items-center g-2">
        <div class="col-lg-5 col-md-6">
            <input type="text" name="search" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Cari menu..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-lg-3 col-md-4">
            <select name="kategori" class="form-select form-select-lg rounded-pill shadow-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-2 d-grid">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>
    </form>

    {{-- Daftar Menu --}}
    <div class="row g-4">
        @forelse ($menus as $menu)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow rounded-4 border-0 overflow-hidden">
                    {{-- Gambar Menu --}}
                    @if($menu->gambar && Storage::disk('public')->exists($menu->gambar))
                        <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $menu->nama }}">
                    @else
                         <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    {{-- Body Card --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">{{ $menu->nama }}</h5>
                        {{-- UBAH BARIS INI: Hapus Str::limit dan tambahkan class menu-description --}}
                        <p class="card-text text-muted small flex-grow-1 menu-description">{{ $menu->deskripsi }}</p>
                        <p class="card-text fs-5 fw-bold text-primary-agatha mb-3">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        {{-- Tombol Add to Cart (AJAX) --}}
                        <div class="d-grid mt-auto"> {{-- mt-auto akan mendorong ini ke bawah --}}
                            <button type="button" class="btn btn-success btn-add-to-cart rounded-pill btn-ajax-add-to-cart" data-id="{{ $menu->id }}">
                                <span class="button-icon"><i class="fas fa-cart-plus me-2"></i></span>
                                <span class="button-text">Tambah ke Keranjang</span>
                                <span class="button-spinner spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-warning shadow-sm">
                   <i class="fas fa-exclamation-circle me-2"></i>Menu tidak ditemukan.
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if ($menus->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $menus->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif

    {{-- Promo & Event Banner --}}
    <div class="promo-event-banner mt-5 mb-4 py-4 px-3 rounded-4 text-center shadow-lg position-relative" style="background: linear-gradient(135deg, #FFB347, #FF8030);">
        <div class="row align-items-center">
            <div class="col-md-8 text-md-start text-center text-white">
                <h2><i class="fas fa-tags me-2"></i> Promo & Event Spesial</h2>
                <p class="mb-0">Dapatkan penawaran dan event terbaru dari Agatha Space!</p>
            </div>
            <div class="col-md-4 mt-3 mt-md-0 text-md-end text-center">
                <a href="{{ route('user.promo-event') }}" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fas fa-bullhorn me-2"></i> Lihat Promo & Event
                </a>
            </div>
        </div>
        <div class="decoration-circle position-absolute" style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; top: -20px; right: 30px;"></div>
        <div class="decoration-circle position-absolute" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; bottom: -15px; left: 40px;"></div>
    </div>
</div>

<!-- Modal Login Diperlukan -->
<div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0 rounded-3">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="loginRequiredModalLabel"> <i class="fas fa-lock me-2 text-warning"></i> Masuk Diperlukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Silakan masuk terlebih dahulu untuk menambahkan item ke keranjang Anda.
            </div>
            <div class="modal-footer border-0 justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4"> <i class="fas fa-sign-in-alt me-1"></i> Masuk Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- ... (CDN dan meta tag lainnya) ... --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    const IS_LOGGED_IN = {{ Auth::check() ? 'true' : 'false' }};
    const LOGIN_URL = "{{ route('login') }}";
    // URL untuk halaman menu saat ini (bisa digunakan untuk redirect setelah login)
    // Atau jika Anda ingin selalu redirect ke halaman menu utama setelah login dari sini:
    const MENU_PAGE_URL = "{{ route('menu') }}"; // Ganti 'menu' dengan nama route halaman menu Anda jika beda
</script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    var loginModalElement = document.getElementById('loginRequiredModal');
    var loginModal = loginModalElement ? new bootstrap.Modal(loginModalElement) : null;
    var loginButtonInModal = loginModalElement ? loginModalElement.querySelector('a.btn-primary') : null;

    $(document).on('click', '.btn-ajax-add-to-cart', function(event) {
        event.preventDefault();
        const button = $(this);
        const menuId = button.data('id');

        if (!IS_LOGGED_IN) {
            if (loginModal && loginButtonInModal) {
                // Simpan menu_id dan redirect_url ke URL login
                // Redirect akan kembali ke halaman menu ini setelah login
                let redirectUrlAfterLogin = MENU_PAGE_URL; // atau window.location.href jika ingin kembali ke halaman persis dengan filter dll.
                let finalLoginUrl = LOGIN_URL +
                                    '?redirect_to=' + encodeURIComponent(redirectUrlAfterLogin) +
                                    '&add_menu_after_login=' + menuId;

                loginButtonInModal.setAttribute('href', finalLoginUrl);
                loginModal.show();
            } else {
                // Fallback jika modal tidak terdefinisi
                let redirectUrlAfterLogin = MENU_PAGE_URL;
                let finalLoginUrl = LOGIN_URL +
                                    '?redirect_to=' + encodeURIComponent(redirectUrlAfterLogin) +
                                    '&add_menu_after_login=' + menuId;
                Swal.fire({
                    title: 'Masuk Diperlukan',
                    text: 'Anda harus masuk untuk menambahkan item. Apakah Anda ingin masuk sekarang?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Masuk',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = finalLoginUrl;
                    }
                });
            }
            return;
        }

        // --- Logika AJAX yang sudah ada jika user sudah login ---
        const originalIcon = button.find('.button-icon').html();
        const originalText = button.find('.button-text').text();
        button.find('.button-icon').addClass('d-none');
        button.find('.button-spinner').removeClass('d-none');
        button.find('.button-text').text('Menambahkan...');
        button.prop('disabled', true).addClass('loading');

        $.ajax({
            url: "{{ route('cart.ajaxAdd') }}", // Pastikan route ini benar
            method: "POST",
            data: { menu_id: menuId },
            success: function(response) {
                if (response.success) {
                    showToast('success', response.message || 'Item ditambahkan!');
                    if (response.cartCount !== undefined && typeof updateGlobalCartBadge === 'function') {
                        updateGlobalCartBadge(response.cartCount);
                    }
                } else {
                    showToast('error', response.message || 'Gagal menambahkan item.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
                let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage = jqXHR.responseJSON.message;
                }
                showToast('error', errorMessage);
            },
            complete: function() {
                button.find('.button-spinner').addClass('d-none');
                button.find('.button-icon').html(originalIcon).removeClass('d-none');
                button.find('.button-text').text(originalText);
                button.prop('disabled', false).removeClass('loading');
            }
        });
    });

    function showToast(icon, title) {
        const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer:2000,timerProgressBar: true,didOpen: (t) => {t.addEventListener('mouseenter', Swal.stopTimer);t.addEventListener('mouseleave', Swal.resumeTimer)}});
        Toast.fire({icon: icon,title: title});
    }

    // Fungsi ini mungkin ada di layout utama Anda, pastikan ada atau buat yang serupa
    // function updateGlobalCartBadge(count) {
    //     $('#cart-badge-count').text(count); // Sesuaikan selectornya
    // }

    // Tampilkan notifikasi jika ada dari session setelah login dan penambahan item
    @if(session('status_after_login_add_item'))
        showToast("{{ session('status_after_login_add_item_type') }}", "{{ session('status_after_login_add_item') }}");
    @endif

    // Notifikasi umum lainnya yang mungkin sudah ada
    @if(session('success'))
        showToast('success', '{{ session('success') }}');
    @endif
    @if(session('error'))
        showToast('error', '{{ session('error') }}');
    @endif

});
</script>
@endpush