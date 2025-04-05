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
    }
</style>

<div class="kontak-wrapper">
    <div class="container">
        <h1 class="text-center mb-3">Kontak Kami</h1>
        <p class="text-center">
            Hubungi kami di <strong>0812-3456-7890</strong> atau kunjungi langsung kafe kami di Jl. Kopi Damai No. 12, Bandung.
        </p>
    </div>
</div>
@endsection
