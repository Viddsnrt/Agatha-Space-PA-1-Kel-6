@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Menu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <form action="{{ route('admin.menus.index') }}" method="GET" class="form-inline">
            <label for="kategori_id" class="form-label me-2">Filter Kategori:</label>
            <select name="kategori_id" class="form-select d-inline-block w-auto me-2">
                <option value="">-- Semua --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-secondary">Filter</button>
        </form>
    </div>

    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary mb-3">+ Tambah Menu</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->nama }}</td>
                <td>{{ $menu->deskripsi }}</td>
                <td>{{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td>{{ $menu->category->nama ?? '-' }}</td>

                <td>
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="Gambar" width="80">
                </td>
                <td>
                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
