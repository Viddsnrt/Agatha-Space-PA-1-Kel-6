@extends('admin.layouts.app')
@section('content')
<h1>Galeri</h1>
<a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-3">Tambah Gambar</a>
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

<table class="table">
  <thead><tr><th>#</th><th>Preview</th><th>Aksi</th></tr></thead>
  <tbody>
    @foreach($items as $item)
    <tr>
      <td>{{ $loop->iteration + ($items->currentPage()-1)*$items->perPage() }}</td>
      <td><img src="{{ asset('uploads/gallery/'.$item->image) }}" width="100"></td>
      <td>
        <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('admin.gallery.destroy', $item) }}" method="post" class="d-inline">
          @csrf @method('delete')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $items->links() }}
@endsection
