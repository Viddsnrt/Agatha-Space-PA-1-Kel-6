@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Kirim Kritik & Saran</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="{{ route('kritik-saran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow-sm rounded">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
    <label for="jenis" class="form-label">Jenis</label>
    <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
        <option value="" selected disabled hidden>🔽 Pilih jenis masukan Anda</option>
        <option value="kritik" {{ old('jenis') == 'kritik' ? 'selected' : '' }}>Kritik</option>
        <option value="saran" {{ old('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
    </select>
    @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>


                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan</label>
                    <textarea name="pesan" id="pesan" rows="4" class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan') }}</textarea>
                    @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    {{-- List --}}
<hr class="my-5">
<h3 class="text-center mb-4">Kritik & Saran dari Pengunjung</h3>

<div class="row">
    @forelse ($kritikSaran as $item)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary fw-semibold">{{ $item->nama }}</h5>
                    <span class="badge bg-{{ $item->jenis == 'kritik' ? 'danger' : 'success' }}">
                        {{ ucfirst($item->jenis) }}
                    </span>
                    <p class="mt-3">{{ $item->pesan }}</p>

                    @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             class="img-fluid rounded mt-3"
                             alt="gambar"
                             style="max-height: 200px; object-fit: cover;">
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">Belum ada kritik atau saran yang ditampilkan.</p>
    @endforelse
</div>
