@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Gambar Galeri</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mb-3">
        <label for="image" class="form-label">Ganti Gambar</label>
        <input type="file" name="image" id="image" class="form-control">
        @error('image')
          <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <small>Preview saat ini:</small><br>
        <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" class="img-thumbnail" style="max-width: 200px;">
      </div>

      <button type="submit" class="btn btn-success">Update</button>
      <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
