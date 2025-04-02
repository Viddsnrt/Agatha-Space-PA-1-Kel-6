@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Menu Kami</h1>
    <p class="text-center">Berbagai pilihan makanan dan minuman terbaik untuk Anda.</p>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs justify-content-center mt-4" id="menuTabs">
        <li class="nav-item">
            <a class="nav-link active" id="makanan-tab" data-bs-toggle="tab" href="#makanan">Makanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="minuman-tab" data-bs-toggle="tab" href="#minuman">Minuman</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-4">
        <!-- Makanan -->
        <div class="tab-pane fade show active" id="makanan">
            <div class="row">
                @if(isset($makanan) && $makanan->count() > 0)
                    @foreach ($makanan as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/menu/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama }}">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $item->nama }}</h5>
                                    <p class="card-text">{{ $item->deskripsi }}</p>
                                    <p class="fw-bold text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Belum ada menu makanan tersedia.</p>
                @endif
            </div>
        </div>

        <!-- Minuman -->
        <div class="tab-pane fade" id="minuman">
            <div class="row">
                @if(isset($minuman) && $minuman->count() > 0)
                    @foreach ($minuman as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <img src="{{ asset('images/menu/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama }}">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $item->nama }}</h5>
                                    <p class="card-text">{{ $item->deskripsi }}</p>
                                    <p class="fw-bold text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Belum ada menu minuman tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
