<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Agatha Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset('images/ag.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Overlay background */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .login-card {
            position: relative;
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            z-index: 1;
            text-align: center;
        }

        .login-card h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .logo-img {
            width: 100px;
            margin: 10px auto 30px;
        }

        .form-control {
            border-radius: 12px;
        }

        .btn-login {
            background-color: #f67280;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #c06c84;
        }

        .form-text {
            margin-top: 20px;
            font-size: 14px;
            
            .toast {
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Masuk Agatha Space</h2>
    <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Agatha Space Logo" class="logo-img">

    <!-- Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    @if(session('error'))
        <div id="loginToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>



    <form method="POST" action="{{ route('authenticate') }}">
        @csrf
        <div class="mb-3 text-start">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com" required>
        </div>

        <div class="mb-3 text-start">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password Anda" required>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-login">Masuk</button>
        </div>
    </form>

    <p class="form-text">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('loginToast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 4000
            });
            toast.show();
        }
    });
</script>

</body>
</html>
