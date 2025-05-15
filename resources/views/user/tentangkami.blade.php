@extends('user.layouts.app')

@section('title', 'Tentang Kami - Agatha Space')

@section('content')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<!-- Font Awesome (jika belum ada di app.blade.php) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<!-- Scoped CSS -->
<style>
    body {
        background-color: #fdfaf6; /* Warna latar belakang utama yang lembut */
    }

    .tentang-kami-page {
        font-family: 'Poppins', sans-serif;
        color: #3d3d3d;
    }

    .tentang-kami-page h1,
    .tentang-kami-page h2,
    .tentang-kami-page h3,
    .tentang-kami-page h4,
    .tentang-kami-page .fw-bold,
    .playfair-font { /* Kelas helper untuk font Playfair */
        font-family: 'Playfair Display', serif;
        color: #4a2f27; /* Coklat tua untuk heading */
    }

    .tentang-kami-page p,
    .tentang-kami-page li {
        line-height: 1.8;
        font-size: 1rem; /* Sedikit perbesar font body */
        color: #5a5a5a; /* Abu-abu yang lebih lembut untuk teks */
    }

    /* Hero Section */
    .hero-tentang {
    background-color: #f8f9fa; /* Abu-abu sangat muda (Bootstrap default light) */
    padding: 100px 0;
    color: #333; /* Teks menjadi abu-abu gelap atau hitam */
    text-align: center;
}
.hero-tentang h1 {
    font-size: 3.5rem;
    color: #4a2f27; /* Bisa juga #333 atau warna utama brand Anda */
    text-shadow: none;
}
.hero-tentang .lead {
    font-size: 1.25rem;
    color: #555; /* Warna subjudul abu-abu */
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

    /* Section Cerita Kami */
    .cerita-kami-section {
        background-color: #fffdf9;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .cerita-kami-section .img-fluid {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        max-height: 450px; /* Sesuaikan jika perlu */
        object-fit: cover;
    }

    .slogan-box {
        background-color:rgb(242, 248, 244);
        border-left: 5px solid #a8745f; /* Aksen warna */
        padding: 20px;
        margin: 30px 0;
        border-radius: 8px;
    }
    .slogan-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.75rem;
        font-weight: 500;
        color:rgb(64, 74, 39);
        font-style: italic;
        margin: 0;
    }

    /* Kunjungi & Hubungi Kami Section */
    .kunjungi-hubungi-section {
        padding: 60px 0;
    }

    .info-card {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.07);
        height: 100%; /* Agar kartu sejajar tingginya jika konten berbeda */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .info-card h4.card-title {
        font-family: 'Playfair Display', serif;
        color: #4a2f27;
        margin-bottom: 20px;
        font-size: 1.8rem;
    }

    .operasional-list p {
        margin-bottom: 0.5rem;
        font-size: 1rem;
        color: #3d3d3d;
    }
    .operasional-list strong {
        color: #4a2f27;
    }

    .status-buka, .status-tutup {
        padding: 10px 20px;
        border-radius: 25px; /* Lebih bulat */
        font-weight: 600;
        display: inline-block;
        margin-top: 15px;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }
    .status-buka {
        background-color: #e6f7ec; /* Hijau muda */
        color: #237840; /* Hijau tua */
        border: 1px solid #b7e4c7;
    }
    .status-tutup {
        background-color: #feecec; /* Merah muda */
        color: #a32323; /* Merah tua */
        border: 1px solid #f7c5c5;
    }

    .kontak-info-list .kontak-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 1.05rem;
    }
    .kontak-info-list i {
        font-size: 1.5rem; /* Perbesar ikon */
        color: #a8745f; /* Warna aksen untuk ikon */
        margin-right: 15px;
        width: 25px; /* Lebar tetap agar teks align */
        text-align: center;
    }
    .kontak-info-list a {
        color: #6c4f3d;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    .kontak-info-list a:hover {
        color: #4a2f27; /* Warna lebih gelap saat hover */
        text-decoration: underline;
    }

    /* Map Section */
    .map-section {
        padding: 60px 0;
        background-color: #f8f5f2; /* Latar belakang berbeda untuk variasi */
    }
    .map-section h2 {
        margin-bottom: 30px;
    }
    .map-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        height: 450px; /* Sedikit lebih tinggi */
    }
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }
    .address-text {
        font-size: 1.1rem;
        color: #4a2f27;
        margin-top: 20px;
    }
    .address-text i {
        color: #a8745f;
        margin-right: 8px;
    }


</style>

<div class="tentang-kami-page">

    <!-- Hero Section -->
    <section class="hero-tentang text-center">
        <div class="container">
            <h1 data-aos="fade-up">Tentang Agatha Space</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="200">
                Bukan sekadar tempat untuk menikmati kopi—ia adalah ruang untuk merasa, berbagi, dan meresapi keindahan.
            </p>
        </div>
    </section>

    <!-- Cerita Kami Section -->
    <section class="container py-5">
        <div class="cerita-kami-section p-4 p-md-5">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right">
                    <h2 class="fw-bold mb-4">Kisah di Balik Agatha Space</h2>
                    <p>
                        Tepatnya pada bulan Maret tahun 2024, berdirilah sebuah tempat yang bukan hanya menjual kopi dan makanan—tapi juga pengalaman. Agatha Space lahir dari mimpi sederhana: menciptakan ruang di mana siapa pun bisa berhenti sejenak, menikmati senja, dan meresapi ketenangan alam.
                    </p>
                    <p>
                        Nama “Agatha” dipilih bukan tanpa alasan. Dalam bahasa Yunani, Agatha berarti "baik" atau "mulia"—sebuah doa agar tempat ini menjadi tempat yang menghadirkan kebaikan dan kehangatan, tidak hanya lewat hidangan, tapi juga dalam setiap pertemuan.
                    </p>
                    <p>
                        Keindahan panorama sunset Danau Toba yang begitu magis membuat tempat ini cepat menjadi pilihan favorit para pelancong dan penduduk lokal yang ingin menikmati sore dengan secangkir kopi hangat.
                    </p>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                    <img src="{{ asset('images/agatha.jpg') }}" alt="Suasana Agatha Space" class="img-fluid">
                </div>
            </div>
            <div class="row mt-4 align-items-center">
                 <div class="col-lg-5 text-center order-lg-1 d-none d-lg-block" data-aos="fade-right" data-aos-delay="200">
                    <!-- Anda bisa menambahkan gambar lain di sini jika ada, atau hapus kolom ini jika tidak -->
                    <img src="{{ asset('images/agatha-interior.jpg') }}" alt="Interior Agatha Space" class="img-fluid">
                </div>
                <div class="col-lg-7 order-lg-2" data-aos="fade-left">
                     <p>
                        Seiring waktu, Agatha Space tumbuh menjadi lebih dari sekadar tempat nongkrong. Ia menjadi ruang cerita. Di sini, banyak kisah cinta dimulai, persahabatan dikuatkan, dan momen-momen berharga tercipta—semuanya dengan latar langit jingga yang memantul di permukaan danau.
                    </p>
                    <p>
                        Kini, tak hanya dikenal karena lokasinya yang menakjubkan, tapi juga karena suasananya yang hangat, pelayanan yang ramah, serta menu khas yang memadukan cita rasa lokal dan sentuhan modern.
                    </p>
                     <p>
                        Agatha Space adalah pelarian kecil dari hiruk pikuk dunia. Tempat di mana waktu melambat, dan senja menjadi teman setia.
                    </p>
                </div>
            </div>
            <div class="slogan-box" data-aos="zoom-in" data-aos-delay="300">
                <p class="slogan-text text-center">"FEEL THE SPACE"</p>
            </div>
        </div>
    </section>

    <!-- Kunjungi & Hubungi Kami Section -->
    <section class="kunjungi-hubungi-section">
        <div class="container">
            <h2 class="fw-bold text-center mb-5" data-aos="fade-up">Kunjungi & Hubungi Kami</h2>
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-5 col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="info-card text-center">
                        <h4 class="card-title"><i class="fas fa-clock me-2"></i>Jam Operasional</h4>
                        <div class="operasional-list">
                            <p><strong>Senin - Jumat:</strong> 11:00 - 22:00 WIB</p>
                            <p><strong>Sabtu - Minggu:</strong> 11:00 - 23:00 WIB</p>
                        </div>
                        <div id="status-operasional" class="mt-3">
                            <!-- Status akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="info-card">
                        <h4 class="card-title text-center"><i class="fas fa-paper-plane me-2"></i>Tetap Terhubung</h4>
                        <p class="text-center mb-4">Ada pertanyaan, reservasi, atau ingin kerja sama? Hubungi kami melalui:</p>
                        <div class="kontak-info-list">
                            <div class="kontak-item">
                                <i class="fas fa-phone-alt"></i>
                                +62 878 9421 0997</a>
                            </div>
                            <div class="kontak-item">
                                <i class="fab fa-instagram"></i>
                                @agathaspace.balige</a>
                            </div>
                            <div class="kontak-item">
                                <i class="fab fa-tiktok"></i>
                                @agathaspace.balige</a>
                            </div>
                             <!-- <div class="kontak-item">
                                <i class="fas fa-envelope"></i>
                               info@agathaspace.com</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2 class="fw-bold text-center" data-aos="fade-up">Temukan Kami Di Sini</h2>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9" data-aos="fade-up" data-aos-delay="100">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.504636755564!2d99.05843961083272!3d2.335321357605683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e050019b853bb%3A0x336533534a6698ae!2sAgatha%20Space!5e0!3m2!1sid!2sid!4v1745197083525!5m2!1sid!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <p class="text-center address-text mt-3" data-aos="fade-up" data-aos-delay="150">
                        <i class="fas fa-map-marker-alt"></i>  Jl. Siliwangi, Kec. Balige, Toba, Sumatera Utara.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // AOS Init
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true, // Animation happens only once
            offset: 50, // Offset (in px) from the original trigger point
        });
    }


    // Script Jam Operasional
    const statusElement = document.getElementById('status-operasional');
    if (statusElement) {
        const now = new Date();
        // Hitung jam dalam zona WIB (UTC+7)
        const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        const wibTime = new Date(utc + (7 * 60 * 60 * 1000));

        const day = wibTime.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
        const hour = wibTime.getHours();
        const minute = wibTime.getMinutes();

        let openHour, closeHour;
        let dayName = "";

        // Senin-Jumat: 1 (Mon) to 5 (Fri)
        if (day >= 1 && day <= 5) {
            openHour = 11;
            closeHour = 22;
            dayName = "hari kerja";
        } else { // Sabtu-Minggu: 0 (Sun) or 6 (Sat)
            openHour = 11;
            closeHour = 23;
            dayName = "akhir pekan";
        }

        const currentTimeInMinutes = hour * 60 + minute;
        const openTimeInMinutes = openHour * 60;
        const closeTimeInMinutes = closeHour * 60;

        if (currentTimeInMinutes >= openTimeInMinutes && currentTimeInMinutes < closeTimeInMinutes) {
            statusElement.innerHTML = `<div class="status-buka">KAMI SEDANG <strong>BUKA</strong></div>`;
        } else {
            statusElement.innerHTML = `<div class="status-tutup">KAMI SEDANG <strong>TUTUP</strong></div>`;
        }
    }
});
</script>

@endsection