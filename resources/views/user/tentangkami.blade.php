@extends('user.layouts.app')

@section('title', 'Tentang Kami - Agatha Space')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins&display=swap" rel="stylesheet">

<style>
    .tentang-kami-page {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f1eb; /* Light cream background */
    }

    .tentang-kami-page h1,
    .tentang-kami-page h2,
    .tentang-kami-page h3,
    .tentang-kami-page .fw-bold {
        font-family: 'Playfair Display', serif;
        color: #4a2f27; /* Deep brown for headings */
        margin-bottom: 1rem; /* Ensure space around the headings */
    }

    .tentang-kami-page p,
    .tentang-kami-page li {
        color: #5c4a44; /* Subtle dark brown for text */
        line-height: 1.6; /* Improved readability with more line spacing */
        margin-bottom: 1rem; /* Adding space between paragraphs */
    }

    .section-bg {
        background-color: #fff8f0; /* Soft light cream background for sections */
        padding: 2rem 0; /* Added padding to create space */
    }

    .img-fluid {
        max-height: 350px;
        object-fit: cover;
        border-radius: 10px; /* Rounded corners for a more refined look */
        margin-bottom: 2rem; /* Ensure space below images */
    }

    .contact-card {
        background-color:rgb(72, 47, 46); /* Rich coffee brown */
        color: white;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 2rem; /* Added margin to avoid overlap with other content */
    }

    .contact-card img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 4px solid #fff;
        margin-bottom: 1rem;
    }

    .contact-card h3 {
        border-bottom: 2px solid #f1c27d; /* Subtle gold accent under the header */
        display: inline-block;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
        color: #f1c27d; /* Gold color for the heading */
    }

    .contact-card p {
        color : #ffffff
    }

    /* Icon styling for Keunggulan */
    .keunggulan-icon {
        font-size: 2.5rem;
        color: #6f4f31; /* Coffee brown */
        margin-bottom: 1rem; /* Added space between icons and text */
    }

    .keunggulan-section {
        background-color: #fef4e4; /* Light warm beige for the section background */
        padding: 3rem 0;
    }

    .keunggulan-icon:hover {
        color: #f1c27d; /* Gold accent on hover */
    }

    /* Ensure the content doesn't overlap */
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .profile-img {
        width: 100%;
        max-width: 350px;
        border-radius: 10px; /* Keep rounded corners if you like */
        margin-bottom: 2rem;
    }
</style>

<div class="tentang-kami-page">

    <!-- TENTANG KAMI -->
    <section class="container py-5 text-center">
        <h1 class="fw-bold" data-aos="fade-up">Tentang Kami</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">
            Agatha Space adalah lebih dari sekadar kafe. Kami adalah tempat bagi pecinta kopi dan makanan berkualitas tinggi
            untuk berkumpul, berbagi cerita, dan menikmati suasana yang nyaman.
        </p>
    </section>

    <!-- SEJARAH -->
    <section class="container py-5 section-bg rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Sejarah Agatha" class="img-fluid"> <!-- Just the image, no card -->
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold">Sejarah</h2>
                <p><strong>Agatha Space</strong> bukan sekadar kafe—melainkan ruang bagi pecinta kopi dan kuliner berkualitas untuk berkumpul, berbagi cerita, dan menciptakan kenangan.</p>
                <p>Dengan atmosfer yang hangat serta pelayanan ramah, kami menghadirkan pengalaman yang lebih dari sekadar menikmati kopi—kami menghadirkan kenangan. Dari aroma kopi spesial yang kami sajikan, anak hasil dari dedikasi dibuat dengan biji kopi pilihan yang diproses dengan cermat untuk menghasilkan cita rasa terbaik. Di sini setiap kunjungan adalah sebuah pengalaman rasa. Di mana aroma kopi yang meneroda berpadu dengan suasana yang nyaman. Mari nikmati setiap tegukan dan biarkan Agatha Space menjadi bagian dari cerita Anda.</p>
            </div>
        </div>
    </section>

    <!-- VISI MISI -->
    <section class="container py-5 section-bg rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h2 class="fw-bold">Visi Kami</h2>
                <p>Menjadi kafe terbaik di Balige dengan pelayanan terbaik, suasana yang nyaman, dan cita rasa yang tak terlupakan bagi setiap pelanggan.</p>
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

    <!-- KEUNGGULAN -->
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
                    <i class="bi bi-heart fs-1" style="color: brown;"></i>
                    <h4 class="mt-2">Pelayanan Terbaik</h4>
                    <p>Tim kami siap memberikan pengalaman terbaik dengan pelayanan ramah dan profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 order-md-2">
                <img src="{{ asset('images/profile\.jpg') }}" alt="Owner" class="profile-img">
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold">Kontak Kami</h3>
                <p>Alamat:</p>
                <p>Balige, Sumatera Utara</p>
                <p>083249689076</p>
                <p>agathaspace@gmail.com</p>
                <p>www.agathaspace.com</p>
            </div>
        </div>
    </section>

</div>
@endsection
