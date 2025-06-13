@extends('user.layouts.app')

@section('title', 'Keranjang & Checkout Pesanan') {{-- Judul bisa disesuaikan --}}

@push('styles')
<style>
    /* ... (style Anda sebelumnya untuk .payment-details-container, dll.) ... */
    .payment-details-container { border: 1px solid #e0e0e0; padding: 1.5rem; margin-top: 1rem; border-radius: 8px; background-color: #f9f9f9; }
    .payment-details-container h6 { margin-bottom: 0.75rem; font-weight: 600; }
    .payment-details-container img.qris-image { max-width: 250px; height: auto; display: block; margin: 0 auto 1rem auto; border: 1px solid #ddd; padding: 5px; background-color: white; }
    .bank-account-info p { margin-bottom: 0.5rem; font-size: 0.95rem; }
    .bank-account-info strong { display: inline-block; min-width: 100px; }
    .btn-copy { font-size: 0.8rem; padding: 0.2rem 0.5rem; }
    .form-control.is-invalid ~ .invalid-feedback { display: block; }
</style>
@endpush

@section('content')

@php
    $cart = session('cart', []);
    $waNumber = '6282277124955';
    $user = auth()->user();
    $bankDetails = [
        'bank_name' => 'Bank BRI',
        'account_number' => '0314 0102 1987 535',
        'account_holder' => 'Donni Perdana Kesuma',
    ];
    $qrisImageUrl = asset('images/qris_agatha.png');
@endphp

<div class="container my-5">
    <h2 class="mb-5 text-center playfair-font">🛒 Keranjang & Checkout Pesanan Anda</h2>

    <div id="cart-content" class="row">
        @if(count($cart) > 0)
            {{-- Kolom Kiri: Item Keranjang & Ringkasan --}}
            <div class="col-lg-7 mb-4 mb-lg-0">
                <h4 class="mb-3">Item Pesanan:</h4>
                <div class="row g-3 mb-4" id="cart-items-container">
                    @foreach ($cart as $id => $item)
                        @php $itemId = e($id); @endphp
                        <div class="col-md-6 cart-item"
                            data-id="{{ $itemId }}"
                            data-harga="{{ $item['harga'] }}"
                            data-nama="{{ e($item['nama']) }}">
                            <div class="card h-100 shadow-sm rounded-3 border-0">
                                @if(isset($item['gambar']) && $item['gambar'] && Storage::disk('public')->exists($item['gambar']))
                                    <img src="{{ asset('storage/' . $item['gambar']) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ e($item['nama']) }}">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="card-title fw-semibold mb-1">{{ e($item['nama']) }}</h6>
                                    <p class="card-text text-primary-agatha small mb-1">
                                        Rp <span class="item-price-display">{{ number_format($item['harga'], 0, ',', '.') }}</span>
                                    </p>
                                    <p class="card-text small mb-2">
                                        Subtotal: <strong class="text-success">Rp <span class="item-subtotal">{{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</span></strong>
                                    </p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center quantity-controls">
                                        <div>
                                            <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2 btn-minus" data-id="{{ $itemId }}">-</button>
                                            <span class="mx-2 quantity fw-bold small" style="min-width: 15px; display: inline-block; text-align: center;">{{ $item['quantity'] }}</span>
                                            <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2 btn-plus" data-id="{{ $itemId }}">+</button>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 btn-remove" data-id="{{ $itemId }}" title="Hapus item">
                                            <i class="fas fa-trash-alt fa-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-summary-box sticky-top" style="top: 20px;">
                    <h5>Ringkasan Pesanan</h5>
                    <ul id="order-summary-list"></ul>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total Keseluruhan:</span>
                        <span class="text-success">Rp <span id="cart-total-display">0</span></span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Form Checkout --}}
            <div class="col-lg-5">
                <div class="checkout-form-card">
                    <h4 class="playfair-font mb-4 text-center">Formulir Data Pemesan</h4>
                    <form id="checkoutForm" method="POST" action="{{ route('order.place') }}">
                        @csrf
                        {{-- Input Nama --}}
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ $user->name ?? old('customer_name') }}" required placeholder="Nama lengkap Anda">
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Input No HP/WA --}}
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Nomor WhatsApp (Opsional)</label>
                            <input type="tel" class="form-control form-control-lg @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ $user->phone ?? old('customer_phone') }}" placeholder="cth: 081234567890">
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ===== AWAL: INPUT JAM KEDATANGAN ===== --}}
                        <div class="mb-3">
                            <label for="jam_kedatangan" class="form-label">Jam Kedatangan (Estimasi) <span class="text-danger">*</span></label>
                            <input type="time" class="form-control form-control-lg @error('jam_kedatangan') is-invalid @enderror" id="jam_kedatangan" name="jam_kedatangan" value="{{ old('jam_kedatangan') }}" required>
                            <small class="form-text text-muted">Buat perkiraan jam Anda akan tiba di tempat.</small>
                            @error('jam_kedatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- ===== AKHIR: INPUT JAM KEDATANGAN ===== --}}

                        {{-- Input Metode Pembayaran --}}
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                <option value="Tunai di Tempat" {{ old('payment_method') == 'Tunai di Tempat' ? 'selected' : '' }}>Tunai di Tempat (COD)</option>
                                <option value="Transfer Bank" {{ old('payment_method') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="paymentDetailsContainer" class="payment-details-container d-none">
                            {{-- Konten akan diisi oleh JavaScript --}}
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label">Catatan Tambahan (Opsional)</label>
                            <textarea class="form-control form-control-lg @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="Permintaan khusus, alergi, dll.">{{ old('notes') }}</textarea>
                             @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="total_amount_for_db" id="total_amount_for_db">
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg btn-block rounded-pill" id="sendOrderBtn">
                                <i class="fab fa-whatsapp me-2"></i>Kirim Pesanan & Lanjut ke WhatsApp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm" id="empty-cart-message">
                    <i class="fas fa-info-circle me-2"></i>Keranjang Anda kosong. Yuk, mulai pesan!
                    <br><a href="{{ route('menu') }}" class="btn btn-primary mt-3">Lihat Menu</a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal Login Diperlukan -->
<div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0 rounded-3">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="loginRequiredModalLabel"> <i class="fas fa-lock me-2 text-warning"></i> Masuk Diperlukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Silakan masuk terlebih dahulu untuk melanjutkan proses checkout dan menyimpan pesanan Anda.
            </div>
            <div class="modal-footer border-0 justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4"> <i class="fas fa-sign-in-alt me-1"></i> Masuk Sekarang</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    const IS_LOGGED_IN = {{ Auth::check() ? 'true' : 'false' }};
    const bankDetails = @json($bankDetails);
    const qrisImageUrl = "{{ $qrisImageUrl }}";
</script>
<script>
$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    const waNumber = '{{ $waNumber }}';
    var loginModalElement = document.getElementById('loginRequiredModal');
    var loginModal = loginModalElement ? new bootstrap.Modal(loginModalElement) : null;

    function generateWhatsAppMessageAndSummary() {
        let waMessage = "Halo Agatha Space, saya mau order:\n\n";
        let grandTotal = 0;
        let itemCount = 0;
        const orderSummaryList = $('#order-summary-list');
        orderSummaryList.empty();

        $('.cart-item').each(function () {
            itemCount++;
            const itemCard = $(this);
            const nama = itemCard.data('nama');
            const harga = parseInt(itemCard.data('harga'));
            const qty = parseInt(itemCard.find('.quantity').text());
            const subtotal = qty * harga;
            const formattedSubtotal = subtotal.toLocaleString('id-ID');

            itemCard.find('.item-subtotal').text(formattedSubtotal);
            orderSummaryList.append(`<li><span>${nama} (${qty}x)</span> <span>Rp ${formattedSubtotal}</span></li>`);
            waMessage += `- ${nama} (${qty}x) -> Rp ${formattedSubtotal}\n`;
            grandTotal += subtotal;
        });

        const formattedGrandTotal = grandTotal.toLocaleString('id-ID');
        waMessage += `\n----------------------------\n`;
        waMessage += `*Total Pesanan: Rp ${formattedGrandTotal}*\n\n`;

        const customerName = $('#customer_name').val() || "[Nama Belum Diisi]";
        const paymentMethodSelected = $('#payment_method').val() ? $('#payment_method option:selected').text() : "[Metode Bayar Belum Dipilih]";
        const customerNotes = $('#notes').val() || "-";
        const customerPhone = $('#customer_phone').val() || "-";
        const jamKedatangan = $('#jam_kedatangan').val() || "[Jam Belum Dipilih]"; // Mengambil nilai jam kedatangan

        waMessage += `Data Pemesan:\n`;
        waMessage += `*Nama:* ${customerName}\n`;
        waMessage += `*No. WA:* ${customerPhone}\n`;
        waMessage += `*Jam Kedatangan (Estimasi):* ${jamKedatangan}\n`; // Menyertakan jam kedatangan
        waMessage += `*Metode Pembayaran:* ${paymentMethodSelected}\n`;
        waMessage += `*Catatan:* ${customerNotes}\n\n`;
        waMessage += `Mohon segera diproses. Terima kasih!`;

        $('#total_amount_for_db').val(grandTotal);
        $('#cart-total-display').text(formattedGrandTotal);

        if (itemCount === 0 && $('#empty-cart-message').length === 0) {
             $('#cart-content').html(`<div class="col-12"><div class="alert alert-info text-center shadow-sm" id="empty-cart-message"><i class="fas fa-info-circle me-2"></i>Keranjang kosong.<br><a href="{{ route('menu') }}" class="btn btn-primary mt-3">Lihat Menu</a></div></div>`);
        }
        return { waMessage, itemCount }; // Kembalikan waMessage untuk digunakan di submit handler
    }

    // Event Handlers (+, -, hapus) dan fungsi AJAX (sendUpdateRequest, sendRemoveRequest) tetap sama
    $(document).on('click', '.btn-plus', function(e){ sendUpdateRequest($(this).data('id'), 'increase'); });
    $(document).on('click', '.btn-minus', function(e){ const id=$(this).data('id'); const qty=parseInt($(`.cart-item[data-id="${id}"] .quantity`).text()); if(qty>0) sendUpdateRequest(id, 'decrease'); });
    $(document).on('click', '.btn-remove', function(e){ const id=$(this).data('id'); const card=$(`.cart-item[data-id="${id}"]`); const name=card.data('nama'); Swal.fire({title:`Hapus ${name}?`,text:"Item akan dihapus.",icon:'warning',showCancelButton:true,confirmButtonColor:'#d33',cancelButtonColor:'#6c757d',confirmButtonText:'Ya, Hapus!',cancelButtonText:'Batal'}).then(r=>{if(r.isConfirmed)sendRemoveRequest(id,card);}); });

    function sendUpdateRequest(id, type) {
        const itemCard = $(`.cart-item[data-id="${id}"]`);
        const quantityElement = itemCard.find('.quantity');
        const currentQty = parseInt(quantityElement.text());
        quantityElement.html('<i class="fas fa-spinner fa-spin fa-xs"></i>');
        $.ajax({
            url: "{{ route('cart.ajaxUpdate') }}", type: "POST", data: { id: id, type: type },
            success: function(response) {
                if (response.success) {
                    if (response.qty === 0) { itemCard.slideUp(300, function() { $(this).remove(); generateWhatsAppMessageAndSummary(); }); }
                    else { quantityElement.text(response.qty); generateWhatsAppMessageAndSummary(); }
                } else { quantityElement.text(currentQty); generateWhatsAppMessageAndSummary(); showToast('error', response.message || 'Gagal update');}
            }, error: function() { quantityElement.text(currentQty); generateWhatsAppMessageAndSummary(); showToast('error', 'Error koneksi.');}
        });
    }
    function sendRemoveRequest(id, itemCard) {
        itemCard.css('opacity', '0.5');
        $.ajax({
            url: "{{ route('cart.remove') }}", type: "POST", data: { id: id },
            success: function(response) {
                if (response.success) { itemCard.slideUp(300, function() { $(this).remove(); generateWhatsAppMessageAndSummary(); }); showToast('success', response.message || 'Item dihapus');}
                else { itemCard.css('opacity', '1'); showToast('error', response.message || 'Gagal hapus');}
            }, error: function() { itemCard.css('opacity', '1'); showToast('error', 'Error koneksi.');}
        });
    }

    // Event listener untuk dropdown metode pembayaran (tetap sama)
    $('#payment_method').on('change', function() {
        const selectedMethod = $(this).val();
        const detailsContainer = $('#paymentDetailsContainer');
        detailsContainer.html('');
        if (selectedMethod === 'Transfer Bank') {
            const bankHtml = `
                <h6><i class="fas fa-university me-2"></i>Transfer ke Rekening Berikut:</h6>
                <div class="bank-account-info">
                    <p><strong>Bank:</strong> ${bankDetails.bank_name}</p>
                    <p>
                        <strong>No. Rekening:</strong>
                        <span id="accountNumberText">${bankDetails.account_number}</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary ms-2 btn-copy" data-clipboard-target="#accountNumberText" title="Salin Nomor Rekening">
                            <i class="fas fa-copy"></i> Salin
                        </button>
                    </p>
                    <p><strong>Atas Nama:</strong> ${bankDetails.account_holder}</p>
                </div>
                <p class="text-muted small mt-2">Mohon lakukan konfirmasi setelah transfer dengan menyertakan bukti pembayaran.</p>
            `;
            detailsContainer.html(bankHtml).removeClass('d-none');
        } else {
            detailsContainer.addClass('d-none');
        }
    });
    // Event listener untuk tombol salin (tetap sama)
    $(document).on('click', '.btn-copy', function() { /* ... implementasi Anda ... */ });


  $('#checkoutForm').on('submit', function(event) {
    event.preventDefault();
    if (!IS_LOGGED_IN) {
        if (loginModal) { loginModal.show(); } else { alert('Anda harus masuk untuk checkout.'); window.location.href = "{{ route('login') }}"; }
        return;
    }

    if (!this.checkValidity()) {
        this.reportValidity();
        $(this).find(':invalid').first().focus();
        return;
    }

    const { waMessage, itemCount } = generateWhatsAppMessageAndSummary();
    if (itemCount === 0) { showToast('warning', 'Keranjang Anda kosong.'); return; }

    const formData = $(this).serializeArray();
    const submitButton = $('#sendOrderBtn');
    const originalButtonText = submitButton.html();
    submitButton.html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...').prop('disabled', true);

    $.ajax({
        url: $(this).attr('action'), type: "POST", data: formData,
        success: function(response) {
            if (response.success) {
                // ===== AWAL PERUBAHAN ALUR NOTIFIKASI DAN REDIRECT WA =====
                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil Dibuat!',
                    text: response.message || 'Pesanan Anda telah disimpan dan akan diarahkan ke WhatsApp.', // Teks bisa disesuaikan
                    showConfirmButton: false, // Tidak perlu tombol konfirmasi
                    timer: 3000, // Notifikasi tampil selama 2 detik (2000 ms)
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading(); // Tampilkan ikon loading selama timer
                    },
                    willClose: () => {
                        // Setelah timer selesai (2 detik), buka WhatsApp
                        const urlWhatsApp = `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`;
                        window.open(urlWhatsApp, '_blank');

                        // Setelah WhatsApp dibuka, redirect ke halaman home atau halaman lain
                        // Ini akan berjalan setelah pengguna mungkin kembali ke tab aplikasi Anda
                        // atau jika tab WhatsApp tidak langsung fokus.
                        // Jeda kecil sebelum redirect ke home agar pengguna sempat melihat tab WA terbuka
                        setTimeout(() => {
                            window.location.href = "{{ route('home') }}";
                        }, 500); // Jeda 0.5 detik sebelum redirect ke home
                    }
                });
                // ===== AKHIR PERUBAHAN ALUR NOTIFIKASI DAN REDIRECT WA =====
            } else {
                Swal.fire('Gagal Membuat Pesanan', response.message || 'Terjadi kesalahan.', 'error');
                submitButton.html(originalButtonText).prop('disabled', false);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // ... (kode error handling Anda tetap sama) ...
            let errorMsg = 'Terjadi kesalahan koneksi atau server.';
            if(jqXHR.responseJSON) {
                if (jqXHR.responseJSON.message) {
                    errorMsg = jqXHR.responseJSON.message;
                }
                if (jqXHR.status == 422 && jqXHR.responseJSON.errors) {
                    let errorsHtml = '<ul class="text-start" style="list-style-position: inside; padding-left: 0;">';
                    $.each(jqXHR.responseJSON.errors, function(key, value){
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    errorsHtml += '</ul>';
                    Swal.fire({
                        title: 'Gagal Membuat Pesanan!',
                        html: '<p class="mb-2 text-center">Terdapat data yang tidak valid:</p>' + errorsHtml,
                        icon: 'error',
                        customClass: {
                            htmlContainer: 'text-start'
                        }
                    });
                    submitButton.html(originalButtonText).prop('disabled', false);
                    return;
                }
            }
            Swal.fire('Error!', errorMsg, 'error');
            submitButton.html(originalButtonText).prop('disabled', false);
        }
    });
});

    function showToast(icon, title) {
        const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 2500,timerProgressBar: true,didOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer);toast.addEventListener('mouseleave', Swal.resumeTimer)}});
        Toast.fire({icon: icon,title: title});
    }

    generateWhatsAppMessageAndSummary(); // Panggil untuk inisialisasi
});
</script>
@endpush