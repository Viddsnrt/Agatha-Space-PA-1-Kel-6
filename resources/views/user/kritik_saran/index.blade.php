@extends('user.layouts.app')

@section('title', 'Kritik & Saran - Agatha Space') {{-- Tambahkan title --}}

@section('content')

<!-- Google Fonts (jika belum ada di app.blade.php dan ingin konsisten) -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<style>
    body {
        background-color: #f9f9f9; /* Latar belakang body yang lembut */
    }

    .kritik-saran-page h2,
    .kritik-saran-page h3,
    .kritik-saran-page .form-label,
    .kritik-saran-page .card-title {
        font-family: 'Playfair Display', serif;
        color: #333;
    }

    .kritik-saran-page p,
    .kritik-saran-page .form-control,
    .kritik-saran-page .form-select,
    .kritik-saran-page .btn,
    .kritik-saran-page .alert {
        font-family: 'Poppins', sans-serif;
    }

    .form-section {
        background-color: #ffffff; /* Putih bersih untuk form */
        padding: 50px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .form-wrapper {
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #eee;
    }

    .form-wrapper h2 {
        color: #4a2f27; /* Warna coklat dari tema agatha */
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #a8745f; /* Warna aksen agatha */
        box-shadow: 0 0 0 0.2rem rgba(168, 116, 95, 0.25);
    }

    .btn-submit-kritik {
        background-color: #6c4f3d; /* Warna coklat tua agatha */
        border-color: #6c4f3d;
        color: white;
        padding: 12px 20px;
        font-size: 1.1rem;
        font-weight: 500;
        border-radius: 8px;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }
    .btn-submit-kritik:hover {
        background-color: #4a2f27; /* Lebih gelap saat hover */
        border-color: #4a2f27;
        color: white;
    }
    .btn-submit-kritik i {
        margin-right: 8px;
    }

    .list-section {
        padding: 50px 0;
        background-color: #f8f5f2; /* Warna latar yang sedikit berbeda */
    }
    .list-section h3 {
        color: #4a2f27;
        margin-bottom: 30px;
    }

    .feedback-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        height: 100%; /* Agar kartu sejajar */
        border: 1px solid #eaeaea;
    }
    .feedback-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
    .feedback-card .card-body {
        padding: 25px;
    }
    .feedback-card .card-title {
        color: #6c4f3d; /* Warna aksen */
        font-size: 1.3rem;
    }
    .feedback-card .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.8em;
    }
    .feedback-card .badge.bg-kritik {
        background-color: #dc3545; /* Merah untuk kritik */
    }
    .feedback-card .badge.bg-saran {
        background-color: #198754; /* Hijau untuk saran */
    }
    .feedback-card p.pesan-text {
        color: #454545;
        line-height: 1.7;
        margin-top: 15px;
    }
    .feedback-card img {
        max-height: 250px;
        object-fit: cover;
        border-radius: 6px;
        margin-top: 15px;
    }

    .alert-custom-success {
        background-color: #e6f7ec;
        color: #237840;
        border: 1px solid #b7e4c7;
        border-radius: 8px;
        font-weight: 500;
    }

    .form-select-placeholder option:first-child {
        color: #6c757d; /* Warna placeholder abu-abu */
    }

</style>

<div class="kritik-saran-page">

    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="form-wrapper">
                        <h2 class="fw-bold mb-4 text-center">Beri Kami Masukan</h2>
                        <p class="text-center text-muted mb-4">Kritik dan saran Anda sangat berarti untuk kemajuan Agatha Space.</p>

                        @if (session('success'))
                            <div class="alert alert-custom-success text-center" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('kritik-saran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required placeholder="Masukkan nama Anda">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="cth: nama@email.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="tel" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required placeholder="cth: 08123456789">
                                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis Masukan</label>
                                <select name="jenis" id="jenis" class="form-select form-select-placeholder @error('jenis') is-invalid @enderror" required>
                                    <option value="" selected disabled>Pilih jenis masukan Anda</option>
                                    <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                                    <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
                                </select>
                                @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan Anda</label>
                                <textarea name="pesan" id="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror" required placeholder="Tuliskan kritik atau saran Anda di sini...">{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="gambar" class="form-label">Unggah Gambar (Opsional)</label>
                                <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
                                <small class="form-text text-muted">Max. 2MB. Format: JPG, PNG, JPEG.</small>
                                @error('gambar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-submit-kritik"><i class="fas fa-paper-plane"></i> Kirim Masukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="list-section">
        <div class="container">
            <h3 class="text-center fw-bold">Apa Kata Mereka?</h3>
            <div class="row gy-4"> {{-- gy-4 untuk vertical gutter --}}
                @forelse ($kritikSaran->where('tampilkan', true) as $item) {{-- Hanya tampilkan yang 'tampilkan' == true --}}
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch"> {{-- d-flex dan align-items-stretch untuk kartu sama tinggi --}}
                        <div class="card feedback-card w-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                                    <span class="badge bg-{{ $item->jenis == 'kritik' ? 'kritik' : 'saran' }}">
                                        {{ ucfirst($item->jenis) }}
                                    </span>
                                </div>
                                <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                <p class="pesan-text">{{ Str::limit($item->pesan, 200) }}</p> {{-- Batasi panjang pesan jika terlalu panjang --}}

                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         class="img-fluid"
                                         alt="Gambar dari {{ $item->nama }}">
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center py-5">Belum ada kritik atau saran yang dapat ditampilkan saat ini.</p>
                    </div>
                @endforelse
            </div>
            {{-- Tambahkan pagination jika Anda menggunakan paginate di controller --}}
            {{-- <div class="mt-4 d-flex justify-content-center">
                {{ $kritikSaran->links() }}
            </div> --}}
        </div>
    </section>

</div>
<script>
    // Untuk select placeholder agar terlihat seperti placeholder
    const selectJenis = document.getElementById('jenis');
    if (selectJenis) {
        const setPlaceholderStyle = () => {
            if (selectJenis.value === "") {
                selectJenis.classList.add('form-select-placeholder');
            } else {
                selectJenis.classList.remove('form-select-placeholder');
            }
        };
        setPlaceholderStyle(); // Panggil saat load
        selectJenis.addEventListener('change', setPlaceholderStyle); // Panggil saat ganti
    }
</script>
@endsection