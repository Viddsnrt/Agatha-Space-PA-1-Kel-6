<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Agatha Space')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <style>
    .navbar-brand-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
    }

    .navbar-brand-wrapper img {
      width: 60px;
      height: auto;
      margin-bottom: 5px;
    }

    .navbar-brand-text {
      font-family: 'Georgia', serif;
      font-weight: bold;
      font-size: 1.5rem;
      color: #000; /* Bisa disesuaikan warnanya */
    }

    .navbar.scrolled {
      background-color: rgba(255, 255, 255, 0.95) !important;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .nav-link.active {
      font-weight: bold;
      color: #d28a7c !important; /* warna saat aktif */
    }

    .nav-link {
      transition: 0.3s ease;
    }

    .nav-link:hover {
      color: #a86a5c !important;
    }
  </style>
  @stack('styles')
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
    <div class="container">
      <a class="navbar-brand-wrapper" href="{{ route('home') }}">
      <img src="{{ asset('images/LogoAgathaSpace.jpg') }}"
     alt="Logo Agatha Space"
     style= padding: 16px; border-radius: 12px; width: 90px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);" />





        <span class="navbar-brand-text">Agatha Space</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentangkami') ? 'active' : '' }}" href="{{ route('tentangkami') }}">Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Menu</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}" href="{{ route('reservasi') }}">Reservasi</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('kritik-saran.create') ? 'active' : '' }}" href="{{ route('kritik-saran.create') }}">Kritik & Saran</a>
          <li class="nav-item">
    <a class="nav-link" href="{{ route('cart.view') }}">
        <i class="fas fa-shopping-cart"></i> <!-- Icon keranjang -->
        @if(session('cart'))
            <span class="badge bg-danger">{{ count(session('cart')) }}</span>
        @endif
    </a>
</li>

</li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5 pt-5">
    @yield('content')
  </div>

  @include('user.partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener("scroll", function () {
      let navbar = document.querySelector(".navbar");
      navbar.classList.toggle("scrolled", window.scrollY > 50);
    });
  </script>

  @stack('scripts')
</body>
</html>
