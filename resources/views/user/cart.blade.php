@extends('user.layouts.app')

@section('title', 'Keranjang')

@push('styles')
{{-- Tambahkan style jika perlu --}}
<style>
    .cart-item {
        transition: opacity 0.3s ease-out;
    }
    .rounded-4 { /* Bootstrap 5.2+ */
        border-radius: .75rem !important; /* Sesuaikan jika perlu */
    }
     .card-img-top {
        border-top-left-radius: calc(.75rem - 1px); /* Sesuaikan jika perlu */
        border-top-right-radius: calc(.75rem - 1px); /* Sesuaikan jika perlu */
    }
    .quantity-controls button {
        min-width: 30px; /* Agar tombol +/- tidak terlalu kecil */
    }
</style>
@endpush

@section('content')

@php
    $cart = session('cart', []);
    $waNumber = '6282277124955'; // Nomor WA kamu
    $initialTotalHarga = 0;
    // Hitung total awal di PHP untuk tampilan awal
    foreach ($cart as $id => $item) {
        $initialTotalHarga += $item['harga'] * $item['quantity'];
    }
@endphp

<div class="container my-5"> {{-- Beri margin atas bawah --}}
    <h2 class="mb-4 text-center playfair-font">🛒 Keranjang Belanja Anda</h2>

    <div id="cart-content"> {{-- Wrapper untuk konten cart --}}
        @if(count($cart) > 0)
            <div class="row g-4" id="cart-items-container"> {{-- Beri gap antar kolom & ID --}}
                @foreach ($cart as $id => $item)
                    {{-- Pastikan $id adalah string atau integer yang valid untuk atribut HTML --}}
                    @php $itemId = e($id); @endphp
                    <div class="col-lg-4 col-md-6 mb-4 cart-item"
                        data-id="{{ $itemId }}"
                        data-harga="{{ $item['harga'] }}"
                        data-nama="{{ e($item['nama']) }}">
                        <div class="card h-100 shadow-sm rounded-4 border-0">
                            @if(isset($item['gambar']) && $item['gambar'])
                            <img src="{{ asset('storage/' . $item['gambar']) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ e($item['nama']) }}">
                            @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image fa-3x text-muted"></i> {{-- Placeholder jika gambar tidak ada --}}
                            </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold">{{ e($item['nama']) }}</h5>
                                <p class="card-text text-primary-agatha fw-bold mb-1">
                                    Rp <span class="item-price-display">{{ number_format($item['harga'], 0, ',', '.') }}</span> / pcs
                                </p>
                                <p class="card-text mb-3">
                                    Subtotal: <strong class="text-success">Rp <span class="item-subtotal">{{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</span></strong>
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center quantity-controls">
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-minus" data-id="{{ $itemId }}">-</button>
                                        <span class="mx-2 quantity fw-bold" style="min-width: 20px; display: inline-block; text-align: center;">{{ $item['quantity'] }}</span>
                                        <button type="button" class="btn btn-outline-secondary btn-sm btn-plus" data-id="{{ $itemId }}">+</button>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove" data-id="{{ $itemId }}" title="Hapus item">
                                        <i class="fas fa-trash-alt"></i> {{-- Ikon trash yang lebih umum --}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4 pt-3 border-top" id="cart-summary">
                <h4 class="fw-bold mb-3">Total Keseluruhan: <span class="text-success">Rp <span id="cart-total-display">{{ number_format($initialTotalHarga, 0, ',', '.') }}</span></span></h4>
                 {{-- Link WA akan di-generate oleh JS --}}
                <a href="#" target="_blank" id="checkoutBtn" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                    <i class="fab fa-whatsapp me-2"></i>Lanjut Checkout via WhatsApp
                </a>
            </div>

        @else
            {{-- Pesan Keranjang Kosong --}}
            <div class="alert alert-info text-center shadow-sm" id="empty-cart-message">
                <i class="fas fa-info-circle me-2"></i>Keranjang Anda kosong. Yuk, mulai pesan makanan dan minumannya yaa!
            </div>
        @endif

         {{-- Placeholder untuk pesan kosong (jika dikosongkan via JS) --}}
         <div id="empty-cart-placeholder" class="d-none">
             <div class="alert alert-info text-center shadow-sm">
                 <i class="fas fa-info-circle me-2"></i>Keranjang Anda kosong. Yuk, mulai belanja!
             </div>
         </div>

         {{-- Kontainer checkout dan total (untuk disembunyikan jika kosong via JS) --}}
         <div id="cart-summary-placeholder" class="text-center mt-4 pt-3 border-top">
             {{-- Konten akan diisi oleh JS jika perlu --}}
         </div>


    </div> {{-- End #cart-content --}}
</div>
@endsection

@push('scripts')
{{-- Pastikan jQuery sudah di-load di layout utama atau di sini --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Pastikan Font Awesome sudah ter-link di layout utama atau di sini --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> --}}

{{-- CSRF Token Setup --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(document).ready(function () {
        // Setup CSRF token untuk semua request AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const waNumber = '{{ $waNumber }}'; // Ambil nomor WA dari PHP

        // --- Fungsi Utama untuk Update Tampilan Keranjang ---
        function updateCartView() {
            let message = "Halo Agatha Space, saya mau order:%0A%0A"; // Tambah baris kosong
            let grandTotal = 0;
            let itemCount = 0;
            const itemsContainer = $('#cart-items-container');
            const cartSummary = $('#cart-summary');
            const emptyCartMessage = $('#empty-cart-message'); // Pesan yg ada dari PHP
            const emptyCartPlaceholder = $('#empty-cart-placeholder').children().clone(); // Clone elemen pesan kosong
            const checkoutBtn = $('#checkoutBtn');
            const totalDisplay = $('#cart-total-display');

            // Iterasi setiap item yang ADA di DOM
            $('.cart-item').each(function () {
                itemCount++;
                const itemCard = $(this);
                const nama = itemCard.data('nama');
                const harga = parseInt(itemCard.data('harga'));
                // Ambil quantity terbaru dari elemen span .quantity
                const qty = parseInt(itemCard.find('.quantity').text());
                const subtotal = qty * harga;

                // Update tampilan subtotal per item
                itemCard.find('.item-subtotal').text(subtotal.toLocaleString('id-ID'));

                // Tambahkan ke total keseluruhan
                grandTotal += subtotal;

                // Tambahkan ke pesan WhatsApp
                message += `- ${nama} (${qty}x) -> Rp ${subtotal.toLocaleString('id-ID')}%0A`;
            });

            // Update tampilan total keseluruhan
            totalDisplay.text(grandTotal.toLocaleString('id-ID'));

            // Buat pesan akhir WhatsApp
            message += `%0A----------------------------%0A`; // Pemisah
            message += `*Total Pesanan: Rp ${grandTotal.toLocaleString('id-ID')}*%0A%0A`;
            message += `Mohon info selanjutnya. Terima kasih!`;

            // Update link tombol WhatsApp
            checkoutBtn.attr('href', `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`);


            // Logika Tampilkan/Sembunyikan elemen berdasarkan jumlah item
            if (itemCount === 0) {
                 // Jika kontainer item sudah kosong tapi belum ada pesan, tampilkan pesan
                if (itemsContainer.children().length === 0 && $('#cart-content').find('#empty-cart-message').length === 0) {
                    itemsContainer.hide(); // Sembunyikan row jika kosong
                    cartSummary.hide(); // Sembunyikan summary
                    // Masukkan pesan kosong dari placeholder
                    $('#cart-content').append(emptyCartPlaceholder.attr('id', 'empty-cart-message')); // Beri ID lagi
                    $('#empty-cart-message').show();
                } else if (itemCount === 0) {
                    // Jika memang sudah kosong dari awal atau baru dikosongkan
                     itemsContainer.hide();
                     cartSummary.hide();
                     emptyCartMessage.show(); // Tampilkan pesan yg mungkin sudah ada
                }

            } else {
                // Jika ada item
                emptyCartMessage.hide(); // Sembunyikan pesan kosong
                 itemsContainer.show(); // Tampilkan row item
                cartSummary.show(); // Tampilkan summary
            }
        }

        // --- Event Handlers ---

        // Tombol Tambah (+)
        $(document).on('click', '.btn-plus', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            if (id === undefined) return; // Hindari error jika id tidak ada
            sendUpdateRequest(id, 'increase');
        });

        // Tombol Kurang (-)
        $(document).on('click', '.btn-minus', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            if (id === undefined) return; // Hindari error
            const currentQty = parseInt($(`.cart-item[data-id="${id}"]`).find('.quantity').text());

            // Hanya kirim request jika quantity > 0 (Controller akan handle jika jadi 0)
            if (currentQty > 0) {
                 sendUpdateRequest(id, 'decrease');
            }
        });

        // Tombol Hapus Item (Trash Icon)
        $(document).on('click', '.btn-remove', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            if (id === undefined) return; // Hindari error

            const itemCard = $(`.cart-item[data-id="${id}"]`);
            const itemName = itemCard.data('nama'); // Ambil nama untuk konfirmasi

            Swal.fire({
                title: `Hapus ${itemName}?`,
                text: "Item ini akan dihapus dari keranjang Anda.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    sendRemoveRequest(id, itemCard); // Kirim request hapus
                }
            });
        });

        // --- Fungsi AJAX ---

        // Fungsi untuk mengirim request update quantity (+/-)
        function sendUpdateRequest(id, type) {
            const itemCard = $(`.cart-item[data-id="${id}"]`);
            const quantityElement = itemCard.find('.quantity');
            const currentQty = parseInt(quantityElement.text());

            // Tampilkan loading sederhana (opsional)
            quantityElement.html('<i class="fas fa-spinner fa-spin fa-xs"></i>');

            $.ajax({
                url: "{{ route('cart.ajaxUpdate') }}",
                type: "POST",
                data: { id: id, type: type },
                success: function(response) {
                    if (response.success) {
                        if (response.qty === 0) {
                            // Item dihapus karena quantity 0
                            itemCard.css('opacity', '0.5'); // Efek visual sebelum hilang
                            itemCard.slideUp(300, function() {
                                $(this).remove();
                                updateCartView(); // Update tampilan setelah item hilang
                                showToast('success', response.message || 'Item dihapus');
                                // Cek apakah keranjang jadi kosong total
                                if ($('.cart-item').length === 0) {
                                     updateCartView(); // Panggil lagi untuk memastikan pesan kosong muncul
                                }
                            });
                        } else {
                            // Update quantity berhasil
                            quantityElement.text(response.qty);
                            updateCartView(); // Update subtotal, total, dan link WA
                            // showToast('success', response.message || 'Kuantitas diperbarui');
                        }
                    } else {
                        // Kembalikan quantity jika gagal di server
                        quantityElement.text(currentQty);
                        showToast('error', response.message || 'Gagal memperbarui');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Kembalikan quantity jika error koneksi
                    quantityElement.text(currentQty);
                    showToast('error', 'Terjadi kesalahan jaringan.');
                    console.error("AJAX Error:", textStatus, errorThrown);
                }
            });
        }

        // Fungsi untuk mengirim request hapus item
        function sendRemoveRequest(id, itemCard) {
            // Tampilkan loading (opsional)
             itemCard.css('opacity', '0.5');

            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: { id: id },
                success: function(response) {
                    if (response.success) {
                         itemCard.slideUp(300, function() {
                            $(this).remove();
                            updateCartView(); // Update tampilan setelah item hilang
                             showToast('success', response.message || 'Item berhasil dihapus');
                            // Cek apakah keranjang jadi kosong total
                            if ($('.cart-item').length === 0) {
                                updateCartView(); // Panggil lagi untuk memastikan pesan kosong muncul
                            }
                        });
                    } else {
                        itemCard.css('opacity', '1'); // Kembalikan opacity jika gagal
                        showToast('error', response.message || 'Gagal menghapus item');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    itemCard.css('opacity', '1'); // Kembalikan opacity jika error koneksi
                    showToast('error', 'Terjadi kesalahan jaringan.');
                    console.error("AJAX Error:", textStatus, errorThrown);
                }
            });
        }

        // Fungsi helper untuk menampilkan notifikasi (Toast)
        function showToast(icon, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: icon, // 'success', 'error', 'warning', 'info', 'question'
                title: title
            });
        }


        // --- Panggilan Awal ---
        updateCartView(); // Panggil saat halaman dimuat untuk generate link WA awal dan memastikan tampilan benar

    }); // Akhir $(document).ready
</script>

{{-- Script untuk menampilkan pesan session flash (jika masih digunakan dari operasi lain) --}}
@if(session('success'))
<script>
    $(document).ready(function() {
        showToast('success', '{{ session('success') }}'); // Gunakan fungsi showToast
    });
</script>
@endif

@if(session('error'))
<script>
     $(document).ready(function() {
        showToast('error', '{{ session('error') }}'); // Gunakan fungsi showToast
    });
</script>
@endif
@endpush