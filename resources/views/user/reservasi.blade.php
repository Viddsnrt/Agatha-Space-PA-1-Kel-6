@extends('user.layouts.app')

@section('title', 'Reservasi Meja - Agatha Space')

@section('content')
<div class="reservasi-page py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h1 class="page-title playfair-font"><i class="fas fa-calendar-alt text-primary-agatha me-2"></i>Reservasi Meja Anda</h1>
            <p class="lead text-muted">Pilih meja favorit Anda dan amankan tempat untuk momen spesial di Agatha Space.</p>
        </div>

        {{-- Pesan sukses dari session (jika ada redirect server) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center shadow-sm" role="alert" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Placeholder untuk Pesan Sukses JavaScript --}}
        <div id="reservation-success-message" class="alert alert-success alert-dismissible fade show text-center shadow-sm d-none" role="alert" data-aos="fade-up" data-aos-delay="100">
            <i class="fas fa-check-circle me-2"></i> Permintaan reservasi Anda telah berhasil dibuka di WhatsApp. Mohon lanjutkan pengiriman pesan di sana. Form telah dikosongkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        {{-- (Rest of your HTML for table listing remains the same) --}}
        <div class="row gy-4">
            @forelse($tables as $item)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card table-card w-100">
                        @if($item->gambar && Storage::disk('public')->exists($item->gambar))
                            <div class="table-card-img-container">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="table-card-img" alt="Meja {{ $item->meja }}">
                            </div>
                        @else
                             <div class="table-card-img-container placeholder-img">
                                <i class="fas fa-chair fa-3x"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title table-card-title playfair-font">Meja {{ $item->meja }}</h5>
                            @if($item->deskripsi)
                            <p class="card-text table-card-description flex-grow-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                            @else
                            <p class="card-text table-card-description flex-grow-1">Meja nyaman untuk menikmati suasana.</p>
                            @endif
                            <button class="btn btn-reservasi-pilih mt-auto w-100" onclick="pilihDanScrollKeForm('{{ $item->meja }}', '{{ $item->id }}')">
                                <i class="fas fa-calendar-check me-2"></i>Reservasi Meja Ini
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center py-5 lead">Mohon maaf, saat ini belum ada data meja yang tersedia untuk reservasi.</p>
                </div>
            @endforelse
        </div>


        {{-- Form Reservasi --}}
        <div class="collapse mt-5 pt-4" id="formReservasiWrapper">
            <div class="reservasi-form-card" data-aos="fade-up">
                <div class="text-center">
                    <h3 class="playfair-font mb-1">Formulir Reservasi</h3>
                    <p class="text-muted mb-4">Untuk Meja <strong id="mejaTerpilihText" class="text-primary-agatha"></strong></p>
                </div>

                {{-- Form tetap client-side, action bisa dihapus jika tidak ada submit ke server --}}
                <form id="actualReservasiForm">
                    @csrf {{-- CSRF token tidak terlalu diperlukan jika hanya ke WA, tapi tidak masalah tetap ada --}}
                    <input type="hidden" name="table_id" id="mejaIdTerpilih">
                    <input type="hidden" name="nama_meja" id="namaMejaTerpilih">

                    {{-- (Rest of your form inputs remain the same) --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control" required placeholder="Nama lengkap Anda">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label">Nomor WhatsApp</label>
                            <input type="tel" name="no_hp" id="no_hp" class="form-control" required placeholder="cth: 081234567890">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal Reservasi</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="jam" class="form-label">Jam Kedatangan</label>
                            <input type="time" name="jam" id="jam" class="form-control" required>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                            <input type="number" name="jumlah_orang" id="jumlah_orang" class="form-control" required min="1" max="10" placeholder="Jumlah tamu (Maks. 10)">
                </div>
                        <div class="col-md-6 mb-3">
                            <label for="durasi" class="form-label">Durasi</label>
                            <input type="text" name="durasi" id="durasi" class="form-control" placeholder="cth: 2 jam">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Permintaan khusus, acara, dll."></textarea>
                    </div>

                    <div class="d-grid">
                        {{-- Tipe button agar tidak memicu submit default, event dihandle JS --}}
                        <button type="submit" class="btn btn-success btn-lg btn-reservasi-kirim">
                            <i class="fab fa-whatsapp me-2"></i>Kirim Permintaan Reservasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
{{-- Gaya CSS Anda tetap sama --}}
<style>
    /* ... CSS Anda di sini ... */
    .playfair-font {
        font-family: 'Playfair Display', serif; /* Pastikan font ini di-load */
    }
    .text-primary-agatha {
        color: #a8745f !important; /* Warna primer tema Agatha Space */
    }

    .reservasi-page .page-title {
        color: #4a2f27; /* Warna judul utama */
        font-weight: 700;
    }

    .table-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    .table-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .table-card-img-container {
        height: 220px; /* Tinggi gambar konsisten */
        overflow: hidden;
        background-color: #f0f0f0; /* Latar placeholder */
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .table-card-img-container.placeholder-img i {
        color: #bbb;
    }
    .table-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Gambar akan crop & cover area */
        transition: transform 0.4s ease;
    }
    .table-card:hover .table-card-img {
        transform: scale(1.05);
    }

    .table-card .card-body {
        padding: 1.25rem;
        text-align: center;
    }
    .table-card-title {
        color: #333;
        font-weight: 600;
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
    }
    .table-card-description {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
        min-height: 40px; /* Agar space tetap ada jika deskripsi kosong */
    }

    .btn-reservasi-pilih {
        background-color: #a8745f; /* Warna primer Agatha */
        color: white;
        border: none;
        padding: 0.7rem 1rem;
        font-weight: 500;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    .btn-reservasi-pilih:hover {
        background-color: #8c624d; /* Warna primer lebih gelap */
        color: white;
    }
    .btn-reservasi-pilih i {
        transition: transform 0.3s ease;
    }
    .btn-reservasi-pilih:hover i {
        transform: rotate(10deg);
    }

    /* Form Reservasi */
    .reservasi-form-card {
        background-color: #fff;
        padding: 2.5rem; /* Padding lebih besar */
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
    }
    .reservasi-form-card .form-label {
        font-weight: 500;
        color: #555;
    }
    .reservasi-form-card .form-control {
        border-radius: 8px;
        padding: 0.8rem 1rem;
        border: 1px solid #ced4da;
    }
    .reservasi-form-card .form-control:focus {
        border-color: #a8745f;
        box-shadow: 0 0 0 0.2rem rgba(168, 116, 95, 0.25);
    }
    .btn-reservasi-kirim {
        background-color: #28a745; /* Warna hijau untuk WhatsApp/kirim */
        border-color: #28a745;
        font-weight: 500;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
    }
    .btn-reservasi-kirim:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* AOS animation delay for cards */
    [data-aos] {
        /* overflow: hidden; Uncomment if needed to prevent scrollbars during animation */
    }
</style>
@endpush

@push('scripts')
{{-- Pastikan SweetAlert2 sudah di-include di layout utama atau di sini --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Inisialisasi AOS jika belum
    // AOS.init({ duration: 800, once: true, offset: 50 });

    let formCollapseInstance = null;
    const formWrapper = document.getElementById('formReservasiWrapper');
    const reservasiForm = document.getElementById('actualReservasiForm');
    const successMessageDiv = document.getElementById('reservation-success-message');
    const SESSION_STORAGE_KEY = 'reservationSent';

    function getOrInitCollapseInstance() {
        if (!formCollapseInstance && formWrapper) {
            formCollapseInstance = new bootstrap.Collapse(formWrapper, { toggle: false });
        }
        return formCollapseInstance;
    }

    function handleReturnFromWhatsApp() {
        console.log("Handling return from WhatsApp check...");
        if (reservasiForm) {
            reservasiForm.reset();
        }

        const collapse = getOrInitCollapseInstance();
        if (collapse) {
            collapse.hide();
        }

        if (successMessageDiv) {
            successMessageDiv.classList.remove('d-none');
            successMessageDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        sessionStorage.removeItem(SESSION_STORAGE_KEY);
        console.log("Flag removed, processing complete.");
    }

    function pilihDanScrollKeForm(namaMeja, idMeja) {
        if (!formWrapper || !reservasiForm) return;

        if (successMessageDiv && !successMessageDiv.classList.contains('d-none')) {
             successMessageDiv.classList.add('d-none');
        }

        document.getElementById('mejaIdTerpilih').value = idMeja;
        document.getElementById('namaMejaTerpilih').value = namaMeja;
        document.getElementById('mejaTerpilihText').innerText = namaMeja;

        const collapse = getOrInitCollapseInstance();
        if (collapse) {
            collapse.show();
        }

        document.getElementById('nama_pemesan').value = '';
        document.getElementById('no_hp').value = '';
        document.getElementById('tanggal').value = '';
        // Set default jam kedatangan ke jam saat ini atau biarkan kosong
        // document.getElementById('jam').value = new Date().toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('jam').value = '';
        document.getElementById('jumlah_orang').value = '';
        document.getElementById('durasi').value = '';
        document.getElementById('catatan').value = '';

        document.getElementById('mejaIdTerpilih').value = idMeja;
        document.getElementById('namaMejaTerpilih').value = namaMeja;

        setTimeout(() => {
            formWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
            const firstInput = formWrapper.querySelector('input[name="nama_pemesan"]');
            if (firstInput) {
                firstInput.focus();
            }
        }, 350);
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (formWrapper && formWrapper.classList.contains('show')) {
             getOrInitCollapseInstance();
        }

        if (reservasiForm) {
            reservasiForm.addEventListener('submit', function (event) {
                event.preventDefault();

                if (!reservasiForm.checkValidity()) {
                    reservasiForm.reportValidity();
                    // Fokus ke field pertama yang invalid
                    const firstInvalidField = reservasiForm.querySelector(':invalid');
                    if (firstInvalidField) {
                        firstInvalidField.focus();
                    }
                    return;
                }

                const namaMeja = document.getElementById('namaMejaTerpilih').value;
                const namaPemesan = document.getElementById('nama_pemesan').value;
                const noHp = document.getElementById('no_hp').value;
                const tanggalInput = document.getElementById('tanggal').value;
                const jam = document.getElementById('jam').value;
                const jumlahOrang = document.getElementById('jumlah_orang').value;
                const durasi = document.getElementById('durasi').value || "-";
                const catatan = document.getElementById('catatan').value || "-";

                let tanggalFormatted = '';
                if (tanggalInput) {
                    try {
                        const date = new Date(tanggalInput);
                        const options = { day: 'numeric', month: 'long', year: 'numeric' };
                        tanggalFormatted = date.toLocaleDateString('id-ID', options);
                    } catch (e) {
                        tanggalFormatted = tanggalInput;
                    }
                }

                const nomorWaTujuan = '6282277124955';
                let pesan = `Halo Agatha Space, saya ingin melakukan reservasi meja:\n\n`;
                pesan += `*Meja:* ${namaMeja}\n`;
                pesan += `*Nama Pemesan:* ${namaPemesan}\n`;
                pesan += `*Nomor WhatsApp:* ${noHp}\n`;
                pesan += `*Tanggal:* ${tanggalFormatted}\n`;
                pesan += `*Jam Kedatangan:* ${jam}\n`;
                pesan += `*Jumlah Orang:* ${jumlahOrang} orang\n`;
                pesan += `*Durasi:* ${durasi}\n`;
                pesan += `*Catatan:* ${catatan}\n\n`;
                pesan += `Mohon konfirmasinya. Terima kasih.`;

                const encodedPesan = encodeURIComponent(pesan);
                const urlWhatsApp = `https://wa.me/${nomorWaTujuan}?text=${encodedPesan}`;

                // ===== AWAL PERUBAHAN ALUR NOTIFIKASI DAN REDIRECT WA =====
                Swal.fire({
                    icon: 'info', // Ganti ikon menjadi info atau success sesuai preferensi
                    title: 'Mengarahkan ke WhatsApp',
                    text: 'Permintaan reservasi Anda akan segera dibuka di WhatsApp. Mohon lanjutkan pengiriman pesan di sana.',
                    showConfirmButton: false,
                    timer: 3000, // Notifikasi tampil selama 2 detik
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading(); // Tampilkan ikon loading selama timer
                    },
                    willClose: () => {
                        // Setelah timer selesai (2 detik), buka WhatsApp
                        sessionStorage.setItem(SESSION_STORAGE_KEY, 'true');
                        console.log("Flag set in sessionStorage before opening WhatsApp");

                        window.open(urlWhatsApp, '_blank');
                        console.log("WhatsApp tab opened (or attempted)");
                        // Tidak ada reset form atau hide collapse di sini, akan ditangani oleh visibilitychange
                    }
                });
                // ===== AKHIR PERUBAHAN ALUR NOTIFIKASI DAN REDIRECT WA =====
            });
        }

        document.addEventListener('visibilitychange', () => {
            console.log(`Visibility changed to: ${document.visibilityState}`);
            if (document.visibilityState === 'visible' && sessionStorage.getItem(SESSION_STORAGE_KEY) === 'true') {
                 console.log("Conditions met: Tab visible and flag exists. Running handler...");
                setTimeout(handleReturnFromWhatsApp, 100);
            }
        });

        // Inisialisasi AOS jika Anda menggunakannya
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600, // Durasi animasi default
                once: true,    // Animasi hanya berjalan sekali
                offset: 50,    // Offset dari bottom viewport sebelum animasi dimulai
            });
        }

    }); // Akhir DOMContentLoaded
</script>
@endpush