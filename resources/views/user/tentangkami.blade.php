@extends('user.layouts.app')


@section('title', 'Tentang Kami - Agatha Space')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins&display=swap" rel="stylesheet">

<style>
    .tentang-kami-page {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f5f2;
    }

    .tentang-kami-page h1,
    .tentang-kami-page h2,
    .tentang-kami-page .fw-bold {
        font-family: 'Playfair Display', serif;
        color: #5e3c2c;
    }

    .tentang-kami-page p,
    .tentang-kami-page li {
        color: #3d3d3d;
    }

    .tentang-kami-page .section-bg {
        background-color: #fffdf9;
    }

    .tentang-kami-page .img-fluid {
        max-height: 350px;
        object-fit: cover;
    }
</style>

<div class="tentang-kami-page">

    <section class="container py-5 text-center">
        <h1 class="fw-bold" data-aos="fade-up">Tentang Kami</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Agatha Space adalah lebih dari sekadar kafe. Kami adalah tempat bagi pecinta kopi dan makanan berkualitas tinggi
            untuk berkumpul, berbagi cerita, dan menikmati suasana yang nyaman.
        </p>
    </section>

    <section class="container py-5 section-bg rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h2 class="fw-bold">Visi Kami</h2>
                <p>
                    Menjadi kafe terbaik di Balige dengan pelayanan terbaik, suasana yang nyaman,
                    dan cita rasa yang tak terlupakan bagi setiap pelanggan.
                </p>
                <h2 class="fw-bold mt-4">Misi Kami</h2>
                <ul class="list-unstyled">
                    <li>Menggunakan bahan berkualitas terbaik.</li>
                    <li>Menyediakan layanan ramah dan profesional.</li>
                    <li>Menciptakan suasana kafe yang nyaman dan modern.</li>
                    <li>Terus berinovasi dalam menu dan pelayanan.</li>
                </ul>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/agatha.jpg') }}" alt="Tentang Kami" class="img-fluid rounded shadow">
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="fw-bold" data-aos="fade-up">Keunggulan Kami</h2>
            <div class="row mt-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-cup-hot fs-1" style="color: brown;"></i>
                    <h4 class="mt-2">Kopi Berkualitas</h4>
                    <p>Kami menyajikan kopi terbaik dengan biji pilihan yang diseduh oleh barista berpengalaman.</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-emoji-smile fs-1" style="color: brown;"></i>
                    <h4 class="mt-2">Suasana Nyaman</h4>
                    <p>Desain interior modern dan suasana yang cozy membuat pelanggan betah berlama-lama.</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <i class="bi bi-heart fs-1" style="color: brown;"></i>></i>
                    <h4 class="mt-2">Pelayanan Terbaik</h4>
                    <p>Tim kami siap memberikan pengalaman terbaik dengan pelayanan ramah dan profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5 text-center">
        <h2 class="fw-bold" data-aos="fade-up">Galeri Agatha Space</h2>
        <div class="row mt-4">
            <div class="col-md-4" data-aos="zoom-in"><img src="{{ asset('assets/gallery-1.jpg') }}" class="img-fluid rounded shadow"></div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200"><img src="{{ asset('assets/gallery-2.jpg') }}" class="img-fluid rounded shadow"></div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400"><img src="{{ asset('assets/gallery-3.jpg') }}" class="img-fluid rounded shadow"></div>
        </div>
    </section>

</div>
@endsection
