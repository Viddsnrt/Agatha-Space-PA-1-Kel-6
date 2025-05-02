@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Edit Meja</h4>

    <form action="{{ route('admin.table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="meja" class="form-label">Nama Meja</label>
            <input type="text" name="meja" id="meja" class="form-control" value="{{ old('meja', $table->meja) }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Meja (opsional)</label>
            @if ($table->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $table->gambar) }}" width="120">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
    </form>
</div>
@endsection
