@extends('adminlte::page') {{-- Menggunakan layout AdminLTE --}}

@section('title', 'Edit Menu') {{-- Judul Halaman --}}

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Menu: {{ $menu->nama }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Manajemen Menu</a></li>
                <li class="breadcrumb-item active">Edit Menu</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2"> {{-- Form lebih terpusat --}}
            <div class="card card-warning"> {{-- Warna kartu untuk edit --}}
                <div class="card-header">
                    <h3 class="card-title">Formulir Edit Menu</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        {{-- Menampilkan pesan error validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Ada kesalahan!</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="nama">Nama Menu</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $menu->nama) }}" required>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', 'Rp' . number_format($menu->harga, 0, ',', '.')) }}" required>
                             @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $menu->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar Saat Ini</label><br>
                            @if($menu->gambar && Storage::disk('public')->exists($menu->gambar))
                                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="img-thumbnail mb-2" style="max-width: 200px; max-height: 150px;">
                            @else
                                <p class="text-muted">Tidak ada gambar.</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="gambar">Ganti Gambar (Opsional)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih file...</label>
                                </div>
                            </div>
                            @error('gambar')
                                <span class="invalid-feedback d-block" role="alert"> {{-- d-block agar tampil di bawah input group --}}
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar. Format: JPG, PNG, GIF, SVG.</small>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Update Menu
                        </button>
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary float-right">
                            <i class="fas fa-arrow-left mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@stop

@push('js')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
$(function () {
    // Inisialisasi bs-custom-file-input untuk nama file di input file
    if (typeof bsCustomFileInput !== 'undefined') {
        bsCustomFileInput.init();
    }

    const inputHarga = document.getElementById('harga');
    if (inputHarga) {
        inputHarga.addEventListener('input', function (e) {
            let value = this.value.replace(/[^0-9]/g, ''); // Hapus semua karakter non-angka
            if (value) {
                // Format dengan "Rp" dan titik sebagai pemisah ribuan, tanpa spasi setelah "Rp"
                this.value = 'Rp' + parseInt(value).toLocaleString('id-ID');
            } else {
                this.value = '';
            }
        });

        // Optional: Trigger format saat halaman load jika ada nilai dari old() yang belum terformat
        // atau jika Anda ingin memastikan formatnya konsisten saat load.
        // Biasanya tidak perlu jika old() juga sudah menghasilkan format yang sama dari controller.
        // let initialValue = inputHarga.value.replace(/[^0-9]/g, '');
        // if (initialValue) {
        //     inputHarga.value = 'Rp' + parseInt(initialValue).toLocaleString('id-ID');
        // }
    }
});
</script>
@endpush