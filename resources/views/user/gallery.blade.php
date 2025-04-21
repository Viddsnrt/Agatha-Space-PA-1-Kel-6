@extends('user.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Galeri Agatha Space</h1>
    
    <div class="row">
        @forelse($images as $image)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('uploads/gallery/' . $image->image) }}" class="card-img-top" alt="Gallery Image">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada gambar di galeri saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection