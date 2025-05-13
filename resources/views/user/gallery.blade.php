@extends('user.layouts.app')

@section('title', 'Galeri - Agatha Space') {{-- Judul Halaman --}}

@push('styles') {{-- Gunakan push agar bisa ditumpuk jika layout juga punya section styles --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<style>
    /* Styling Galeri */
    .gallery-item img {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        border: 1px solid #eee; /* Optional: border halus */
    }
    .gallery-item:hover img {
        transform: scale(1.05); /* Efek zoom sedikit saat hover */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Shadow lebih jelas saat hover */
    }

    /* == Styling Tombol Close Bawaan Lightbox2 == */
    .lb-close {
        /* Ukuran & Posisi */
        width: 40px !important; /* Paksa ukuran */
        height: 40px !important; /* Paksa ukuran */
        position: fixed !important; /* Penting agar posisi relatif ke viewport */
        top: 20px !important; /* Jarak dari atas */
        right: 20px !important; /* Jarak dari kanan */
        z-index: 9999 !important; /* Pastikan di atas segalanya */

        /* Tampilan Tombol */
        background: rgba(0, 0, 0, 0.7) url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAAAnNCSVQICAjb4U/gAAAA9klEQVQoFQEQAo//AgARADsClAD/AAAA/wDs9goArAD/Au//BABk/wQAfP8EAGQAAABkAAAAZP8EAGQAAAAYAGQAGAAAAGQAGAAAAGQAAAAAAAAAAP8GAP8AAP8GAP8AAGQAGAAAAGQAGAAAAGQAGAAAAGQAGAAAAGQAGAAAAGQAGAAAAGQAAAAAAP8EAAAAZP8EAGQAAACsAP8C7/4GAOv+BgCv/wQAZP8EAGQAAABkAAAAZP8EAGQAAAAAAP8AAP8AAAAAAAD/AAD/AAAAAAAA/wAAAP8AAAD/AAAA/wAAAP8AAAAAZP8EAAAAZP8EAAAAZP8EAGQAAAAYAGQAGAAAAGQAGAAAAGQAAAAAAP8A/wAAAAC8/wD/AAAAAAD///8AAAAAAAAAAP8i33AlZH/MbAAAAAElFTkSuQmCC') no-repeat center center !important; /* Ganti background dengan warna + ikon X sederhana (base64) */
        background-size: 16px 16px !important; /* Ukuran ikon X di dalam background */
        opacity: 0.8 !important; /* Sedikit transparan */
        border-radius: 50% !important; /* Buat jadi bulat */
        text-indent: -9999px !important; /* Sembunyikan teks default (jika ada) */
        border: 2px solid white !important; /* Optional: border putih */
        transition: opacity 0.2s ease;
        cursor: pointer;
    }

    .lb-close:hover {
        opacity: 1 !important; /* Opacity penuh saat hover */
    }

    /* Optional: Styling Navigasi (Panah Kiri/Kanan) agar konsisten */
    .lb-prev, .lb-next {
        opacity: 0.7 !important;
        transition: opacity 0.2s ease;
    }
    .lb-prev:hover, .lb-next:hover {
        opacity: 1 !important;
    }

    /* Styling caption jika ada */
    .lb-dataContainer {
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    .lb-caption {
        font-size: 0.95rem !important;
        font-weight: 500 !important;
    }
    .lb-number {
         font-size: 0.85rem !important;
    }

</style>
@endpush


@section('content')
<div class="container py-5"> {{-- Tambah padding atas bawah --}}
    {{-- Judul Halaman yang Lebih Menarik --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold playfair-font"><i class="fas fa-images text-primary-agatha me-2"></i>Galeri Agatha Space</h1>
        <p class="lead text-muted">Lihat momen dan suasana di tempat kami.</p>
    </div>


    <div class="row g-3"> {{-- g-3 untuk sedikit jarak antar gambar --}}
        @forelse($images as $image)
            <div class="col-6 col-md-4 col-lg-3 gallery-item"> {{-- Tambah class gallery-item --}}
                {{-- Pastikan path gambar benar --}}
                @php
                    $imageUrl = asset('uploads/gallery/' . $image->image);
                    // Optional: Tambahkan pengecekan jika file ada
                    // if (!file_exists(public_path('uploads/gallery/' . $image->image))) {
                    //     $imageUrl = asset('path/to/placeholder.jpg'); // Gambar placeholder jika file tidak ada
                    // }
                @endphp
                 <a href="{{ $imageUrl }}"
                    data-lightbox="galeri-agatha" {{-- Beri nama unik untuk grup lightbox --}}
                    data-title="{{ $image->caption ?? 'Foto Galeri Agatha Space' }}"> {{-- Tampilkan caption jika ada, atau default --}}
                    <img src="{{ $imageUrl }}"
                         alt="{{ $image->caption ?? 'Galeri Agatha Space' }}"
                         class="img-fluid rounded shadow-sm w-100"
                         style="height: 250px; object-fit: cover;"> {{-- Tinggi gambar bisa disesuaikan --}}
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center border shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>Belum ada gambar yang ditambahkan ke galeri saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts') {{-- Gunakan push agar bisa ditumpuk jika layout juga punya section scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script>
    // Konfigurasi Lightbox (opsional, bisa disesuaikan)
    lightbox.option({
      'resizeDuration': 200, // Durasi animasi resize
      'fadeDuration': 300,   // Durasi animasi fade in/out
      'wrapAround': true,    // Jika true, galeri akan loop (dari akhir ke awal dan sebaliknya)
      'alwaysShowNavOnTouchDevices': true, // Tampilkan panah di perangkat sentuh
      // 'disableScrolling': true, // Jika true, mencegah scroll halaman saat lightbox terbuka
      'positionFromTop': 50   // Jarak dari atas viewport (default 50)
    });

    // Tidak perlu JavaScript tambahan untuk tombol close custom lagi
</script>
@endpush