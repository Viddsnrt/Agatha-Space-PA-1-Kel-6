<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Agatha Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
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

        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body class="relative bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/ag.jpg') }}');">

    <div class="relative z-10 bg-white bg-opacity-90 backdrop-blur p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-gray-800">Daftar ke Agatha Space</h1>
        <div class="flex justify-center mt-3 mb-6">
            <img src="{{ asset('images/LogoAgathaSpace.jpg') }}" alt="Logo Agatha Space" class="w-20">
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" required
                       class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                       class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="mt-1 w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 rounded-lg transition">
                Daftar
            </button>
        </form>

        <p class="mt-5 text-sm text-center text-gray-700">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Masuk di sini</a>
        </p>
    </div>

    {{-- TOAST SUKSES --}}
    @if (session('success'))
        <div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-white bg-green-500 rounded-lg shadow-lg animate-slide-in">
            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- TOAST ERROR --}}
    @if ($errors->any())
        <div id="toast-error" class="fixed top-20 right-5 z-50 flex items-start w-full max-w-xs p-4 text-white bg-red-500 rounded-lg shadow-lg animate-slide-in">
            <svg class="w-5 h-5 mr-2 text-white mt-1" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <div class="text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successToast = document.getElementById('toast-success');
            const errorToast = document.getElementById('toast-error');

            if (successToast) {
                setTimeout(() => {
                    successToast.classList.add('opacity-0', 'transition-opacity');
                    setTimeout(() => successToast.remove(), 600);
                }, 3000);
            }

            if (errorToast) {
                setTimeout(() => {
                    errorToast.classList.add('opacity-0', 'transition-opacity');
                    setTimeout(() => errorToast.remove(), 600);
                }, 4000);
            }
        });
    </script>
</body>
</html>
