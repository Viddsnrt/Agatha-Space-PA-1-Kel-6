{{-- resources/views/user/cart.blade.php --}}

@extends('user.layouts.app')

@section('title', 'Keranjang')

@section('content')
@php
    $cart = session('cart', []);
    $waNumber = '6282277124955'; // Ganti dengan nomor WA kamu tanpa tanda +
    $totalHarga = 0;
    $text = "Halo, saya mau order:%0A";
    foreach ($cart as $id => $item) {
        $totalHarga += $item['harga'] * $item['quantity'];
        $text .= "- {$item['nama']} ({$item['quantity']}x) = Rp " . number_format($item['harga'] * $item['quantity'], 0, ',', '.') . "%0A";
    }
    $text .= "%0A*Total: Rp " . number_format($totalHarga, 0, ',', '.') . "*";
@endphp

<div class="container mt-5">
    <h2 class="mb-4 text-center">🛒 Keranjang Anda</h2>

    @if(count($cart) > 0)
        <div class="row">
            @foreach ($cart as $id => $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded-4">
                        <img src="{{ asset('storage/' . $item['gambar']) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['nama'] }}</h5>
                            <p class="card-text fw-bold">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button name="type" value="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                                    <span class="mx-2">{{ $item['quantity'] }}</span>
                                    <button name="type" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                                </form>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="https://wa.me/{{ $waNumber }}?text={{ $text }}" target="_blank" id="checkoutBtn" class="btn btn-success btn-lg rounded-pill px-5">
                Lanjut Checkout via WhatsApp
            </a>
        </div>
    @else
        <div class="alert alert-info text-center">
            Keranjang Anda kosong.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

<script>
    document.getElementById('checkoutBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Menuju WhatsApp...',
            didOpen: () => {
                Swal.showLoading()
            },
            allowOutsideClick: false
        });
    });
</script>
@endsection
