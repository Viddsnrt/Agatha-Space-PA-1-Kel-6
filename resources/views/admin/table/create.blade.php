@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Tambah Meja Baru</h4>

    <form action="{{ route('admin.table.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="meja" class="form-label">Nama Meja</label>
            <input type="text" name="meja" id="meja" class="form-control" value="{{ old('meja') }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Meja (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
