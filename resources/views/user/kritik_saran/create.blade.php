@extends('user.layouts.app')

@section('title', 'Kritik & Saran Pengunjung - Agatha Space')

@push('styles')
{{-- Font Awesome jika belum ada global di app.blade.php dan dibutuhkan untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* === PAGE STYLING (Mirip dengan sebelumnya, fokus pada list) === */
    body {
        background-color: #f8f5f2;
    }

    .kritik-saran-list-page h2,
    .kritik-saran-list-page h3,
    .kritik-saran-list-page .card-title {
        font-family: 'Playfair Display', serif;
        color: #4a2f27;
    }

    .kritik-saran-list-page p,
    .kritik-saran-list-page .btn,
    .kritik-saran-list-page .alert,
    .kritik-saran-list-page .badge,
    .kritik-saran-list-page .text-muted,
    .kritik-saran-list-page .page-link /* Untuk pagination */ {
        font-family: 'Poppins', sans-serif;
    }

    .list-section {
        padding: 60px 0;
    }
    .list-section .page-header {
        margin-bottom: 50px;
    }
    .list-section .page-header .page-title {
        font-size: 2.8rem; /* Judul halaman lebih besar */
        color: #4a2f27;
        margin-bottom: 10px;
    }
    .list-section .page-header .page-subtitle {
        font-size: 1.15rem;
        color: #6c757d;
    }
    .btn-add-new { /* Tombol untuk tambah masukan baru */
        background-color: #ED5D2B;
        border-color: #ED5D2B;
        color: white;
        padding: 10px 20px;
        font-weight: 500;
        border-radius: 50px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-add-new:hover {
        background-color: #d45020;
        color: white;
        transform: translateY(-2px);
    }
    .btn-add-new i {
        margin-right: 8px;
    }


    .feedback-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border: 1px solid #eaeaea;
        display: flex;
        flex-direction: column;
    }
    .feedback-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .feedback-card .card-body {
        padding: 25px;
        flex-grow: 1;
    }
    .feedback-card .card-title {
        color: #6c4f3d;
        font-size: 1.4rem;
        margin-bottom: 0.3rem;
    }
    .feedback-card .card-subtitle.text-muted {
        font-size: 0.85rem;
        margin-bottom: 15px;
    }

    .feedback-card .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.9em;
        border-radius: 50px;
        font-weight: 500;
    }
    .feedback-card .badge.bg-kritik {
        background-color: #e74c3c;
        color: white;
    }
    .feedback-card .badge.bg-saran {
        background-color: #2ecc71;
        color: white;
    }
    .feedback-card p.pesan-text {
        color: #555;
        line-height: 1.75;
        margin-top: 10px;
        font-size: 0.95rem;
    }
    .feedback-card .feedback-image-wrapper {
        margin-top: 20px;
        overflow: hidden;
        border-radius: 8px;
    }
    .feedback-card .feedback-image {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .feedback-card:hover .feedback-image {
        transform: scale(1.05);
    }
    .no-feedback-message {
        font-size: 1.1rem;
        padding: 40px 20px;
        border: 2px dashed #ddd;
        border-radius: 10px;
        background-color: #fff;
    }

    /* Pagination styling (jika menggunakan Bootstrap 5) */
    .pagination .page-link {
        color: #6c4f3d;
        border-radius: 0.3rem; /* Sedikit rounded */
        margin: 0 3px;
    }
    .pagination .page-link:hover {
        color: #4a2f27;
        background-color: #f8f5f2;
    }
    .pagination .page-item.active .page-link {
        background-color: #a8745f;
        border-color: #a8745f;
        color: white;
    }
    .pagination .page-item.disabled .page-link {
        color: #aaa;
    }

</style>
@endpush

@section('content')
<div class="kritik-saran-list-page">
    <section class="list-section">
        <div class="container">
            <div class="page-header text-center">
                <h2 class="page-title fw-bold">Apa Kata Mereka?</h2>
                <p class="page-subtitle">Lihat masukan berharga dari para pengunjung Agatha Space.</p>
                @auth {{-- Tombol tambah hanya untuk user yang login --}}
                <a href="{{ route('kritik-saran.create') }}" class="btn btn-add-new mt-3">
                    <i class="fas fa-plus-circle"></i> Beri Masukan Baru
                </a>
                @else
                <p class="mt-3">Ingin memberi masukan? Silakan <a href="{{ route('login', ['redirect' => route('kritik-saran.create')]) }}">masuk</a> atau <a href="{{ route('register') }}">daftar</a> terlebih dahulu.</p>
                @endauth
            </div>

            @if (session('success_index')) {{-- Key session berbeda jika redirect ke index --}}
                <div class="alert alert-success text-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success_index') }}
                </div>
            @endif

            <div class="row gy-4 justify-content-center">
                @forelse ($kritikSaran as $item) {{-- Asumsi $kritikSaran sudah difilter (tampilkan=true) dan diurutkan di controller --}}
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card feedback-card w-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="card-title fw-semibold mb-0">{{ Str::words($item->nama, 3, '...') }}</h5>
                                        <small class="card-subtitle text-muted">{{ $item->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm') }}</small>
                                    </div>
                                    <span class="badge bg-{{ $item->jenis == 'kritik' ? 'kritik' : 'saran' }} ms-2 flex-shrink-0">
                                        <i class="fas {{ $item->jenis == 'kritik' ? 'fa-thumbs-down' : 'fa-thumbs-up' }} me-1"></i>
                                        {{ ucfirst($item->jenis) }}
                                    </span>
                                </div>
                                <p class="pesan-text fst-italic">"{{ Str::limit($item->pesan, 220) }}"</p>

                                @if ($item->gambar)
                                    <div class="feedback-image-wrapper text-center">
                                        <a href="{{ asset('storage/' . $item->gambar) }}" data-bs-toggle="modal" data-bs-target="#imageModal-{{$item->id}}">
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                 class="feedback-image img-fluid"
                                                 alt="Gambar dari {{ $item->nama }}">
                                        </a>
                                    </div>
                                    <!-- Modal untuk Gambar -->
                                    <div class="modal fade" id="imageModal-{{$item->id}}" tabindex="-1" aria-labelledby="imageModalLabel-{{$item->id}}" aria-hidden="true">
                                      <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                          <div class="modal-header border-0">
                                            {{-- <h5 class="modal-title" id="imageModalLabel-{{$item->id}}">Lampiran dari {{ $item->nama }}</h5> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body text-center p-0">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid" alt="Gambar dari {{ $item->nama }}" style="max-height: 80vh;">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="no-feedback-message">
                            <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada kritik atau saran yang dapat ditampilkan saat ini.</p>
                            @auth
                            <p class="text-muted">Jadilah yang pertama memberi masukan!</p>
                            @endauth
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($kritikSaran instanceof \Illuminate\Pagination\LengthAwarePaginator && $kritikSaran->hasPages())
                <div class="mt-5 pt-3 d-flex justify-content-center">
                    {{ $kritikSaran->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection