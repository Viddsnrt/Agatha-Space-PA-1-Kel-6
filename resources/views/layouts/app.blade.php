<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agatha Space')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Agatha Space</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentangkami') ? 'active' : '' }}" href="{{ route('tentangkami') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}" href="{{ route('reservasi') }}">Reservasi</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

    {{-- Konten Halaman --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center mt-4 p-3 bg-light">
        <p>&copy; 2025 Agatha Space. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
        <script>
    window.addEventListener("scroll", function() {
        let navbar = document.querySelector(".navbar");
        navbar.classList.toggle("scrolled", window.scrollY > 50);
    });
</script>

    </script>
</body>
</html>
