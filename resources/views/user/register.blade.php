<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Agatha Space</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-100 to-orange-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Daftar ke Agatha Space</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Nama Lengkap</label>
                <input type="text" id="name" name="name" required
                       class="mt-1 w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" required
                       class="mt-1 w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Kata Sandi</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="mt-1 w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <button type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 rounded transition">
                Daftar
            </button>
        </form>

        <p class="mt-4 text-sm text-center">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>
</html>
