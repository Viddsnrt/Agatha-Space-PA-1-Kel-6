<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesalahan Server (500) - Agatha Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F9F6EF; /* Off-white */
            color: #1A4F3F; /* Dark Green */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }
        .error-container {
            max-width: 600px;
        }
        .error-illustration {
            width: 100%;
            max-width: 320px; /* Ukuran ilustrasi */
            margin-bottom: 2rem;
        }
        .error-code {
            font-family: 'Playfair Display', serif;
            font-size: 5rem; /* Sedikit lebih kecil dari 404 */
            font-weight: 700;
            color: #ED5D2B; /* Orange */
            line-height: 1;
        }
        .error-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.3rem;
            font-weight: 700;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.1rem;
            color: #5b7e72; /* Versi lebih terang dari dark green */
            margin-bottom: 2rem;
        }
        .btn-home {
            background-color: #1A4F3F; /* Dark Green */
            border-color: #1A4F3F;
            color: #F9F6EF; /* Off-white */
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-home:hover {
            background-color: #133d30; /* Dark Green lebih gelap */
            color: #F9F6EF;
            transform: translateY(-2px);
        }
         .btn-retry { /* Tombol coba lagi */
            background-color: #ED5D2B; /* Orange */
            border-color: #ED5D2B;
            color: #FFFFFF;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-left: 0.5rem;
        }
        .btn-retry:hover {
            background-color: #c7481f; /* Orange lebih gelap */
            color: #FFFFFF;
            transform: translateY(-2px);
        }
        .logo-footer {
            width: 50px;
            margin-top: 3rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="error-container">
        {{-- Ganti dengan path ke ilustrasi 500 Anda --}}
        <img src="{{ asset('images/servererror500.jpg') }}" alt="Kesalahan Server" class="error-illustration">

        <div class="error-code">500</div>
        <h1 class="error-title">Oops! Ada Gangguan Teknis</h1>
        <p class="error-message">
            Mohon maaf, sepertinya terjadi kesalahan pada server kami. Tim teknis kami sudah diberitahu dan sedang berusaha memperbaikinya.
            Silakan coba lagi dalam beberapa saat.
        </p>
        <div>
            <a href="{{ url('/') }}" class="btn btn-home">
                <i class="fas fa-home me-2"></i>Kembali ke Beranda
            </a>
            <a href="{{ url()->current() }}" class="btn btn-retry"> {{-- Link ke halaman saat ini untuk coba lagi --}}
                <i class="fas fa-sync-alt me-2"></i>Coba Lagi
            </a>
        </div>

        @if(file_exists(public_path('images/LogoAgathaSpace.jpg')))
            <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Agatha Space Logo" class="logo-footer">
        @endif
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>