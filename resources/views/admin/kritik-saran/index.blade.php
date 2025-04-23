@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Kritik & Saran</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Jenis</th>
                <th>Gambar</th>
                <th>Tampilkan di Web?</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($kritiksarans as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $item->tampilkan ? 'success' : 'secondary' }}">
                            {{ $item->tampilkan ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                    <td>
                    ID: {{ $item->id }} <!-- Debug: pastikan ini muncul -->
                        <form action="{{ route('admin.kritik-saran.updateTampilkan', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">
                                {{ $item->tampilkan ? 'Sembunyikan' : 'Tampilkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection