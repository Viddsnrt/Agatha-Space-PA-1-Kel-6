@extends('layouts.app')

@section('content')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins&display=swap" rel="stylesheet">

<!-- Scoped CSS for Kontak Page -->
<style>
    .kontak-wrapper {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f5f2;
        padding: 3rem 0;
    }

    .kontak-wrapper h1 {
        font-family: 'Playfair Display', serif;
        color: #5e3c2c;
    }

    .kontak-wrapper p {
        color: #4a3b2c;
    }

    .kontak-wrapper .card {
        background-color: #fffdf9;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 1rem;
    }

    .btn-wa {
        background-color: #25D366;
        color: white;
    }

    iframe {
        border: 0;
        border-radius: 1rem;
        width: 100%;
        height: 300px;
    }
</style>

<div class="kontak-wrapper">
    <div class="container">
        <h1 class="text-center mb-3">Kontak Kami</h1>
        <p class="text-center mb-5">
            Hubungi kami di <strong>0812-3456-7890</strong> atau kunjungi langsung kafe kami di <strong>Jl. Siliwangi, Balige</strong>.
            Kami siap melayani Anda dengan sepenuh hati! ☕
        </p>

        <div class="row g-4">
            <!-- Form Kontak -->
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <h5 class="mb-3">Tinggalkan Pesan</h5>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="nama@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>

            <!-- Info & Maps -->
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <h5 class="mb-3">Jam Operasional</h5>
                    <ul class="list-unstyled mb-4">
                        <li>Senin - Jumat: 08.00 - 22.00</li>
                        <li>Sabtu - Minggu: 09.00 - 23.00</li>
                        <li>Hari Libur: Tetap Buka</li>
                    </ul>
                    <a href="https://wa.me/628979598744" target="_blank" class="btn btn-wa mb-3">
                        <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                    </a>
                    <h5 class="mb-2">Lokasi Kami</h5>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.504636755564!2d99.05843961083269!3d2.335321357605681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e050019b853bb%3A0x336533534a6698ae!2sAgatha%20Space!5e0!3m2!1sid!2sid!4v1743859455809!5m2!1sid!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
