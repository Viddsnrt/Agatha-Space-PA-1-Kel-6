@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Promo & Event</h3>
    <a href="{{ route('admin.promo-event.create') }}" class="btn btn-primary mb-3">+ Tambah Promo/Event</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->judul }}</td>
                <td><img src="{{ asset('storage/'.$event->gambar) }}" width="100" alt=""></td>
                <td>{{ $event->tanggal_mulai }}</td>
                <td>{{ $event->tanggal_selesai }}</td>
                <td>
                    <a href="{{ route('admin.promo-event.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.promo-event.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
