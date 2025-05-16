@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Meja: {{ $table->meja }}</h4>
        <a href="{{ route('admin.table.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="meja" class="form-label">Nama Meja <span class="text-danger">*</span></label>
                    <input type="text" name="meja" id="meja" class="form-control @error('meja') is-invalid @enderror" value="{{ old('meja', $table->meja) }}" required>
                    @error('meja')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Meja (opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" onchange="previewEditImage(event)">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <p class="mb-1">Gambar Saat Ini:</p>
                        @if ($table->gambar)
                            <img id="currentImage" src="{{ asset('storage/' . $table->gambar) }}" width="120" alt="Gambar Meja {{ $table->meja }}" class="img-thumbnail">
                        @else
                            <span id="currentImageText" class="text-muted">Tidak ada gambar</span>
                        @endif
                        <img id="imageEditPreview" src="#" alt="Preview Gambar Baru" class="mt-2 img-thumbnail" style="max-width: 200px; display: none;"/>
                        <p class="form-text text-muted mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync-alt"></i> Perbarui
                    </button>
                    <a href="{{ route('admin.table.index') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewEditImage(event) {
        const reader = new FileReader();
        const imagePreview = document.getElementById('imageEditPreview');
        const currentImage = document.getElementById('currentImage');
        const currentImageText = document.getElementById('currentImageText');

        reader.onload = function() {
            if (reader.readyState === 2) {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
                if(currentImage) currentImage.style.display = 'none'; // Sembunyikan gambar lama jika ada preview baru
                if(currentImageText) currentImageText.style.display = 'none';
            }
        }
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else { // Jika file dibatalkan
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            if(currentImage) currentImage.style.display = 'block'; // Tampilkan lagi gambar lama
            if(currentImageText) currentImageText.style.display = 'block';

        }
    }
</script>
@endpush