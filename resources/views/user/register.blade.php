<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun | Agatha Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Google Fonts: Poppins & Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

       <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset('images/ag.jpg') }}') no-repeat center center fixed; /* Sesuaikan path gambar Anda */
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: #333; /* Warna teks default, bisa dipertimbangkan #1A4F3F jika kontrasnya baik */
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Overlay bisa sedikit lebih gelap untuk kontras */
            z-index: 0;
        }

        .auth-card {
            position: relative;
            background-color: rgba(249, 246, 239, 0.97); /* Off-white (#F9F6EF) dengan sedikit transparansi */
            backdrop-filter: blur(8px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 480px;
            z-index: 1;
            text-align: center;
        }

        .auth-card .auth-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1A4F3F; /* Dark Green untuk judul */
        }

        .logo-img {
            width: 90px;
            height: auto;
            margin: 0 auto 25px;
            border-radius: 10px;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #d1ccc0; /* Border sedikit lebih gelap dari off-white */
            background-color: #FFFFFF; /* Latar input putih agar mudah dibaca */
            color: #1A4F3F; /* Teks input Dark Green */
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-control::placeholder { /* Warna placeholder */
            color: #5b7e72; /* Versi lebih terang dari dark green */
        }
        .form-control:focus {
            border-color: #1A4F3F; /* Dark Green untuk border fokus */
            box-shadow: 0 0 0 0.25rem rgba(26, 79, 63, 0.25); /* Shadow Dark Green */
        }

        .btn-auth {
            background-color: #1A4F3F; /* Dark Green untuk tombol utama */
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            color: #F9F6EF; /* Teks Off-white di tombol */
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-auth:hover {
            background-color: #133d30; /* Dark Green lebih gelap untuk hover */
            color: #F9F6EF;
            transform: translateY(-2px);
        }
         .btn-auth:focus {
            box-shadow: 0 0 0 0.25rem rgba(26, 79, 63, 0.5); /* Shadow Dark Green */
        }

        .form-text-footer {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #1A4F3F; /* Teks footer Dark Green */
        }
        .form-text-footer a {
            color: #ED5D2B; /* Orange untuk link di footer */
            font-weight: 600; /* Lebih tebal agar menonjol */
            text-decoration: none;
        }
        .form-text-footer a:hover {
            text-decoration: underline;
            color: #c7481f; /* Orange lebih gelap untuk hover link */
        }

        .input-group-text {
            background-color: #e9e4d9; /* Latar ikon sedikit lebih gelap dari off-white card */
            border: 1px solid #d1ccc0;
        }
        .input-group-text i {
             color: #1A4F3F; /* Ikon Dark Green */
        }


        .invalid-feedback {
            display: block;
            font-size: 0.875em;
            color: #dc3545; /* Tetap merah untuk error */
        }
         .is-invalid {
            border-color: #dc3545 !important;
        }
        .is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        /* Toast Styling */
        .toast {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: none;
        }
        /* Toast Sukses */
        .toast.text-bg-success {
            background-color: #1A4F3F !important; /* Dark Green untuk toast sukses */
            color: #F9F6EF !important; /* Teks Off-white */
        }
        /* Toast Error */
        .toast.text-bg-danger {
            background-color: #D32F2F !important; /* Merah yang sedikit berbeda untuk error, atau bisa #ED5D2B jika ingin oranye */
            color: #F9F6EF !important; /* Teks Off-white */
        }
        .toast-header { /* Tidak dipakai jika pakai text-bg-* */
            /* background-color: rgba(0,0,0,0.03); */
            /* border-bottom: 1px solid rgba(0,0,0,0.05); */
        }
        .btn-close-toast { /* Tombol close di toast */
             filter: invert(1) grayscale(100%) brightness(200%); /* Pastikan terlihat di background gelap */
        }
        .toast-body i { /* Ikon di dalam toast body */
            vertical-align: middle;
        }

    </style>
</head>
<body>

<div class="auth-card">
    <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Agatha Space Logo" class="logo-img">
    <h2 class="auth-title">Buat Akun Baru</h2>
    <p class="text-muted mb-4">Daftar untuk menikmati layanan Agatha Space.</p>

    {{-- Menampilkan semua error validasi di atas form --}}
    {{-- @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Oops! Ada kesalahan:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}


    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3 text-start">
            <label for="name" class="form-label fw-medium">Nama Lengkap</label>
             <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus>
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 text-start">
            <label for="email" class="form-label fw-medium">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email@anda.com" value="{{ old('email') }}" required>
            </div>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 text-start">
            <label for="password" class="form-label fw-medium">Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Minimal 8 karakter" required>
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4 text-start"> 
            <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Kata Sandi</label>
            <div class="input-group">
                 <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Ulangi kata sandi" required>
            </div>
            {{-- Error untuk password_confirmation biasanya muncul di 'password' jika aturannya 'confirmed' --}}
        </div>


        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-auth btn-lg">
                <i class="fas fa-user-plus me-2"></i>Daftar Akun
            </button>
        </div>
    </form>

    <p class="form-text-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk Sekarang</a></p>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
    {{-- Toast untuk Sukses Registrasi --}}
    @if(session('success'))
        <div id="serverToastSuccess" class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto btn-close-toast" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- Toast untuk Error Validasi Umum (jika tidak ditampilkan inline) --}}
    {{-- Jika Anda menggunakan @error('field') inline, ini mungkin tidak perlu --}}
    @if ($errors->any() && !session('success')) {{-- Hanya tampilkan jika bukan karena sukses --}}
        <div id="serverToastError" class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-times-circle me-2"></i> Harap periksa kembali data yang Anda masukkan.
                    {{-- Opsional: tampilkan daftar error
                    <ul class="mb-0 mt-1 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    --}}
                </div>
                <button type="button" class="btn-close me-2 m-auto btn-close-toast" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>


<!-- Bootstrap 5.3 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Toast jika ada dari server
        const serverToastSuccessEl = document.getElementById('serverToastSuccess');
        if (serverToastSuccessEl) {
            const serverToastSuccess = new bootstrap.Toast(serverToastSuccessEl, { delay: 5000 });
            serverToastSuccess.show();
        }

        const serverToastErrorEl = document.getElementById('serverToastError');
        if (serverToastErrorEl) {
            const serverToastError = new bootstrap.Toast(serverToastErrorEl, { delay: 6000 }); // Tampil lebih lama untuk error
            serverToastError.show();
        }
    });
</script>

</body>
</html>