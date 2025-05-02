@extends('user.layouts.app')

@section('title', 'Tentang Kami - Agatha Space')

@section('content')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins&display=swap" rel="stylesheet">

<!-- Scoped CSS -->
<style>
    .tentang-wrapper, .kontak-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f5f2;
    }

    .tentang-kami-page h1,
    .tentang-kami-page h2,
    .tentang-kami-page .fw-bold {
        font-family: 'Playfair Display', serif;
        color: #4a2f27;
        margin-bottom: 1rem;
    }

    .tentang-kami-page p,
    .tentang-kami-page li {
        color: #3d3d3d;
        line-height: 1.8;
    }

    .tentang-kami-page .section-bg {
        background-color: #fffdf9;
    }

    .tentang-kami-page .img-fluid {
        max-height: 350px;
        object-fit: cover;
    }

    .slogan {
        font-size: 1.25rem;
        font-weight: bold;
        color: #6c4f3d;
        font-style: italic;
        margin-top: 2rem;
    }

    .map-section {
        margin-top: 60px;
    }

    .map-container {
        width: 100%;
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .operasional {
        margin-top: 40px;
        padding: 20px;
        background-color: #fff5eb;
        border-radius: 10px;
        text-align: center;
    }

    .operasional h4 {
        font-family: 'Playfair Display', serif;
        color: #4a2f27;
    }

    .status-buka {
        background-color: #d4edda;
        color: #155724;
        padding: 8px 15px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 10px;
    }

    .status-tutup {
        background-color: #f8d7da;
        color: #721c24;
        padding: 8px 15px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 10px;
    }
</style>

<div class="tentang-kami-page">

    <section class="container py-5 text-center">
        <h1 class="fw-bold" data-aos="fade-up">Tentang Kami</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Agatha Space bukan sekadar tempat untuk menikmati kopi—ia adalah ruang untuk merasa, berbagi, dan meresapi keindahan.
        </p>
    </section>

    <section class="container py-5 section-bg rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <p>
                    Tepatnya pada bulan Maret tahun 2024, berdirilah sebuah tempat yang bukan hanya menjual kopi dan makanan—tapi juga pengalaman. Agatha Space lahir dari mimpi sederhana: menciptakan ruang di mana siapa pun bisa berhenti sejenak, menikmati senja, dan meresapi ketenangan alam.
                </p>
                <p>
                    Nama “Agatha” dipilih bukan tanpa alasan. Dalam bahasa Yunani, Agatha berarti "baik" atau "mulia"—sebuah doa agar tempat ini menjadi tempat yang menghadirkan kebaikan dan kehangatan, tidak hanya lewat hidangan, tapi juga dalam setiap pertemuan.
                </p>
                <p>
                    Keindahan panorama sunset Danau Toba yang begitu magis membuat tempat ini cepat menjadi pilihan favorit para pelancong dan penduduk lokal yang ingin menikmati sore dengan secangkir kopi hangat.
                </p>
                <p>
                    Seiring waktu, Agatha Space tumbuh menjadi lebih dari sekadar tempat nongkrong. Ia menjadi ruang cerita. Di sini, banyak kisah cinta dimulai, persahabatan dikuatkan, dan momen-momen berharga tercipta—semuanya dengan latar langit jingga yang memantul di permukaan danau.
                </p>
                <p>
                    Kini, tak hanya dikenal karena lokasinya yang menakjubkan, tapi juga karena suasananya yang hangat, pelayanan yang ramah, serta menu khas yang memadukan cita rasa lokal dan sentuhan modern.
                </p>
                <p>
                    Agatha Space bukan sekadar tempat untuk menikmati kopi. Ia adalah pelarian kecil dari hiruk pikuk dunia. Tempat di mana waktu melambat, dan senja menjadi teman setia.
                </p>
                <div class="slogan">SLOGAN: FEEL THE SPACE</div>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/agatha.jpg') }}" alt="Agatha Space" class="img-fluid rounded shadow">
            </div>
        </div>
        <div class="operasional mt-5" data-aos="fade-up" data-aos-delay="200">
    <h4>Jam Operasional</h4>
    <p class="mb-1"><strong>Mon-Fri</strong>: 11:00 - 16:00 WIB</p>
    <p class="mb-3"><strong>Sat-Sun</strong>: 11:00 - 23:00 WIB</p>
    <div id="status-operasional"></div>
</div>
    </section>

    <section class="container map-section py-5" data-aos="fade-up" data-aos-delay="300">
        <h2 class="fw-bold text-center mb-4">Lokasi Agatha Space</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.504636755564!2d99.05843961083272!3d2.335321357605683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e050019b853bb%3A0x336533534a6698ae!2sAgatha%20Space!5e0!3m2!1sid!2sid!4v1745197083525!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const now = new Date();

        // Hitung jam dalam zona WIB (UTC+7)
        const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        const wibTime = new Date(utc + (7 * 60 * 60 * 1000));

        const day = wibTime.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
        const hour = wibTime.getHours();
        const minute = wibTime.getMinutes();

        const status = document.getElementById('status-operasional');

        let openTime, closeTime;

        if (day >= 1 && day <= 5) { // Mon-Fri
            openTime = 11;
            closeTime = 22;
        } else { // Sat-Sun
            openTime = 11;
            closeTime = 23;
        }

        if (hour >= openTime && (hour < closeTime || (hour === closeTime && minute === 0))) {
            status.innerHTML = '<div class="status-buka">Kami <strong>BUKA</strong> sekarang</div>';
        } else {
            status.innerHTML = '<div class="status-tutup">Kami <strong>TUTUP</strong> sekarang</div>';
        }
    });
</script>


@endsection
