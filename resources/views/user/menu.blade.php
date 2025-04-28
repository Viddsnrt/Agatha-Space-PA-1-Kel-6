@extends('user.layouts.app')

@section('title', 'Menu')

@section('content')
    <div class="container">
        <h1 class="mb-4">Menu Agatha Space</h1>


        

        @foreach ($categories as $category)
            <h3>{{ $category->nama_kategori }}</h3>
            <div class="row">
                @foreach ($category->menus as $menu)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->nama }}</h5>
                                <p class="card-text">{{ $menu->deskripsi }}</p>
                                <p class="card-text fw-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
