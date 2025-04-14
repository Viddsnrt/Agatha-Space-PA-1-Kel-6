@extends('user.layouts.app')

@section('body-class', 'gallery') {{-- Class body khusus halaman ini --}}

@section('content')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins&display=swap" rel="stylesheet">

<style>
    body.gallery {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f5f2;
    }

    body.gallery h1 {
        font-family: 'Playfair Display', serif;
        color: #5e3c2c;
    }

    body.gallery .gallery-img {
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    body.gallery .gallery-img:hover {
        transform: scale(1.05);
    }

    body.gallery p {
        color: #6c757d;
    }
</style>


<div class="container py-5 text-center">
    <h1>Galeri Kami</h1>
    <p>Berikut adalah beberapa momen spesial di Agatha Space!</p>

    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <img src="{{ asset('images/galeri1.jpg') }}" class="img-fluid gallery-img" alt="Galeri 1">
        </div>
        <div class="col-md-4 mb-3">
            <img src="{{ asset('images/galeri2.jpg') }}" class="img-fluid gallery-img" alt="Galeri 2">
        </div>
        <div class="col-md-4 mb-3">
            <img src="{{ asset('images/galeri3.jpg') }}" class="img-fluid gallery-img" alt="Galeri 3">
        </div>
    </div>
</div>
@endsection
