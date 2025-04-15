<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('admin.partials.navbar') {{-- Kalau ada navbar --}}
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
