@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Admin Agatha Space</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-adminlte-info-box title="Menu" text="{{ $totalMenus }}" icon="fas fa-coffee" theme="teal" url="{{ route('admin.menus.index') }}" url-text="Lihat Semua"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box title="Kategori" text="{{ $totalCategories }}" icon="fas fa-tags" theme="indigo" url="{{ route('admin.categories.index') }}" url-text="Lihat Semua"/>
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box title="Galeri" text="{{ $totalGallery }}" icon="fas fa-images" theme="purple" url="{{ route('admin.gallery.index') }}" url-text="Lihat Semua"/>
        </div>
        <div class="col-md-3">
        <x-adminlte-info-box title="Kritik & Saran" text="{{ $totalKritikSaran }}" icon="fas fa-comment-dots" theme="orange" url="/admin/kritik-saran" url-text="Lihat Semua"/>
    </div>

    <div class="col-md-3">
        <x-adminlte-info-box title="Promo & Event" text="{{ $totalPromoEvent }}" icon="fas fa-bullhorn" theme="warning"  url="/admin/promo-event" url-text="Lihat Semua"/>
    </div>
@endsection
