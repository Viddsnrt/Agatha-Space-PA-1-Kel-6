<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan (404) - Agatha Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F9F6EF; /* Off-white dari palet Anda */
            color: #1A4F3F; /* Dark Green untuk teks */
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
            max-width: 300px; /* Sesuaikan ukuran ilustrasi */
            margin-bottom: 2rem;
        }
        .error-code {
            font-family: 'Playfair Display', serif;
            font-size: 6rem; /* Ukuran besar untuk kode error */
            font-weight: 700;
            color: #ED5D2B; /* Orange dari palet Anda */
            line-height: 1;
        }
        .error-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
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
            border-radius: 50px; /* Rounded pill */
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-home:hover {
            background-color: #133d30; /* Dark Green lebih gelap */
            color: #F9F6EF;
            transform: translateY(-2px);
        }
        .logo-footer {
            width: 50px; /* Ukuran logo kecil di footer */
            margin-top: 3rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="error-container">
        {{-- Ganti dengan path ke ilustrasi 404 Anda --}}
        {{-- Anda bisa download ilustrasi dari unDraw.co atau Freepik (pastikan lisensinya sesuai) --}}
        <img src="{{ asset('images/error404.jpg') }}" alt="Halaman Tidak Ditemukan" class="error-illustration">

        <div class="error-code">404</div>
        <h1 class="error-title">Oops! Halaman Hilang</h1>
        <p class="error-message">
            Sepertinya halaman yang Anda cari tidak dapat ditemukan. Mungkin URL salah ketik atau halaman tersebut sudah tidak ada lagi.
        </p>
        <a href="{{ url('/') }}" class="btn btn-home">
            <i class="fas fa-home me-2"></i>Kembali ke Beranda
        </a>

        
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>