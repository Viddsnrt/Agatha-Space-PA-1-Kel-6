@extends('user.layouts.app')

@section('title', 'Keranjang')

@section('content')

@php
    $cart = session('cart', []);
    $waNumber = '6282277124955'; // Nomor WA kamu
    $initialTotalHarga = 0;
    $initialText = "Halo, saya mau order:%0A";
    foreach ($cart as $id => $item) {
        $initialTotalHarga += $item['harga'] * $item['quantity'];
        $initialText .= "- {$item['nama']} ({$item['quantity']}x) = Rp " . number_format($item['harga'] * $item['quantity'], 0, ',', '.') . "%0A";
    }
    $initialText .= "%0A*Total: Rp " . number_format($initialTotalHarga, 0, ',', '.') . "*";
@endphp

<div class="container mt-5">
    <h2 class="mb-4 text-center">🛒 Keranjang Anda</h2>

    @if(count($cart) > 0)
        <div class="row" id="cart-items-container"> {{-- Tambahkan ID di sini --}}
            @foreach ($cart as $id => $item)
                <div class="col-md-4 mb-4 cart-item"
                    data-id="{{ $id }}"
                    data-harga="{{ $item['harga'] }}"
                    data-nama="{{ $item['nama'] }}">
                    <div class="card h-100 shadow-sm rounded-4">
                        <img src="{{ asset('storage/' . $item['gambar']) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['nama'] }}</h5>
                            <p class="card-text fw-bold">Rp <span class="item-price-display">{{ number_format($item['harga'], 0, ',', '.') }}</span></p>
                            <p class="card-text">Subtotal: Rp <span class="item-subtotal">{{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</span></p> {{-- Tambahkan subtotal item --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-minus" data-id="{{ $id }}">-</button>
                                    <span class="mx-2 quantity">{{ $item['quantity'] }}</span>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-plus" data-id="{{ $id }}">+</button>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm btn-remove" data-id="{{ $id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <h4 class="fw-bold">Total Keseluruhan: Rp <span id="cart-total-display">{{ number_format($initialTotalHarga, 0, ',', '.') }}</span></h4>
        </div>

        <div class="text-center mt-3 mb-5">
            <a href="https://wa.me/{{ $waNumber }}?text={{ $initialText }}" target="_blank" id="checkoutBtn" class="btn btn-success btn-lg rounded-pill px-5">
                Lanjut Checkout via WhatsApp
            </a>
        </div>
    @else
        <div class="alert alert-info text-center" id="empty-cart-message">
            Keranjang Anda kosong.
        </div>
         {{-- Sembunyikan tombol checkout jika keranjang kosong --}}
        <div class="text-center mt-5 d-none" id="checkout-button-container">
             <h4 class="fw-bold">Total Keseluruhan: Rp <span id="cart-total-display-hidden">0</span></h4>
            <a href="#" target="_blank" id="checkoutBtn-hidden" class="btn btn-success btn-lg rounded-pill px-5">
                Lanjut Checkout via WhatsApp
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Pastikan Font Awesome sudah ter-link jika menggunakan ikon trash --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> --}}


<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const waNumber = '{{ $waNumber }}';

        // Fungsi untuk update link WhatsApp dan total harga
        function updateCartDetails() {
            let message = "Halo, saya mau order:%0A";
            let grandTotal = 0;
            let itemCount = 0;

            $('.cart-item').each(function () {
                const itemCard = $(this);
                const nama = itemCard.data('nama');
                const harga = parseInt(itemCard.data('harga'));
                const qty = parseInt(itemCard.find('.quantity').text());

                if (qty > 0) {
                    const subtotal = qty * harga;
                    message += `- ${nama} (${qty}x) = Rp ${subtotal.toLocaleString('id-ID')}%0A`;
                    grandTotal += subtotal;
                    itemCard.find('.item-subtotal').text(subtotal.toLocaleString('id-ID')); // Update subtotal per item
                    itemCount++;
                }
            });

            message += `%0A*Total: Rp ${grandTotal.toLocaleString('id-ID')}*`;

            $('#checkoutBtn').attr('href', `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`);
            $('#cart-total-display').text(grandTotal.toLocaleString('id-ID'));

            // Tampilkan atau sembunyikan pesan keranjang kosong & tombol checkout
            if (itemCount === 0) {
                if ($('#empty-cart-message').length === 0) {
                    // Jika belum ada pesan kosong, tambahkan
                     $('#cart-items-container').html(''); // Kosongkan item
                     $('#cart-items-container').parent().append('<div class="alert alert-info text-center" id="empty-cart-message">Keranjang Anda kosong.</div>');
                }
                $('#empty-cart-message').show();
                $('#checkoutBtn').parent().addClass('d-none'); // Sembunyikan container tombol checkout utama
                $('#cart-total-display').parent().addClass('d-none'); // Sembunyikan container total utama

                // Jika kamu ingin benar-benar reload untuk menunjukkan state kosong dari PHP
                // window.location.reload();
            } else {
                $('#empty-cart-message').hide();
                $('#checkoutBtn').parent().removeClass('d-none');
                $('#cart-total-display').parent().removeClass('d-none');
            }
        }


         // Tombol tambah quantity
        $(document).on('click', '.btn-plus', function (e) {
            e.preventDefault();
            console.log('Tombol Plus diklik!'); // <--- TAMBAHKAN INI
            const id = $(this).data('id');
            console.log('ID Item Plus:', id); // <--- TAMBAHKAN INI
            if (id === undefined) {
                console.error('ID tidak ditemukan untuk tombol Plus. Cek data-id pada HTML.');
                return;
            }
            updateQuantity(id, 'increase');
        });

        // Tombol kurang quantity
        $(document).on('click', '.btn-minus', function (e) {
            e.preventDefault();
            console.log('Tombol Minus diklik!'); // <--- TAMBAHKAN INI
            const id = $(this).data('id');
            console.log('ID Item Minus:', id); // <--- TAMBAHKAN INI
            if (id === undefined) {
                console.error('ID tidak ditemukan untuk tombol Minus. Cek data-id pada HTML.');
                return;
            }
            const currentQty = parseInt($(`.cart-item[data-id="${id}"]`).find('.quantity').text());
            if (currentQty > 0) {
                 updateQuantity(id, 'decrease');
            } else {
                console.log('Kuantitas sudah 0, tidak mengurangi lagi.');
            }
        });

        // Tombol hapus item
        $(document).on('click', '.btn-remove', function (e) {
            e.preventDefault();
            console.log('Tombol Hapus diklik!'); // <--- TAMBAHKAN INI
            const id = $(this).data('id');
            console.log('ID Item Hapus:', id); // <--- TAMBAHKAN INI
            if (id === undefined) {
                console.error('ID tidak ditemukan untuk tombol Hapus. Cek data-id pada HTML.');
                return;
            }

            Swal.fire({
                title: 'Hapus item?',
                text: "Anda yakin ingin menghapus item ini dari keranjang?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeItem(id);
                }
            });
        });


        // Fungsi untuk update quantity
        function updateQuantity(id, type) {
            const itemCard = $(`.cart-item[data-id="${id}"]`);
            const quantityElement = itemCard.find('.quantity');
            let currentQty = parseInt(quantityElement.text());
            let newQty = currentQty;

            if (type === 'increase') {
                newQty = currentQty + 1;
            } else if (type === 'decrease') {
                newQty = currentQty - 1;
            }

            // Optimistic UI update
            if (newQty > 0) {
                quantityElement.text(newQty);
            } else {
                 // Jika qty jadi 0 karena pengurangan, kita akan hapus item via AJAX
                 // Tidak perlu update UI quantityElement di sini, biarkan removeItem yang handle
            }
            updateCartDetails(); // Update total dan link WA segera


            $.ajax({
                url: "{{ route('cart.ajaxUpdate') }}", // Pastikan nama rute ini benar
                type: "POST",
                data: {
                    id: id,
                    type: type,
                    // _token: '{{ csrf_token() }}' // Tidak perlu jika sudah di $.ajaxSetup
                },
                success: function(response) {
                    if (response.success) {
                        if (response.qty === 0) { // Item dihapus karena quantity jadi 0
                            itemCard.fadeOut(300, function() {
                                $(this).remove();
                                updateCartDetails(); // Panggil lagi untuk memastikan
                                if ($('.cart-item').length === 0 && $('#empty-cart-message').length === 0) {
                                    // Jika ini item terakhir, tampilkan pesan kosong
                                    $('#cart-items-container').html(''); // Kosongkan item
                                    $('#cart-items-container').parent().append('<div class="alert alert-info text-center" id="empty-cart-message">Keranjang Anda kosong.</div>');
                                    $('#checkoutBtn').parent().addClass('d-none');
                                    $('#cart-total-display').parent().addClass('d-none');
                                }
                            });
                        } else {
                            // Update quantity dari server jika ada perbedaan (meski seharusnya sama dengan optimistic update)
                            quantityElement.text(response.qty);
                            updateCartDetails();
                        }
                        // Opsional: Tampilkan notifikasi sukses singkat
                        // Swal.fire('Berhasil', 'Kuantitas diperbarui', 'success');
                    } else {
                        // Rollback UI jika gagal
                        quantityElement.text(currentQty);
                        updateCartDetails();
                        Swal.fire('Error', response.message || 'Gagal memperbarui keranjang', 'error');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Rollback UI jika error koneksi
                    quantityElement.text(currentQty);
                    updateCartDetails();
                    Swal.fire('Error', 'Terjadi kesalahan: ' + textStatus + ' (' + errorThrown + ')', 'error');
                }
            });
        }

        // Fungsi untuk hapus item
        function removeItem(id) {
            const itemCard = $(`.cart-item[data-id="${id}"]`);

            $.ajax({
                url: "{{ route('cart.remove') }}", // Pastikan nama rute ini benar
                type: "POST",
                data: {
                    id: id,
                    // _token: '{{ csrf_token() }}' // Tidak perlu jika sudah di $.ajaxSetup
                },
                success: function(response) {
                    if (response.success) {
                        itemCard.fadeOut(300, function() {
                            $(this).remove();
                            updateCartDetails();
                            if ($('.cart-item').length === 0 && $('#empty-cart-message').length === 0) {
                                // Jika ini item terakhir, tampilkan pesan kosong
                                $('#cart-items-container').html(''); // Kosongkan item
                                $('#cart-items-container').parent().append('<div class="alert alert-info text-center" id="empty-cart-message">Keranjang Anda kosong.</div>');
                                $('#checkoutBtn').parent().addClass('d-none');
                                $('#cart-total-display').parent().addClass('d-none');
                            }
                        });
                        Swal.fire('Dihapus!', 'Item telah dihapus dari keranjang.', 'success');
                    } else {
                        Swal.fire('Error', response.message || 'Gagal menghapus item', 'error');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire('Error', 'Terjadi kesalahan: ' + textStatus + ' (' + errorThrown + ')', 'error');
                }
            });
        }

        // Panggil updateCartDetails saat halaman pertama kali dimuat jika ada item
        if ($('.cart-item').length > 0) {
            updateCartDetails();
        } else {
            // Jika awalnya sudah kosong, pastikan tombol checkout utama disembunyikan
            $('#checkoutBtn').parent().addClass('d-none');
            $('#cart-total-display').parent().addClass('d-none');
        }

    });
</script>

@if(session('success'))
<script>
    $(document).ready(function() { // Pastikan DOM siap
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endif

@if(session('error'))
<script>
     $(document).ready(function() { // Pastikan DOM siap
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>
@endif
@endsection