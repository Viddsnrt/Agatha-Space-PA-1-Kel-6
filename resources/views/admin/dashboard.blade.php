@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard Agatha Space</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <p class="mb-4">Selamat datang di panel admin Agatha Space! Berikut adalah ringkasan data terkini:</p>

        {{-- BARIS 1: Ringkasan Utama --}}
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="Total Pesanan" text="{{ $totalOrders ?? 'N/A' }}" icon="fas fa-shopping-cart text-lightblue"
                    theme="info" url="{{ route('admin.orders.index') }}" url-text="Lihat Detail"/>
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="Total Menu" text="{{ $totalMenus ?? 'N/A' }}" icon="fas fa-utensils text-olive"
                    theme="success" url="{{ route('admin.menus.index') }}" url-text="Kelola Menu"/>
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="Total Pengguna" text="{{ $totalUsers ?? 'N/A' }}" icon="fas fa-users text-orange"
                    theme="warning" url="{{ route('admin.users.index') }}" url-text="Kelola Pengguna"/>
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="Reservasi Hari Ini" text="{{ $totalTableToday ?? 'N/A' }}" icon="fas fa-concierge-bell text-maroon"
                    theme="danger" url="{{ route('admin.table.index') }}" url-text="Lihat Reservasi"/>
            </div>
        </div>

        {{-- BARIS 2: Info Box Detail --}}
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <x-adminlte-info-box title="Kategori Menu" text="{{ $totalCategories ?? 'N/A' }}" icon="fas fa-tags" theme="gradient-indigo"
                    url="{{ route('admin.categories.index') }}" url-text="Lihat Semua"/>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <x-adminlte-info-box title="Item Galeri" text="{{ $totalGallery ?? 'N/A' }}" icon="fas fa-images" theme="gradient-purple"
                    url="{{ route('admin.gallery.index') }}" url-text="Lihat Semua"/>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                {{-- PERUBAHAN DI SINI --}}
                <x-adminlte-info-box title="Testimoni & Saran" text="{{ $totalTestimoni ?? 'N/A' }}" icon="fas fa-comment-dots" theme="gradient-orange"
                    url="{{ route('admin.testimoni.index') }}" url-text="Lihat Semua"/>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <x-adminlte-info-box title="Promo & Event Aktif" text="{{ $totalPromoEvent ?? 'N/A' }}" icon="fas fa-bullhorn" theme="gradient-teal"
                    url="{{ route('admin.promo-event.index') }}" url-text="Lihat Semua"/>
            </div>
        </div>

        {{-- Contoh tambahan: Card untuk grafik atau tabel ringkas --}}
        {{--
        <div class="row mt-4">
            <div class="col-md-6">
                <x-adminlte-card title="Statistik Pengunjung (Contoh)" theme="lightblue" theme-mode="outline"
                    icon="fas fa-chart-line" collapsible removable>
                    <canvas id="visitorsChart"></canvas>
                </x-adminlte-card>
            </div>
            <div class="col-md-6">
                <x-adminlte-card title="Pesanan Terbaru (Contoh)" theme="success" theme-mode="outline"
                    icon="fas fa-receipt" collapsible removable>
                    <p>Tabel atau daftar pesanan terbaru bisa ditampilkan di sini.</p>
                </x-adminlte-card>
            </div>
        </div>
        --}}
    </div>
@endsection

@push('css')
    <style>
        .info-box .info-box-icon {
            font-size: 2.5rem;
        }
        .small-box .icon > i {
            font-size: 60px;
            top: 10px;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            console.log('Dashboard admin siap!');
        });
    </script>
@endpush