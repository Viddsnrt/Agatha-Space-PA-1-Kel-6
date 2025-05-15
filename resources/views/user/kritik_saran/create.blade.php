{{-- resources/views/user/kritik_saran/create.blade.php --}}
@extends('user.layouts.app')

@section('title', 'Beri Kritik & Saran - Agatha Space')

@push('styles')
{{-- Font Awesome jika belum ada global di app.blade.php dan dibutuhkan untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* Style yang sudah Anda berikan sebelumnya */
    body { background-color: #f8f5f2; }
    .kritik-saran-form-page h2, .kritik-saran-form-page .form-label { font-family: 'Playfair Display', serif; color: #4a2f27; }
    .kritik-saran-form-page p, .kritik-saran-form-page .form-control, .kritik-saran-form-page .form-select, .kritik-saran-form-page .btn, .kritik-saran-form-page .alert { font-family: 'Poppins', sans-serif; }
    .form-section { background-color: #ffffff; padding: 60px 0; }
    .form-wrapper { background-color: #fff; padding: 35px 45px; border-radius: 12px; box-shadow: 0 12px 35px rgba(0, 0, 0, 0.07); border: 1px solid #eee; }
    .form-wrapper .page-title { font-size: 2.5rem; color: #4a2f27; margin-bottom: 15px; }
    .form-wrapper .page-subtitle { font-size: 1.1rem; color: #6c757d; margin-bottom: 30px; }
    .form-label { font-weight: 500; color: #555; margin-bottom: 0.6rem; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid #ced4da; padding: 0.85rem 1.1rem; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; }
    .form-control:focus, .form-select:focus { border-color: #a8745f; box-shadow: 0 0 0 0.25rem rgba(168, 116, 95, 0.2); }
    .form-select.placeholder-style { color: #6c757d; }
    .form-select.placeholder-style option:first-child { display: none; }
    .btn-submit-kritik { background-color: #ED5D2B; border-color: #ED5D2B; color: white; padding: 14px 25px; font-size: 1.15rem; font-weight: 600; border-radius: 50px; transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease; letter-spacing: 0.5px; }
    .btn-submit-kritik:hover { background-color: #d45020; border-color: #d45020; color: white; transform: translateY(-2px); }
    .btn-submit-kritik i { margin-right: 10px; }
    .alert-custom-success { background-color: #e6f7ec; color: #1e6a39; border: 1px solid #b7e4c7; border-radius: 8px; font-weight: 500; padding: 1rem 1.25rem; }
    /* Tambahkan style alert danger jika belum ada untuk error validasi */
     .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
        border-radius: 8px;
    }
    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
</style>
@endpush

@section('content')
<div class="kritik-saran-form-page">
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="form-wrapper">
                        <h2 class="page-title text-center fw-bold">Beri Kami Masukan</h2>
                        <p class="page-subtitle text-center">Pendapat Anda sangat berharga untuk menjadikan Agatha Space lebih baik.</p>

                        {{-- Pesan sukses setelah submit form --}}
                        @if (session('success')) {{-- Menggunakan key 'success' --}}
                            <div class="alert alert-custom-success text-center" role="alert" data-aos="fade-up">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        {{-- Menampilkan error validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" data-aos="fade-up">
                                <h5 class="alert-heading fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Oops! Ada beberapa kesalahan:</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kritik-saran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3" data-aos="fade-up" data-aos-delay="100">
                                <label for="nama" class="form-label"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                                {{-- Mengisi default dari user yang login, jika ada --}}
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', auth()->user()?->name) }}" required placeholder="Masukkan nama Anda">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-delay="150">
                                    <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Alamat Email</label>
                                     {{-- Mengisi default dari user yang login, jika ada --}}
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()?->email) }}" required placeholder="cth: nama@email.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-delay="200">
                                    <label for="no_hp" class="form-label"><i class="fas fa-phone me-2"></i>Nomor HP</label>
                                    <input type="tel" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required placeholder="cth: 08123456789">
                                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3" data-aos="fade-up" data-aos-delay="250">
                                <label for="jenis" class="form-label"><i class="fas fa-list-alt me-2"></i>Jenis Masukan</label>
                                <select name="jenis" id="jenis" class="form-select placeholder-style @error('jenis') is-invalid @enderror" required>
                                    <option value="" selected disabled>Pilih jenis masukan Anda</option>
                                    <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                                    <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
                                </select>
                                @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3" data-aos="fade-up" data-aos-delay="300">
                                <label for="pesan" class="form-label"><i class="fas fa-comment-dots me-2"></i>Pesan Anda</label>
                                <textarea name="pesan" id="pesan" rows="5" class="form-control @error('pesan') is-invalid @enderror" required placeholder="Tuliskan kritik atau saran Anda di sini...">{{ old('pesan') }}</textarea>
                                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4" data-aos="fade-up" data-aos-delay="350">
                                <label for="gambar" class="form-label"><i class="fas fa-image me-2"></i>Unggah Gambar (Opsional)</label>
                                <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/jpeg,image/png,image/gif">
                                <small class="form-text text-muted mt-1">Maks. 5MB. Format yang didukung: JPG, PNG, GIF.</small>
                                @error('gambar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-grid mt-4 pt-2" data-aos="fade-up" data-aos-delay="400">
                                <button type="submit" class="btn btn-submit-kritik"><i class="fas fa-paper-plane"></i> Kirim Masukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk select placeholder agar terlihat seperti placeholder
    const selectJenis = document.getElementById('jenis');
    if (selectJenis) {
        const setPlaceholderStyle = () => {
            // Cek jika nilai kosong atau null
            if (selectJenis.value === "" || selectJenis.value === null) {
                selectJenis.classList.add('placeholder-style');
            } else {
                selectJenis.classList.remove('placeholder-style');
            }
        };
        setPlaceholderStyle(); // Panggil saat load
        selectJenis.addEventListener('change', setPlaceholderStyle); // Panggil saat ganti
    }

    // AOS re-init/refresh jika konten berubah dinamis (optional di form ini)
    // AOS.refresh();
</script>
@endpush