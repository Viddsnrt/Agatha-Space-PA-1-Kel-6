@extends('admin.layouts.app') {{-- Sesuaikan dengan layout admin Anda, mungkin adminlte.page atau lainnya --}}

@section('title', 'Manajemen Menu') {{-- Judul Halaman --}}

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Menu</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Menu</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Daftar Menu Makanan & Minuman</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.menus.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Tambah Menu Baru
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    {{-- Filter Form --}}
                    <form action="{{ route('admin.menus.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kategori_id_filter">Filter Kategori:</label>
                                    <select name="kategori_id" id="kategori_id_filter" class="form-control form-control-sm select2">
                                        <option value="">-- Semua Kategori --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="search_filter">Cari Menu:</label>
                                    <input type="text" name="search" id="search_filter" class="form-control form-control-sm" placeholder="Nama atau deskripsi..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-filter"></i> Filter</button>
                                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Reset Filter"><i class="fas fa-sync-alt"></i> Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- End Filter Form --}}

                    <div class="table-responsive">
                        <table id="menusTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th>Nama Menu</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th style="width: 100px;">Gambar</th>
                                    <th>Deskripsi Singkat</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($menus as $index => $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> {{-- PERUBAHAN: Gunakan $loop->iteration untuk nomor urut --}}
                                    <td>{{ $menu->nama }}</td>
                                    <td>{{ $menu->category->nama ?? 'Tidak ada kategori' }}</td>
                                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($menu->gambar && Storage::disk('public')->exists($menu->gambar))
                                            <a href="{{ asset('storage/' . $menu->gambar) }}" data-toggle="lightbox" data-title="{{ $menu->nama }}" data-gallery="menu-gallery">
                                                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                            </a>
                                        @else
                                            <span class="text-muted small">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{($menu->deskripsi) }}</td>
                                    <td>
                                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Edit Menu">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Anda yakin ingin menghapus menu \'{{ $menu->nama }}\'? Tindakan ini tidak dapat diurungkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Hapus Menu">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        @if(request()->filled('kategori_id') || request()->filled('search'))
                                            Tidak ada menu yang cocok dengan filter Anda. <a href="{{ route('admin.menus.index') }}">Tampilkan semua menu</a>.
                                        @else
                                            Belum ada data menu. Silakan <a href="{{ route('admin.menus.create') }}">tambah menu baru</a>.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                {{-- Card Footer DIHAPUS karena tidak ada pagination lagi --}}
                {{--
                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-center">
                        {{ $menus->appends(request()->query())->links() }}
                    </div>
                </div>
                --}}
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection

@push('css') {{-- AdminLTE menggunakan @push('css') --}}
    {{-- CSS untuk Select2 dan Ekko Lightbox tetap diperlukan jika Anda menggunakannya --}}
    {{-- Pastikan plugin ini diaktifkan di config/adminlte.php atau link manual di sini --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/ekko-lightbox.css') }}"> --}}
    {{-- CSS Pagination Manual DIHAPUS dari sini --}}
@endpush

@push('js') {{-- AdminLTE menggunakan @push('js') --}}
    {{-- Script untuk Select2 dan Ekko Lightbox tetap diperlukan --}}
    {{-- <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.min.js') }}"></script> --}}
    <script>
        $(function () {
            // Inisialisasi Select2 (jika plugin diaktifkan di config/adminlte.php)
            if (typeof $('.select2').select2 === 'function') {
                $('.select2').select2({
                    theme: 'bootstrap4'
                });
            }

            // Inisialisasi Ekko Lightbox (jika plugin diaktifkan di config/adminlte.php)
            if (typeof $(document).on === 'function' && typeof $.fn.ekkoLightbox === 'function') {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });
            }

            // Inisialisasi Tooltip Bootstrap sudah ada di layout admin utama
        });
    </script>
@endpush