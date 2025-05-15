<!-- Footer -->
<footer class="footer-coffee text-white mt-5">
    <div class="container-fluid py-5 px-5">
        <div class="row">
            <!-- Brand & Sosmed -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h2 class="logo-font mb-3">Agatha Space</h2>
                <p>Agatha Space bukan sekadar tempat menikmati kopi, tapi tempat beristirahat dari hiruk pikuk dunia, di mana waktu melambat dan senja menemani.</p>
                <div class="social-icons mt-4">
                    <a href="https://wa.me/6287894210997" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/agathaspace.balige" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href=https://www.tiktok.com/@agathaspace.balige?_t=ZS-8wN51NIkoug&_r=1" target="_blank" title="TikTok Agatha Space"><i class="fab fa-tiktok"></i></a>
                    </div>
            </div>

            <!-- Navigasi -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-3">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('tentangkami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li><a href="{{ route('reservasi') }}">Reservasi</a></li>
                    <li><a href="{{ route('gallery') }}">Galeri</a></li>
                    <li><a href="{{ route('kritik-saran.create') }}">Kritik & Saran</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-5 col-md-12 mb-4">
                <h5 class="mb-3">Hubungi Kami</h5>
                <ul class="list-unstyled contact-info">
                    <li><i class="fas fa-map-marker-alt me-2"></i> 83P6+5FP, Jl. Siliwangi, Kec. Balige, Toba, Sumatera Utara, Indonesia</li>
                    <li><i class="fas fa-phone me-2"></i>+62 878 9421 0997</li>
                    <!-- <li><i class="fas fa-envelope me-2"></i> agathaspace@gmail.com</li> -->
                    <li><i class="fas fa-globe me-2"></i> www.agathaspacebalige.blgumkm.site</li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4 small-text" data-aos="fade-up" data-aos-duration="1000" data-aos-offset="100">
            <p>&copy; {{ date('Y') }} Agatha Space. Semua Hak Dilindungi.</p>
        </div>
    </div>
</footer>

<!-- CSS Footer Style -->
<style>
.footer-coffee {
    background: linear-gradient(rgba(58, 29, 0, 0.88), rgba(58, 29, 0, 0.88)),
                url('/path-ke-gambar-background-kamu.jpg') no-repeat center center;
    background-size: cover;
    background-attachment: fixed;
    color: #ffffff;
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    padding: 60px 30px 40px;
}

.footer-coffee .logo-font {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    font-weight: bold;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.footer-coffee h5 {
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    color: #ffd699;
}

.footer-coffee p,
.footer-coffee li {
    font-size: 0.95rem;
    line-height: 1.6;
}

.footer-coffee ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-coffee ul li {
    margin-bottom: 10px;
}

.footer-coffee ul li a {
    color: #ffffffcc;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-coffee ul li a:hover {
    color: #ffd699;
    text-decoration: underline;
    transform: translateX(5px);
}

.footer-coffee .social-icons {
    margin-top: 15px;
}

.footer-coffee .social-icons a {
    color: #ffffff;
    font-size: 1.8rem;
    margin-right: 18px;
    transition: transform 0.4s ease, color 0.3s;
    display: inline-block;
}

.footer-coffee .social-icons a:hover {
    color: #ffd699;
    transform: scale(1.3) rotate(5deg);
    text-shadow: 0 0 10px #ffd699;
}

.footer-coffee .contact-info li {
    margin-bottom: 12px;
    display: flex;
    align-items: start;
}

.footer-coffee .contact-info i {
    color: #ffd699;
    margin-right: 8px;
    font-size: 1.1rem;
}

.footer-coffee .small-text {
    font-size: 0.85rem;
    opacity: 0.85;
    margin-top: 2.5rem;
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .footer-coffee {
        text-align: center;
    }

    .footer-coffee .social-icons {
        justify-content: center;
    }


    .footer-coffee .contact-info li {
        justify-content: center;
    }

    .footer-coffee .logo-font {
        font-size: 2.2rem;
    }

    .footer-coffee h5 {
        margin-top: 2rem;
    }
}

</style>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
