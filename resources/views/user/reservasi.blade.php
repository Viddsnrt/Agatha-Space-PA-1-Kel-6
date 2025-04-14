@extends('user.layouts.app')


@section('content')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins&display=swap" rel="stylesheet">

<!-- Custom Coffee Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f5f2;
    }

    h1, .card-title {
        font-family: 'Playfair Display', serif;
        color: #5e3c2c;
    }

    .card {
        border: none;
        background-color: #fffdf9;
    }

    .card img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .btn-coffee {
        background-color: #8b5e3c;
        color: white;
        border: none;
    }

    .btn-coffee:hover {
        background-color: #6e4426;
    }

    .btn-primary {
        background-color: #5e3c2c;
        border: none;
    }

    .btn-primary:hover {
        background-color: #472d21;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-3">Reservasi Meja</h1>
    <p class="text-center text-muted">Silakan pilih meja yang tersedia dan isi formulir berikut untuk melakukan reservasi.</p>
    
    <div class="row">
        @foreach ($meja as $m)
        <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow-lg h-100 d-flex flex-column w-100">
                <img src="{{ asset('storage/' . $m->gambar) }}" class="card-img-top" alt="Meja {{ $m->nama }}">
                <div class="card-body d-flex flex-column flex-grow-1">
                    <h5 class="card-title">{{ $m->nama }}</h5>
                    <p class="card-text">Kapasitas: {{ $m->kapasitas }} orang</p>
                    <p class="card-text mb-3">Harga: Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
                    <button class="btn btn-coffee mt-auto w-100" data-bs-toggle="modal" data-bs-target="#modalReservasi{{ $m->id }}">
                        Reservasi
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <div class="modal fade" id="modalReservasi{{ $m->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $m->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $m->id }}">Reservasi Meja {{ $m->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="kirimWhatsApp(event, {{ $m->id }})">
                            <input type="hidden" id="nama_meja_{{ $m->id }}" value="{{ $m->nama }}">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" id="nama_{{ $m->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_{{ $m->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Jam</label>
                                <input type="time" class="form-control" id="waktu_{{ $m->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi (jam)</label>
                                <input type="number" class="form-control" id="durasi_{{ $m->id }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan_{{ $m->id }}" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim ke WhatsApp</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('scripts')
<script>
    function kirimWhatsApp(event, mejaId) {
        event.preventDefault();

        const nama = document.getElementById(`nama_${mejaId}`).value;
        const tanggal = document.getElementById(`tanggal_${mejaId}`).value;
        const waktu = document.getElementById(`waktu_${mejaId}`).value;
        const durasi = document.getElementById(`durasi_${mejaId}`).value;
        const catatan = document.getElementById(`catatan_${mejaId}`).value;
        const namaMeja = document.getElementById(`nama_meja_${mejaId}`).value;

        const nomorWa = "6281234567890"; // Ganti dengan nomor WhatsApp pemilik cafe
        const pesan = `Halo, saya ingin reservasi meja:
- Nama: ${nama}
- Meja: ${namaMeja}
- Tanggal: ${tanggal}
- Jam: ${waktu}
- Durasi: ${durasi} jam
- Catatan: ${catatan ? catatan : '-'}

Terima kasih!`;

        const url = `https://wa.me/${nomorWa}?text=${encodeURIComponent(pesan)}`;
        window.open(url, '_blank');
    }
</script>
@endpush
