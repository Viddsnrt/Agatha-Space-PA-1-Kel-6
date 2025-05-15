<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agatha Space - Kafe Terbaik di Balige</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 90px; /* Tambahkan padding atas untuk fixed navbar */
        }

        .navbar-brand-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand-wrapper img {
            width: 60px; /* Sesuaikan ukuran logo jika perlu */
            height: auto;
            margin-bottom: 2px; /* Kurangi margin jika perlu */
        }

        .navbar-brand-text {
            font-family: 'Georgia', serif; /* Atau 'Playfair Display' jika ingin konsisten */
            font-weight: bold;
            font-size: 1.2rem; /* Sesuaikan ukuran font jika perlu */
            color: #333; /* Warna teks yang lebih jelas */
            line-height: 1;
        }

        .navbar {
            transition: background 0.3s, box-shadow 0.3s;
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important; /* Sedikit lebih opaque */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* MODIFIKASI UNTUK GARIS BAWAH */
        .nav-link {
            color: #555 !important; /* Warna default link navbar */
            font-weight: 500;
            transition: color 0.3s ease, border-color 0.3s ease; /* Tambahkan transisi untuk border-color */
            padding-left: 1rem !important; /* Padding konsisten */
            padding-right: 1rem !important;
            padding-bottom: 0.5rem; /* Beri ruang untuk garis bawah (sesuaikan jika perlu) */
            border-bottom: 3px solid transparent; /* Garis bawah transparan default (sesuaikan ketebalan jika perlu) */
            text-decoration: none !important; /* Hapus underline default dari browser */
        }

        .nav-link.active,
        .nav-link:hover,
        .nav-link:focus {
            color: #ED5D2B !important; /* Warna Agatha Space */
            border-bottom-color: #ED5D2B !important; /* Warna garis bawah saat aktif/hover */
        }
        /* AKHIR MODIFIKASI UNTUK GARIS BAWAH */

        .nav-link.active {
            font-weight: 600; /* Lebih tebal untuk link aktif */
        }

        .nav-link i {
            margin-right: 6px;
        }

        .btn-outline-primary {
            border-color: #ED5D2B;
            color: #ED5D2B;
        }
        .btn-outline-primary:hover {
            background-color: #ED5D2B;
            color: white;
        }
        .btn-primary { /* Tombol utama */
            background-color: #ED5D2B;
            border-color: #ED5D2B;
            color: white;
        }
        .btn-primary:hover {
            background-color: #d45020; /* Warna lebih gelap saat hover */
            border-color: #d45020;
        }


        .hero {
            background: url('{{ asset('images/ag.jpg') }}') no-repeat center center/cover; /* Gunakan asset() helper */
            height: calc(100vh - 90px); /* Sesuaikan dengan tinggi navbar */
            min-height: 500px; /* Tinggi minimal untuk layar kecil */
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
            background: rgba(0, 0, 0, 0.55); /* Sedikit lebih gelap overlay */
        }

        .hero-content { /* Ganti dari .hero div */
            position: relative;
            z-index: 1;
            max-width: 700px;
            padding: 20px;
        }
        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem; /* Lebih besar */
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .hero-content p {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: rgba(255,255,255,0.9);
        }
        .hero .btn-primary {
             padding: 0.9rem 2.2rem;
             font-size: 1.1rem;
             font-weight: 600;
             border-radius: 50px;
        }


        /* Section Styles */
        .section-padding {
            padding: 80px 0;
        }
        .bg-light-agatha {
            background-color: #fdfaf7; /* Warna latar yang sangat lembut */
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: #4a2f27; /* Warna coklat tua */
            margin-bottom: 1rem;
        }
        .section-subtitle {
            font-size: 1.1rem;
            color: #777;
            margin-bottom: 3rem;
        }


        /* Tombol Warning (untuk "Lihat Selengkapnya" dll) */
        .btn-warning-agatha {
            background-color: #f9c76a;
            color: #4a2f27; /* Warna teks lebih kontras */
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-warning-agatha:hover {
            background-color: #e6b95e;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        /* Card Hover Effect */
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none; /* Hapus border default card jika ada */
            border-radius: 15px; /* Radius lebih besar */
        }

        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Why Choose Us Section */
        .why-choose-us {
            background: #fff7f0;
        }

        .card-alasan {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Untuk tinggi card yang sama */
            display: flex;
            flex-direction: column;
            padding: 25px;
        }

        .card-alasan:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .icon-alasan {
            width: 60px; /* Ukuran ikon */
            height: 60px;
            object-fit: contain; /* Agar ikon tidak terdistorsi */
            margin-bottom: 1rem;
        }

        .card-alasan h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.3rem;
            color: #4a2f27;
            margin-top: 0.5rem; /* Kurangi margin atas jika ikon di atas */
        }

        .card-alasan p {
            font-size: 0.95rem;
            color: #6c757d; /* Warna teks lebih lembut */
            margin-top: 0.5rem;
            flex-grow: 1; /* Agar paragraf mengisi ruang */
        }

        /* Menu Terbaik Card */
        #best-seller .card-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: #4a2f27;
        }
        #best-seller .card-text.text-muted {
            font-size: 0.9rem;
            min-height: 50px; /* Beri tinggi minimal untuk deskripsi agar card sejajar */
        }
        #best-seller .btn-primary { /* Tombol pesan di card menu */
            font-weight: 500;
            padding: 0.6rem 1rem;
        }

        footer {
            background-color: #333; /* Footer lebih gelap */
            padding: 50px 0;
            color: #ccc;
        }
        footer a {
            color: #f9c76a; /* Link di footer dengan warna aksen */
            text-decoration: none;
        }
        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }
        footer .social-icons a {
            color: #ccc;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s;
        }
        footer .social-icons a:hover {
            color: #f9c76a;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentangkami') ? 'active' : '' }}" href="{{ route('tentangkami') }}">
                            <i class="fas fa-users"></i>Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">
                            <i class="fas fa-utensils"></i>Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}" href="{{ route('reservasi') }}">
                            <i class="fas fa-calendar-check"></i>Reservasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">
                            <i class="fas fa-image"></i>Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <a class="nav-link {{ request()->routeIs('kritik-saran.create') ? 'active' : '' }}"
                            href="{{ route('kritik-saran.create') }}">
                                <i class="fas fa-comment-alt"></i>Kritik & Saran
                            </a>
                        @else
                            <a href="#" class="nav-link" onclick="showLoginPopup(event, 'mengakses fitur Kritik & Saran')">
                                <i class="fas fa-comment-alt"></i>Kritik & Saran
                            </a>
                        @endauth
                    </li>

                    @auth
                    <li class="nav-item position-relative ms-lg-2">
                        <a class="nav-link" href="{{ route('cart.view') }}" title="Keranjang Belanja">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="landingPageCartBadge">
                                @php
                                    $cartItemCountLanding = Auth::check() && session('cart') ? count(session('cart')) : 0;
                                @endphp
                                @if($cartItemCountLanding > 0)
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill" style="font-size: 0.6em; padding: 0.3em 0.5em;">
                                    {{ $cartItemCountLanding }}
                                </span>
                                @endif
                            </span>
                        </a>
                    </li>
                    @endauth

                    @guest
                        <li class="nav-item ms-lg-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">
                                <i class="fas fa-sign-in-alt"></i>Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-user-plus"></i>Daftar
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>{{ Str::words(Auth::user()->name, 2, '') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard Admin</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-landing').submit();">
                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form-landing" action="{{ route('logout') }}" method="POST" class="d-none">
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
        <div class="hero-content" data-aos="fade-in" data-aos-duration="1000">
            <h1 class="fw-bold">Selamat Datang di Agatha Space</h1>
            <p>Kafe nyaman dengan cita rasa terbaik di Balige</p>
            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-utensils me-2"></i>Lihat Menu
            </a>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="800">
                    <h2 class="section-title">Tentang Kami</h2>
                    <p class="mb-4 lead" style="color: #555;">Agatha Space adalah tempat terbaik untuk menikmati kopi dan makanan lezat di Balige. Kami menawarkan suasana nyaman, pelayanan ramah, dan berbagai menu berkualitas yang siap memanjakan lidah Anda.</p>
                    <a href="{{ route('tentangkami') }}" class="btn btn-warning-agatha rounded-pill">
                        <i class="fas fa-info-circle me-2"></i>Lihat Selengkapnya
                    </a>
                </div>
                <div class="col-md-6 text-center mt-4 mt-md-0" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Agatha Space Interior" class="img-fluid rounded-circle shadow-lg" style="max-width: 350px; border: 5px solid #fff7f0;">
                </div>
            </div>
        </div>
    </section>


    <!-- Menu Section -->
    <section id="best-seller" class="section-padding bg-light-agatha">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Menu Terbaik Kami</h2>
                <p class="section-subtitle">Nikmati menu pilihan terbaik dari Agatha Space</p>
            </div>
            <div class="row">
                @if(isset($bestSellers) && $bestSellers->count() > 0)
                    @foreach ($bestSellers as $menu)
                        <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 shadow-sm hover-card">
                                @if($menu->gambar && Storage::disk('public')->exists($menu->gambar))
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" style="height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                @else
                                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <i class="fas fa-image fa-3x text-light"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title">{{ $menu->nama }}</h5>
                                    <p class="card-text text-muted mb-3">{{ Str::limit($menu->deskripsi, 70) }}</p>
                                    <div class="mt-auto">
                                        <p class="fw-bold text-primary-agatha mb-3 fs-5" style="color: #ED5D2B;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                        <a href="{{ route('menu', ['search' => $menu->nama]) }}" class="btn btn-primary w-100 rounded-pill">
                                            <i class="fas fa-shopping-cart me-2"></i>Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center" data-aos="fade-up">
                        <p class="lead">Menu terbaik akan segera hadir!</p>
                    </div>
                @endif
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('menu') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                    <i class="fas fa-book-open me-2"></i>Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>


    <!-- Section Alasan Memilih Agatha Space -->
    <section class="why-choose-us section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title" data-aos="fade-up">Mengapa Memilih Agatha Space?</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Kami menawarkan pengalaman yang membuat kunjungan Anda lebih dari sekadar menikmati makanan dan minuman.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-alasan text-center">
                        <img src="{{ asset('images/icons/suasana-nyaman.jpg') }}" alt="Suasana Nyaman" class="icon-alasan">
                        <h5>Suasana Nyaman</h5>
                        <p>Tempat yang tenang dan cozy, cocok untuk bersantai, bekerja, atau berbincang santai.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-alasan text-center">
                        <img src="{{ asset('images/icons/pelayanan-ramah.jpg') }}" alt="Pelayanan Ramah" class="icon-alasan">
                        <h5>Pelayanan Ramah</h5>
                        <p>Staff kami siap melayani Anda dengan penuh keramahan dan kehangatan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-alasan text-center">
                        <img src="{{ asset('images/icons/fasilitas.png') }}" alt="Fasilitas Lengkap" class="icon-alasan">
                        <h5>Fasilitas Lengkap</h5>
                        <p>Dilengkapi Wi-Fi cepat, colokan listrik, dan ruangan ber-AC untuk kenyamanan maksimal Anda.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="card-alasan text-center">
                        <img src="{{ asset('images/icons/lokasi-strategis.jpg') }}" alt="Lokasi Strategis" class="icon-alasan">
                        <h5>Lokasi Strategis</h5>
                        <p>Mudah diakses, cocok untuk meeting, belajar, atau sekadar hangout.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    @include('user.partials.footer') {{-- Pastikan path ini benar --}}

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // Durasi animasi
            once: true // Animasi hanya berjalan sekali
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        function updateLandingPageCartBadge(count) {
            const badgeContainer = document.getElementById('landingPageCartBadge');
            if (badgeContainer) {
                if (count > 0) {
                    badgeContainer.innerHTML = `<span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill" style="font-size: 0.6em; padding: 0.3em 0.5em;">${count}</span>`;
                } else {
                    badgeContainer.innerHTML = '';
                }
            }
        }

    </script>

    <!-- Modal Login Bootstrap -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow border-0 rounded-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="loginModalLabel"><i class="fas fa-lock text-warning me-2"></i>Masuk Diperlukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3" id="loginModalMessage">Silakan masuk terlebih dahulu untuk melanjutkan.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-pill"><i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showLoginPopup(event, actionText = 'melanjutkan') {
            event.preventDefault();
            var loginModalElement = document.getElementById('loginModal');
            if (loginModalElement) {
                document.getElementById('loginModalMessage').textContent = `Silakan masuk terlebih dahulu untuk ${actionText}.`;
                var loginModal = new bootstrap.Modal(loginModalElement);
                loginModal.show();
            }
        }
    </script>

</body>
</html>