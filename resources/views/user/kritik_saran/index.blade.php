@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Kritik & Saran dari Pengunjung</h2>

    @forelse ($kritikSaran as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $item->nama }} <small class="text-muted">({{ ucfirst($item->jenis) }})</small></h5>
                <p>{{ $item->pesan }}</p>

                @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" class="img-fluid mt-2" width="200">
                @endif
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada kritik atau saran yang ditampilkan.</p>
    @endforelse
</div>
@endsection
