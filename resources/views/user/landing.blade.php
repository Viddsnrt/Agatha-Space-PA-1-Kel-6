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
        .navbar {
            transition: background 0.3s, box-shadow 0.3s;
        }
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .hero {
            background: url('images/nasiayampenyet.jpeg') no-repeat center center/cover;
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Agatha Space</a>
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
    <section id="about" class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-up">
                <h2 class="fw-bold">Tentang Kami</h2>
                <p>Agatha Space adalah tempat terbaik untuk menikmati kopi dan makanan lezat di Balige. Kami menawarkan suasana nyaman dengan pelayanan ramah serta menu makanan dan minuman berkualitas.</p>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-up">
                <img src="assets/about-image.jpg" alt="Tentang Kami" class="img-fluid rounded shadow">
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="container py-5 menu-section">
        <h2 class="text-center fw-bold mb-4">Menu Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 text-center mb-4" data-aos="fade-up">
                <img src="assets/menu-1.jpg" alt="Kopi Hitam" class="img-fluid">
                <h4 class="mt-2">Kopi Hitam</h4>
                <p class="fw-bold text-primary">Rp 10.000</p>
            </div>
            <div class="col-md-3 text-center mb-4" data-aos="fade-up" data-aos-delay="100">
                <img src="assets/menu-2.jpg" alt="Latte" class="img-fluid">
                <h4 class="mt-2">Latte</h4>
                <p class="fw-bold text-primary">Rp 15.000</p>
            </div>
            <div class="col-md-3 text-center mb-4" data-aos="fade-up" data-aos-delay="200">
                <img src="assets/menu-3.jpg" alt="Nasi Ayam Penyet" class="img-fluid">
                <h4 class="mt-2">Nasi Ayam Penyet</h4>
                <p class="fw-bold text-primary">Rp 25.000</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Agatha Space. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>
