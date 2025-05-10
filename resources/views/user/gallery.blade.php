@extends('user.layouts.app')

@section('styles')
<!-- Paksa tombol close Lightbox agar tampil jelas -->
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<style>
/* Tombol X custom */
.lb-close-custom {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 10500;
    background-color: rgba(0,0,0,0.7);
    color: white;
    font-size: 26px;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    cursor: pointer;
    display: none; /* disembunyikan awalnya */
}
</style>
@endsection


@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Galeri Agatha Space</h1>

    <div class="row g-3"> {{-- Grid spacing kecil, tanpa whitespace besar --}}
        @forelse($images as $image)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ asset('uploads/gallery/' . $image->image) }}" data-lightbox="galeri" data-title="Foto Galeri">
                    <img src="{{ asset('uploads/gallery/' . $image->image) }}" 
                         alt="Galeri" 
                         class="img-fluid rounded shadow-sm w-100"
                         style="height: 220px; object-fit: cover;">
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada gambar di galeri saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'fadeDuration': 200,
    });

    // Tambahkan tombol X manual saat lightbox aktif
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.createElement('button');
        btn.className = 'lb-close-custom';
        btn.innerHTML = '&times;';
        document.body.appendChild(btn);

        // Deteksi saat lightbox terbuka
        document.body.addEventListener('click', function () {
            setTimeout(() => {
                const lb = document.querySelector('.lightboxOverlay');
                if (lb && lb.style.display !== 'none') {
                    btn.style.display = 'block';
                } else {
                    btn.style.display = 'none';
                }
            }, 100);
        });

        // Klik tombol X untuk tutup lightbox
        btn.addEventListener('click', () => {
            document.querySelector('.lightboxOverlay').click();
            btn.style.display = 'none';
        });
    });
</script>
@endsection
