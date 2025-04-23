@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Kirim Kritik & Saran</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kritik-saran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
            </select>
            @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="pesan">Pesan</label>
            <textarea name="pesan" id="pesan" class="form-control @error('pesan') is-invalid @enderror" rows="4" required>{{ old('pesan') }}</textarea>
            @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar (Opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Kirim Kritik/Saran</button>
    </form>

    {{-- Daftar kritik dan saran --}}
    <hr class="my-5">
    <h3 class="mb-4">Kritik & Saran dari Pengunjung</h3>

    @forelse ($kritikSaran as $item)
        <div class="card mb-3">
            <div class="card-body">
                <strong>{{ $item->nama }}</strong> ({{ ucfirst($item->jenis) }})<br>
                <p>{{ $item->pesan }}</p>

                @if ($item->gambar)
                    <div>
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" style="max-width: 300px" class="img-fluid rounded">
                    </div>
                @endif
            </div>
        </div>
    @empty
        <p>Belum ada kritik atau saran yang ditampilkan.</p>
    @endforelse
</div>
@endsection
