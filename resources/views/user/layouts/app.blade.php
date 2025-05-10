<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> {{-- Tambahkan ini untuk kompatibilitas IE --}}
  <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF token di head --}}
  <title>@yield('title', 'Agatha Space')</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> {{-- Versi Bootstrap sedikit lebih baru --}}

  <!-- Font Awesome (Pilih SATU versi dan pastikan tag lengkap dan terbaru) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fdfdfd;
      color: #333;
      padding-top: 80px; /* Sesuaikan jika tinggi navbar berubah */
    }

    .navbar {
      transition: background-color 0.4s ease, box-shadow 0.4s ease;
    }

    .navbar-brand-wrapper {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .navbar-brand-wrapper img {
      width: 55px; /* Atau sesuaikan */
      height: auto;
      border-radius: 12px;
      margin-right: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand-text {
      font-weight: 700;
      font-size: 1.5rem; /* Atau sesuaikan */
      color: #2b2b2b;
    }

    .nav-link {
      font-weight: 500; /* Sedikit lebih tebal untuk keterbacaan */
      margin: 0 8px; /* Sedikit lebih banyak spasi */
      transition: all 0.3s ease;
      color: #555; /* Warna default sedikit lebih gelap */
    }

    .nav-link:hover,
    .nav-link.active {
      color: #d28a7c !important; /* Warna aktif/hover */
    }

    .navbar.scrolled {
      background-color: rgba(255, 255, 255, 0.98) !important; /* Sedikit lebih opak */
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); /* Shadow lebih halus */
    }

    .nav-item.position-relative .badge {
      position: absolute;
      top: 2px; /* Sesuaikan posisi badge */
      right: -5px; /* Sesuaikan posisi badge */
      font-size: 0.65rem; /* Ukuran badge sedikit lebih kecil */
      transform: translate(30%, -30%);
      padding: 0.2em 0.4em; /* Padding badge */
    }

    main {
      min-height: calc(100vh - 160px); /* Sesuaikan dengan tinggi navbar + footer jika footer fixed */
    }
  </style>

  @stack('styles') {{-- Untuk CSS kustom per halaman --}}
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm"> {{-- Tambah shadow-sm default --}}
    <div class="container">
      <a class="navbar-brand-wrapper" href="{{ route('home') }}">
        <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Logo Agatha Space">
        <span class="navbar-brand-text">Agatha Space</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentangkami') ? 'active' : '' }}" href="{{ route('tentangkami') }}"><i class="fas fa-users me-1"></i>Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}"><i class="fas fa-utensils me-1"></i>Menu</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}" href="{{ route('reservasi') }}"><i class="fas fa-calendar-check me-1"></i>Reservasi</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}"><i class="fas fa-images me-1"></i>Galeri</a></li> {{-- Menggunakan fa-images untuk konsistensi --}}
          <li class="nav-item">
            @auth
                <a class="nav-link {{ request()->routeIs('kritik-saran.create') ? 'active' : '' }}"
                   href="{{ route('kritik-saran.create') }}">
                    <i class="fas fa-comment-dots me-1"></i>Kritik & Saran {{-- Icon berbeda untuk variasi --}}
                </a>
            @else
                <a href="#" class="nav-link" onclick="showLoginPopup(event)">
                    <i class="fas fa-comment-dots me-1"></i>Kritik & Saran
                </a>
            @endauth
          </li>
          <li class="nav-item position-relative">
            <a class="nav-link {{ request()->routeIs('cart.view') ? 'active' : '' }}" href="{{ route('cart.view') }}"> {{-- Tambahkan active state untuk cart --}}
              <i class="fas fa-shopping-cart"></i>
              <span class="badge rounded-pill bg-danger">{{ session('cart') ? count(session('cart')) : 0 }}</span> {{-- rounded-pill untuk badge --}}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Konten utama akan dimuat di sini --}}
  <main class="pb-5"> {{-- Beri padding bottom untuk ruang sebelum footer --}}
    @yield('content')
  </main>

  @include('user.partials.footer')

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Bootstrap Bundle JS (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- Custom Scripts -->
  <script>
    // Navbar scroll effect
    window.addEventListener("scroll", function () {
      const navbar = document.querySelector(".navbar");
      if (navbar) { // Pastikan navbar ada
        navbar.classList.toggle("scrolled", window.scrollY > 50);
      }
    });

    // Fungsi untuk menampilkan modal login
    function showLoginPopup(event) {
      event.preventDefault();
      var loginModalElement = document.getElementById('loginModal');
      if (loginModalElement) { // Pastikan modal ada
        var loginModal = new bootstrap.Modal(loginModalElement);
        loginModal.show();
      }
    }
  </script>

  @stack('scripts') {{-- Skrip kustom per halaman (misalnya dari cart.blade.php) akan dimuat di sini --}}

 <!-- Modal Login Bootstrap (jika belum ada di partials/footer atau semacamnya) -->
 <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Masuk Diperlukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p class="mb-3">Silakan masuk terlebih dahulu untuk mengakses fitur Kritik & Saran.</p>
        <a href="{{ route('login') }}" class="btn btn-primary w-100">Masuk Sekarang</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>