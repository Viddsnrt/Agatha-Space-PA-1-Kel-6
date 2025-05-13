@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard Admin Agatha Space</h1>
@endsection

@section('content')
    <div class="row">
         {{-- BOX ROW 1 --}}
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
           <x-adminlte-info-box title="Kritik & Saran" text="{{ $totalKritikSaran }}" icon="fas fa-comment-dots" theme="orange" url="{{ route('admin.kritik-saran.index') }}" url-text="Lihat Semua"/>
       </div>

        {{-- BOX ROW 2 --}}
       <div class="col-md-3">
            <x-adminlte-info-box title="Promo & Event" text="{{ $totalPromoEvent }}" icon="fas fa-bullhorn" theme="warning"  url="{{ route('admin.promo-event.index') }}" url-text="Lihat Semua"/>
        </div>
         <div class="col-md-3">
             <x-adminlte-info-box title="Reservasi Meja" text="{{ $totalTable }}" icon="fas fa-concierge-bell" theme="olive" url="{{ route('admin.table.index') }}" url-text="Lihat Semua"/>
        </div>
         <div class="col-md-3">
            <x-adminlte-info-box title="Pengguna" text="{{ $totalUsers }}" icon="fas fa-users" theme="blue" url="{{ route('admin.users.index') }}" url-text="Kelola Pengguna"/>
        </div>
        
         <div class="col-md-3"> 
            <x-adminlte-info-box title="Pesanan Pelanggan" text="{{ $totalOrders }}" icon="fas fa-shopping-cart" theme="info" url="{{ route('admin.orders.index') }}"url-text="Kelola Pesanan"/>
        </div> 
    </div>
@endsection