<!-- Footer -->
<footer class="footer-coffee text-white mt-5"> <!-- Kelas text-white di sini bisa diabaikan karena akan di-override oleh CSS spesifik -->
    <div class="container-fluid py-4 px-4">
        <div class="row">
            <!-- Brand & Sosmed -->
            <div class="col-lg-4 col-md-6 mb-3">
                <h2 class="logo-font mb-2">Agatha Space</h2>
                <p class="mb-2">Agatha Space bukan sekadar tempat menikmati kopi, tapi tempat beristirahat dari hiruk pikuk dunia, di mana waktu melambat dan senja menemani.</p>
                <div class="social-icons mt-3">
                    <a href="https://wa.me/6287894210997" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/agathaspace.balige" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@agathaspace.balige?_t=ZS-8wN51NIkoug&_r=1" target="_blank" title="TikTok Agatha Space"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Navigasi -->
            <div class="col-lg-3 col-md-6 mb-3">
                <h5 class="mb-2">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('tentangkami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li><a href="{{ route('reservasi') }}">Reservasi</a></li>
                    <li><a href="{{ route('gallery') }}">Galeri</a></li>
                    <li><a href="{{ route('testimoni.create') }}">Testimoni & Saran</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-5 col-md-12 mb-3">
                <h5 class="mb-2">Hubungi Kami</h5>
                <ul class="list-unstyled contact-info">
                    <li><i class="fas fa-map-marker-alt me-2"></i> 83P6+5FP, Jl. Siliwangi, Kec. Balige, Toba, Sumatera Utara, Indonesia</li>
                    <li><i class="fas fa-phone me-2"></i>+62 878 9421 0997</li>
                    <li><i class="fas fa-globe me-2"></i> www.agathaspacebalige.blgumkm.site</li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-3 small-text" data-aos="fade-up" data-aos-duration="1000" data-aos-offset="100">
            <p>© 2025 Agatha Space. Semua Hak Dilindungi.</p>
        </div>
    </div>
</footer>

<!-- CSS Footer Style -->
<style>
.footer-coffee {
    /* background: linear-gradient(rgba(58, 29, 0, 0.95), rgba(58, 29, 0, 0.95)); */ /* Dihapus/Komentari */
    background-color: #4A3B31; /* Latar Belakang Baru: Coklat tua hangat */
    color: #E0DCD1; /* Teks Utama Baru: Krem lembut */
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    padding: 30px 20px 20px;
}

.footer-coffee .logo-font {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: bold;
    letter-spacing: 0.5px;
    margin-bottom: 0.75rem;
    /* Warna logo akan mengikuti warna teks utama dari .footer-coffee jika tidak dispesifikasikan */
}

.footer-coffee h5 {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.75rem;
    color: #B08D57; /* Warna Aksen Baru: Emas antik lembut */
}

.footer-coffee p,
.footer-coffee li {
    font-size: 0.85rem;
    line-height: 1.5;
    /* Warna paragraf dan list item dasar akan mengikuti warna teks utama dari .footer-coffee */
}

.footer-coffee ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-coffee ul li {
    margin-bottom: 8px;
}

.footer-coffee ul li a {
    color: #C8C1B6; /* Warna Link List Default Baru: Krem sedikit lebih gelap */
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-coffee ul li a:hover {
    color: #B08D57; /* Warna Aksen Baru untuk hover */
    text-decoration: underline;
}

.footer-coffee .social-icons {
    margin-top: 10px;
}

.footer-coffee .social-icons a {
    color: #E0DCD1; /* Warna Ikon Sosial Default: Sama seperti teks utama */
    font-size: 1.5rem;
    margin-right: 15px;
    transition: transform 0.4s ease, color 0.3s;
    display: inline-block;
}

.footer-coffee .social-icons a:hover {
    color: #B08D57; /* Warna Aksen Baru untuk hover ikon sosial */
    transform: scale(1.2) rotate(3deg);
    text-shadow: 0 0 8px rgba(176, 141, 87, 0.5); /* Text Shadow Aksen Baru dengan sedikit transparansi */
}

.footer-coffee .contact-info li {
    margin-bottom: 8px;
    display: flex;
    align-items: start;
}

.footer-coffee .contact-info i {
    color: #B08D57; /* Warna Aksen Baru untuk ikon kontak */
    margin-right: 8px;
    font-size: 1rem;
    margin-top: 2px;
}

.footer-coffee .small-text {
    font-size: 0.8rem;
    opacity: 0.85; /* Opasitas bisa dipertahankan atau disesuaikan dengan warna teks baru */
    margin-top: 1.5rem;
    /* Warna teks copyright akan mengikuti warna teks utama dari .footer-coffee */
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .footer-coffee {
        text-align: center;
        padding: 20px 15px 15px;
    }

    .footer-coffee .social-icons {
        justify-content: center;
    }

    .footer-coffee .contact-info li {
        justify-content: center;
        font-size: 0.8rem;
    }
    .footer-coffee .contact-info i {
        font-size: 0.9rem;
    }

    .footer-coffee .logo-font {
        font-size: 1.8rem;
    }

    .footer-coffee h5 {
        margin-top: 1.5rem;
        font-size: 1rem;
    }
}
</style>

<!-- Font Awesome (pastikan ini ada di <head> atau sebelum </body> Anda) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">