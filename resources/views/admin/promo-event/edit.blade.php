@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Promo / Event</h3>

    <form action="{{ route('admin.promo-event.update', $promoEvent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $promoEvent->judul) }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $promoEvent->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            <img src="{{ asset('storage/'.$promoEvent->gambar) }}" width="150" alt="">
        </div>

        <div class="mb-3">
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $promoEvent->tanggal_mulai }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ $promoEvent->tanggal_selesai }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.promo-event.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
