@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1>Dashboard Admin Agatha Space</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>12</h3>
                    <p>Menu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coffee"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Tambahkan card lainnya untuk reservasi, transaksi, dll -->
    </div>
@endsection

@section('css')
    {{-- Tambah CSS custom kalau perlu --}}
@endsection

@section('js')
    {{-- Tambah JS custom kalau perlu --}}
@endsection
