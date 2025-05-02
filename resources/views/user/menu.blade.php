@extends('user.layouts.app')

@section('title', 'Menu')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Menu Agatha Space</h1>

    <form action="{{ route('menu') }}" method="GET" class="row mb-4 justify-content-center">
        <div class="col-md-4 mb-2">
            <input type="text" name="search" class="form-control rounded-pill" placeholder="Cari menu... 🔍"
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-3 mb-2">
            <select name="kategori" class="form-select rounded-pill">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Cari</button>
        </div>
    </form>

    <div class="row">
        @forelse ($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow rounded-4">
                <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top p-3" alt="{{ $menu->nama }}" style="height: 200px; object-fit: contain; background-color: #f8f9fa;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->nama }}</h5>
                        <p class="card-text">{{ $menu->deskripsi }}</p>
                        <p class="card-text fw-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 rounded-pill">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-warning">Menu tidak ditemukan.</div>
            </div>
        @endforelse
    </div>

    <!-- Promo & Event Banner Section -->
    <div class="promo-event-banner mt-5 mb-4 py-4 px-3 rounded-4 text-center shadow-lg position-relative" style="background: linear-gradient(135deg, #FFB347, #FF8030);">
        <div class="row align-items-center">
            <div class="col-md-8 text-md-start text-center">
                <h2 class="text-white mb-2"><i class="fas fa-tags me-2"></i> Promo & Event Spesial</h2>
                <p class="text-white mb-0">Dapatkan berbagai penawaran menarik dan informasi tentang event terbaru kami!</p>
            </div>
            <div class="col-md-4 mt-3 mt-md-0 text-md-end text-center">
                <a href="{{ route('user.promo-event') }}" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fas fa-bullhorn me-2"></i> Lihat Promo & Event
                </a>
            </div>
        </div>
        <div class="decoration-circle position-absolute" style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; top: -20px; right: 30px;"></div>
        <div class="decoration-circle position-absolute" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; bottom: -15px; left: 40px;"></div>
    </div>
</div>
@endsection