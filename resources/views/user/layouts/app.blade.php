<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Agatha Space')</title>

  <!-- Google Fonts: Poppins & Playfair Display -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600;700&family=Georgia&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fdfcfb;
      color: #343a40;
      padding-top: 90px; /* Disesuaikan sedikit karena brand jadi 2 baris */
      line-height: 1.6;
    }
    .playfair-font { font-family: 'Playfair Display', serif; }
    .text-primary-agatha { color: #a8745f !important; }

    /* === Navbar styles DARI LANDING PAGE & DISESUAIKAN === */
    .navbar {
      transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      /* padding-top: 0.8rem; */ /* Original app.blade.php, landing page lebih fleksibel */
      /* padding-bottom: 0.8rem; */ /* Original app.blade.php */
    }

    .navbar-brand-wrapper { /* Dari Landing Page */
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Agar sejajar kiri dengan konten lain di container */
        text-decoration: none;
        /* margin-right: auto; */ /* Agar logo selalu kiri jika ada item lain di tengah */
    }

    .navbar-brand-wrapper img { /* Dari Landing Page */
        width: 50px; /* Sedikit lebih kecil agar navbar tidak terlalu tinggi */
        height: auto;
        margin-bottom: 2px; /* Lebih rapat */
    }

    .navbar-brand-text { /* Dari Landing Page */
        font-family: 'Georgia', serif;
        font-weight: bold;
        font-size: 1.3rem; /* Sedikit lebih kecil */
        color: #000;
    }

    .navbar.scrolled { /* Dari app.blade.php & landing, digabung */
        background: rgba(255, 255, 255, 0.97) !important;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
    }

    .nav-link {
      font-weight: 500;
      margin-left: 0.35rem;
      margin-right: 0.35rem;
      padding: 0.6rem 0.5rem !important;
      transition: color 0.3s ease;
      color: #555; /* Warna default link */
      position: relative;
    }

    /* Efek hover/active dari app.blade.php (underline orange) */
    .nav-link::after {
        content: ''; position: absolute; width: 0; height: 2px;
        display: block; margin-top: 5px; right: 0;
        background: #ED5D2B; /* Warna oranye khas Agatha */
        transition: width .2s ease; -webkit-transition: width .2s ease;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%; left: 0; background: #ED5D2B;
    }
    /* Warna teks hover dan active (bisa disamakan dengan landing page jika mau) */
    .nav-link:hover {
        color: #a86a5c !important; /* Warna hover dari landing page */
    }
    .nav-link.active {
        font-weight: bold; /* Dari landing page */
        color: #d28a7c !important; /* Warna active dari landing page */
    }


    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2826, 79, 63, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Styling untuk Badge Keranjang (dari app.blade.php) */
    .cart-badge-wrapper { position: relative; display: inline-block; }
    #cart-item-count-badge {
      position: absolute;
      top: -5px;       /* Sesuaikan posisi badge */
      right: -10px;    /* Sesuaikan posisi badge */
      font-size: 0.68rem;
      padding: 0.2em 0.5em;
      line-height: 1;
      transition: opacity 0.2s ease, transform 0.2s ease;
    }
    #cart-item-count-badge.d-none-custom {
        opacity: 0;
        transform: scale(0.5);
        pointer-events: none;
    }

    /* Tombol dari landing page, disesuaikan jika perlu */
    .btn-outline-primary.rounded-pill { /* Tombol "Masuk" */
        border-color: #a86a5c; /* Sesuaikan dengan warna brand */
        color: #a86a5c;
    }
    .btn-outline-primary.rounded-pill:hover {
        background-color: #a86a5c;
        color: white;
    }
    .btn-primary.rounded-pill { /* Tombol "Daftar" */
        background-color: #ED5D2B; /* Warna khas Agatha */
        border-color: #ED5D2B;
        color: white;
    }
    .btn-primary.rounded-pill:hover {
        background-color: #d45020; /* Sedikit lebih gelap */
        border-color: #d45020;
    }

    /* User Dropdown - agar nama tidak kepotong dan ikon tetap terlihat */
    .navbar .dropdown-toggle .fa-user-circle {
        font-size: 1.2em;
    }
    .navbar .dropdown-toggle .text-truncate {
        display: inline-block;
        vertical-align: middle;
    }

    /* PERBAIKAN UNTUK GARIS BAWAH USER DROPDOWN */
    .navbar .nav-item.dropdown > a#navbarDropdownUser.nav-link {
        min-width: 170px; /* Atur lebar minimum di sini. Sesuaikan nilainya. */
        /* Jika menggunakan justify-content-start (default untuk d-flex), 
           konten (ikon+nama) akan rata kiri dalam area min-width ini. */
    }
    /* Pastikan underline pada kondisi active/hover tetap berfungsi */
    .navbar .nav-item.dropdown > a#navbarDropdownUser.nav-link.active::after,
    .navbar .nav-item.dropdown > a#navbarDropdownUser.nav-link:hover::after {
        width: 100%; /* Ini akan 100% dari min-width jika konten lebih pendek */
        left: 0;
    }

    main { min-height: calc(100vh - 90px - 70px); /* Disesuaikan dengan padding-top body */ }
    .footer { background-color: #333; color: #f0f0f0; padding: 20px 0; text-align: center; font-size: 0.9rem; }
    .footer a { color: #a8745f; text-decoration: none; }
    .footer a:hover { text-decoration: underline; }
  </style>

  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
  {{-- Navbar diubah mengikuti struktur landing page --}}
  <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
    <div class="container">
      {{-- BRAND DARI LANDING PAGE --}}
      <a class="navbar-brand-wrapper" href="{{ route('home') }}">
        @if(file_exists(public_path('images/LogoAgathaSpace.jpg')))
            <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Logo Agatha Space">
        @else
            <img src="https://via.placeholder.com/50x50.png?text=Logo" alt="Logo Agatha Space"> {{-- Sesuaikan ukuran placeholder --}}
        @endif
        <span class="navbar-brand-text">Agatha Space</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavContent" aria-controls="navbarNavContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNavContent">
        <ul class="navbar-nav align-items-lg-center"> {{-- align-items-lg-center penting untuk vertical alignment --}}
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentangkami') ? 'active' : '' }}" href="{{ route('tentangkami') }}"><i class="fas fa-users me-1"></i>Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}"><i class="fas fa-utensils me-1"></i>Menu</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}" href="{{ route('reservasi') }}"><i class="fas fa-calendar-check me-1"></i>Reservasi</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}"><i class="fas fa-images me-1"></i>Galeri</a></li>
                    <li class="nav-item">
            @auth
                {{-- INI BAGIAN YANG PERLU DIPERIKSA --}}
                <a class="nav-link {{ request()->routeIs('kritik-saran.list') ? 'active' : '' }}" href="{{ route('kritik-saran.list') }}">
                    <i class="fas fa-comment-alt me-1"></i>Kritik & Saran
                </a>
            @else
                {{-- Jika belum login, Anda sudah benar menggunakan popup --}}
                <a href="#" class="nav-link" onclick="showLoginPopupRequired(event, 'mengakses Kritik & Saran')">
                    <i class="fas fa-comment-alt me-1"></i>Kritik & Saran
                </a>
            @endauth
          </li>

          @auth
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cart.view') ? 'active' : '' }} cart-badge-wrapper" href="{{ route('cart.view') }}" title="Keranjang Belanja">
              <i class="fas fa-shopping-cart fa-lg"></i>
              @php
                  $cartItemCount = Auth::check() ? count(session('cart', [])) : 0; // Pastikan user login
              @endphp
              <span id="cart-item-count-badge"
                    class="badge rounded-pill bg-danger {{ $cartItemCount > 0 ? '' : 'd-none-custom' }}">
                  {{ $cartItemCount > 0 ? $cartItemCount : '' }}
              </span>
            </a>
          </li>
          @endauth

           {{-- TOMBOL LOGIN/USER DROPDOWN --}}
            @guest
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-outline-primary rounded-pill px-3 py-1" href="{{ route('login') }}"> {{-- Sesuaikan padding jika perlu --}}
                        <i class="fas fa-sign-in-alt me-1"></i> Masuk
                    </a>
                </li>
                <li class="nav-item ms-lg-1">
                    <a class="btn btn-primary rounded-pill px-3 py-1" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i> Daftar
                    </a>
                </li>
            @else
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2 flex-shrink-0"></i> {{-- me-2 agar ada spasi dari nama --}}
                        <span class="text-truncate" title="{{ Auth::user()->name }}" style="max-width: 120px;"> {{-- max-width disesuaikan --}}
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                        @if(Auth::user()->is_admin)
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</a></li>
                            <li><hr class="dropdown-divider"></li>
                        @endif
                        {{-- Tambahkan link profil jika ada --}}
                        {{-- <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user-edit me-2"></i>Profil Saya</a></li> --}}
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>

  <main class="flex-shrink-0 pb-5">
    @yield('content')
  </main>

  @include('user.partials.footer')

 <!-- Modal Login Diperlukan (untuk fitur yg butuh login) -->
 <div class="modal fade" id="loginRequiredFeatureModal" tabindex="-1" aria-labelledby="loginRequiredFeatureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-3">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="loginRequiredFeatureModalLabel"> <i class="fas fa-lock me-2 text-warning"></i> Masuk Diperlukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p class="mb-3">Silakan masuk terlebih dahulu untuk mengakses <strong id="featureNameLoginRequired">fitur ini</strong>.</p>
        <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-pill"> <i class="fas fa-sign-in-alt me-1"></i> Masuk Sekarang</a>
      </div>
    </div>
  </div>
</div>


  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Bootstrap Bundle JS (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom Global Scripts -->
  <script>
    // Efek scroll pada Navbar
    window.addEventListener("scroll", function () {
      const navbar = document.querySelector(".navbar");
      if (navbar) {
        navbar.classList.toggle("scrolled", window.scrollY > 50);
      }
    });

    var loginFeatureModalInstance = null;
    function showLoginPopupRequired(event, featureName = 'fitur ini') {
      event.preventDefault();
      if (!loginFeatureModalInstance) {
        var loginModalEl = document.getElementById('loginRequiredFeatureModal');
        if (loginModalEl) {
            loginFeatureModalInstance = new bootstrap.Modal(loginModalEl);
        }
      }
      if (loginFeatureModalInstance) {
        document.getElementById('featureNameLoginRequired').textContent = featureName;
        loginFeatureModalInstance.show();
      } else {
        if (confirm('Anda harus masuk untuk mengakses ' + featureName + '. Masuk sekarang?')) {
            window.location.href = "{{ route('login') }}";
        }
      }
    }

    function updateGlobalCartBadge(count) {
        const cartBadge = $('#cart-item-count-badge');
        if (cartBadge.length) {
            if (count > 0) {
                cartBadge.text(count).removeClass('d-none-custom');
            } else {
                cartBadge.text('').addClass('d-none-custom');
            }
        }
    }
    $(document).ready(function() {
        // Inisialisasi badge saat halaman dimuat, jika pengguna sudah login
        @auth
            updateGlobalCartBadge({{ count(session('cart', [])) }});
        @endauth
    });

    function showGlobalToast(icon, title) {
        const Toast = Swal.mixin({
            toast: true, position: 'top-end', showConfirmButton: false,
            timer: 3000, timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        Toast.fire({ icon: icon, title: title });
    }
  </script>

  @stack('scripts')

</body>
</html>