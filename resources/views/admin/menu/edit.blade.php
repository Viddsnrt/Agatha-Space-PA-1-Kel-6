@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Menu</h2>
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama" class="form-control" value="{{ $menu->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $menu->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $menu->harga }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $menu->kategori_id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Sekarang</label><br>
            <img src="{{ asset('storage/' . $menu->gambar) }}" width="100">
        </div>

        <div class="mb-3">
            <label>Ganti Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
