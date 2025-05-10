@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Kritik & Saran dari Pengunjung</h2>

    <div class="row">
        @forelse ($kritikSaran as $item)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-semibold">{{ $item->nama }}</h5>
                        <p class="badge bg-{{ $item->jenis == 'kritik' ? 'danger' : 'success' }}">{{ ucfirst($item->jenis) }}</p>
                        <p class="mt-2">{{ $item->pesan }}</p>

                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid rounded mt-3" alt="gambar" style="max-height: 200px;">
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada kritik atau saran yang ditampilkan.</p>
        @endforelse
    </div>
</div>
@endsection
