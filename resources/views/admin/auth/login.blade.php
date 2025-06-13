<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk | Agatha Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Google Fonts: Poppins & Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* ... CSS Anda tetap sama, saya singkat untuk keringkasan ... */
        body { font-family: 'Poppins', sans-serif; background: url('{{ asset('images/ag.jpg') }}') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; color: #333; padding-top: 2rem; padding-bottom: 2rem; }
        body::before { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.6); z-index: 0; }
        .auth-card { position: relative; background-color: rgba(249, 246, 239, 0.97); backdrop-filter: blur(8px); padding: 40px 35px; border-radius: 20px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25); width: 100%; max-width: 480px; z-index: 1; text-align: center; }
        .auth-card .auth-title { font-family: 'Playfair Display', serif; font-weight: 700; margin-bottom: 15px; color: #1A4F3F; }
        .logo-img { width: 90px; height: auto; margin: 0 auto 25px; border-radius: 10px; }
        .form-control { border-radius: 10px; padding: 0.75rem 1rem; border: 1px solid #d1ccc0; background-color: #FFFFFF; color: #1A4F3F; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; }
        .form-control::placeholder { color: #5b7e72; }
        .form-control:focus { border-color: #1A4F3F; box-shadow: 0 0 0 0.25rem rgba(26, 79, 63, 0.25); }
        .btn-auth { background-color: #1A4F3F; border: none; border-radius: 10px; padding: 0.75rem 1.25rem; font-weight: 500; color: #F9F6EF; transition: background-color 0.3s ease, transform 0.2s ease; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn-auth:hover { background-color: #133d30; color: #F9F6EF; transform: translateY(-2px); }
        .btn-auth:focus { box-shadow: 0 0 0 0.25rem rgba(26, 79, 63, 0.5); }
        .form-text-footer { margin-top: 25px; font-size: 0.9rem; color: #1A4F3F; }
        .form-text-footer a { color: #ED5D2B; font-weight: 600; text-decoration: none; }
        .form-text-footer a:hover { text-decoration: underline; color: #c7481f; }
        .input-group-text { background-color: #e9e4d9; border: 1px solid #d1ccc0; }
        .input-group-text i { color: #1A4F3F; }
        .invalid-feedback { display: block; font-size: 0.875em; color: #dc3545; }
        .is-invalid { border-color: #dc3545 !important; }
        .is-invalid:focus { box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important; }
        .toast { box-shadow: 0 8px 25px rgba(0,0,0,0.15); border: none; }
        .toast.text-bg-success { background-color: #1A4F3F !important; color: #F9F6EF !important; }
        .toast.text-bg-danger { background-color: #D32F2F !important; color: #F9F6EF !important; }
        .btn-close-toast { filter: invert(1) grayscale(100%) brightness(200%); }
        .toast-body i { vertical-align: middle; }
        .btn-page-close { position: fixed; top: 25px; right: 25px; width: 40px; height: 40px; background-color: rgba(0, 0, 0, 0.6); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 18px; z-index: 1045; border: 2px solid white; transition: opacity 0.2s ease, background-color 0.2s ease, transform 0.2s ease; opacity: 0.8; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        .btn-page-close:hover { opacity: 1; background-color: rgba(0, 0, 0, 0.8); transform: scale(1.1); }
        .btn-page-close i { line-height: 1; }
    </style>
</head>
<body>

<a href="javascript:window.history.back();" class="btn-page-close" aria-label="Kembali ke halaman sebelumnya" title="Kembali">
    <i class="fas fa-times"></i>
</a>

<div class="auth-card">
    <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Agatha Space Logo" class="logo-img">
    <h2 class="auth-title">Selamat Datang !</h2>
    <p class="text-muted mb-4">Masuk untuk melanjutkan ke Agatha Space.</p>

    {{-- Pastikan nama route 'authenticate' mengarah ke AuthController@authenticate di web.php --}}
    <form method="POST" action="{{ route('authenticate') }}">
        @csrf

        {{-- ===== AWAL: HIDDEN INPUTS UNTUK REDIRECT DAN TAMBAH MENU ===== --}}
        {{-- Variabel $redirect_to_param dan $add_menu_after_login_param dikirim dari AuthController@showLogin --}}
        @if(isset($redirect_to_param) && $redirect_to_param)
            <input type="hidden" name="redirect_to_after_login" value="{{ $redirect_to_param }}">
        @endif {{-- Penutup untuk @if redirect_to_param --}}

        @if(isset($add_menu_after_login_param) && $add_menu_after_login_param)
            <input type="hidden" name="menu_id_to_add_after_login" value="{{ $add_menu_after_login_param }}">
        @endif {{-- Penutup untuk @if add_menu_after_login_param --}}
        {{-- ===== AKHIR: HIDDEN INPUTS ===== --}}

        <div class="mb-3 text-start">
            <label for="email" class="form-label fw-medium">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="example@gmail.com" value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror {{-- Penutup untuk @error email --}}
        </div>

        <div class="mb-3 text-start">
            <label for="password" class="form-label fw-medium">Kata Sandi</label>
            <div class="input-group">
                 <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Kata sandi Anda" required>
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror {{-- Penutup untuk @error password --}}
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label small text-muted" for="remember">
                    Ingat Saya
                </label>
            </div>
            {{--
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-muted text-decoration-none">Lupa Password?</a>
            @endif
            --}}
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-auth btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk
            </button>
        </div>
    </form> {{-- Akhir form --}}

    <p class="form-text-footer">Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
</div> {{-- Akhir .auth-card --}}

<!-- Toast Container untuk notifikasi server -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
    @if(session('error'))
        <div id="serverToastError" class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto btn-close-toast" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif {{-- Penutup untuk @if session('error') --}}

     @if(session('success'))
        <div id="serverToastSuccess" class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto btn-close-toast" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif {{-- Penutup untuk @if session('success') --}}
</div> {{-- Akhir .toast-container --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serverToastErrorEl = document.getElementById('serverToastError');
        if (serverToastErrorEl) {
            const serverToastError = new bootstrap.Toast(serverToastErrorEl, { delay: 5000 });
            serverToastError.show();
        }
        const serverToastSuccessEl = document.getElementById('serverToastSuccess');
        if (serverToastSuccessEl) {
            const serverToastSuccess = new bootstrap.Toast(serverToastSuccessEl, { delay: 4000 });
            serverToastSuccess.show();
        }
    });
</script>

</body>
</html>