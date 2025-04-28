<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agatha Space - Kafe Terbaik di Balige</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

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
            color: #000;
        }

        .navbar {
            transition: background 0.3s, box-shadow 0.3s;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            font-weight: bold;
            color: #d28a7c !important;
        }

        .nav-link {
            transition: 0.3s ease;
        }

        .nav-link:hover {
            color: #a86a5c !important;
        }

        .hero {
            background: url('images/ag.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero div {
            position: relative;
            z-index: 1;
        }

        .menu-section img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: #ff8c00;
            border: none;
            transition: background 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: #d47400;
        }

        footer {
            background-color: #f8f9fa;
            padding: 40px 0;
            text-align: center;
            color: #6c757d;
        }

        .btn-warning {
    background-color: #f9c76a !important;
    color: #000;
    border: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-warning:hover {
    background-color: #e6b95e !important;
    color: #fff;
}

.rounded-pill {
    border-radius: 50rem !important;
}

<style>
    .btn-warning {
        background-color: #f9c76a !important;
        color: #000;
        border: none;
        font-weight: 600;
        transition: 0.3s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-warning:hover {
        background-color: #e6b95e !important;
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .hover-card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.why-choose-us {
  background: #fff7f0;
}

.section-title {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.card-alasan {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  height: 100%;
}

.card-alasan:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.icon-alasan {
  width: 60px;
  height: 60px;
  object-fit: contain;
}

.card-alasan h5 {
  font-weight: 600;
  margin-top: 10px;
}

.card-alasan p {
  font-size: 0.95rem;
  color: #666;
  margin-top: 8px;
}
</style>


    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
        <div class="container">
            <a class="navbar-brand-wrapper" href="{{ route('home') }}">
                <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Logo Agatha Space"
                style="padding: 16px; border-radius: 12px; width: 90px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);" />
                <span class="navbar-brand-text">Agatha Space</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentangkami') ? 'active' : '' }}" href="{{ route('tentangkami') }}">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Menu</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}" href="{{ route('reservasi') }}">Reservasi</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('kritik-saran.create') ? 'active' : '' }}" href="{{ route('kritik-saran.create') }}">Kritik & Saran</a></li>

        @guest
            <li class="nav-item ms-3">
                <a href="{{ route('login') }}" class="btn btn-warning rounded-pill px-4 me-2">Masuk</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="btn btn-warning rounded-pill px-4">Daftar</a>
            </li>
        @else
            <li class="nav-item dropdown ms-3">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</div>

        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1 class="fw-bold">Selamat Datang di Agatha Space</h1>
            <p>Kafe nyaman dengan cita rasa terbaik di Balige</p>
            <a href="#menu" class="btn btn-primary btn-lg">Lihat Menu</a>
        </div>
    </section>

    <!-- Tentang Kami -->
  <!-- Tentang Kami -->
<section id="about" class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6" data-aos="fade-up">
            <h2 class="fw-bold">Tentang Kami</h2>
            <p>Agatha Space adalah tempat terbaik untuk menikmati kopi dan makanan lezat di Balige. Kami menawarkan suasana nyaman, pelayanan ramah, dan berbagai menu berkualitas yang siap memanjakan lidah Anda.</p>
            <a href="{{ route('tentangkami') }}" class="btn btn-warning rounded-pill mt-3">Lihat Selengkapnya</a>
        </div>
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Agatha Space" class="img-fluid rounded shadow" style="max-width: 80%;">
        </div>
    </div>
</section>


    <!-- Menu Section -->
    <section id="best-seller" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Menu Terbaik Kami</h2>
            <p class="text-muted">Nikmati menu pilihan terbaik dari Agatha Space</p>
        </div>
        <div class="row">
            @foreach ($bestSellers as $menu)
                <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card h-100 shadow-sm border-0 hover-card">
                        <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $menu->nama }}</h5>
                            <p class="card-text text-muted mb-3">{{ Str::limit($menu->deskripsi, 60) }}</p>
                            <div class="mt-auto">
                                <p class="fw-bold text-primary mb-2">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('menu') }}" class="btn btn-primary w-100">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


            <!-- Section Alasan Memilih Agatha Space -->
<section class="why-choose-us py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title" data-aos="fade-up">Mengapa Memilih Agatha Space?</h2>
      <p data-aos="fade-up" data-aos-delay="100">
        Kami menawarkan pengalaman yang membuat kunjungan Anda lebih dari sekadar menikmati makanan dan minuman.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card-alasan text-center p-4">
          <img src="images/icons/suasana-nyaman.jpg" alt="Suasana Nyaman" class="icon-alasan mb-3">
          <h5>Suasana Nyaman</h5>
          <p>Tempat yang tenang dan cozy, cocok untuk bersantai, bekerja, atau berbincang santai.</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card-alasan text-center p-4">
          <img src="/images/icons/pelayanan-ramah.jpg" alt="Pelayanan Ramah" class="icon-alasan mb-3">
          <h5>Pelayanan Ramah</h5>
          <p>Staff kami siap melayani Anda dengan penuh keramahan dan kehangatan.</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
        <div class="card-alasan text-center p-4">
          <img src="/images/icons/fasilitas.png" alt="Fasilitas Lengkap" class="icon-alasan mb-3">
          <h5>Fasilitas Lengkap</h5>
          <p>Dilengkapi Wi-Fi cepat, colokan listrik, dan ruangan ber-AC untuk kenyamanan maksimal Anda.</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="500">
        <div class="card-alasan text-center p-4">
          <img src="/images/icons/lokasi-strategis.jpg" alt="Lokasi Strategis" class="icon-alasan mb-3">
          <h5>Lokasi Strategis</h5>
          <p>Mudah diakses dari pusat kota, cocok untuk meeting, belajar, atau sekadar hangout.</p>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>
