@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Gambar Galeri</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="image" class="form-label">Pilih Gambar</label>
        <input type="file" name="image" id="image" class="form-control" required>
        @error('image')
          <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
