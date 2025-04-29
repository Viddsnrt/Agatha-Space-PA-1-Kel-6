@extends('user.layouts.app')

@section('title', 'Promo & Event')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5">🎉 Promo & Event Spesial</h2>

    @if($promoEvents->count() > 0)
        <div class="row">
            @foreach($promoEvents as $promo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if($promo->gambar)
                            @php
                                // Menghilangkan 'promo-event/' dari nilai gambar jika sudah ada
                                $imageName = str_replace('promo-event/', '', $promo->gambar);
                            @endphp
                            <div style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                <img src="{{ asset('storage/' . $promo->gambar) }}" 
                                     class="card-img-top w-100 h-100" 
                                     alt="{{ $promo->judul }}" 
                                     style="object-fit: cover; border: 1px solid #eee;">
                            </div>
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-2">Tidak ada gambar</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $promo->judul }}</h5>
                            <p class="card-text text-secondary text-truncate">
                                {{ Str::limit(strip_tags($promo->deskripsi), 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between align-items-center border-top">
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d M Y') }}
                            </small>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#promoModal{{ $promo->id }}">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal Detail --}}
                <div class="modal fade" id="promoModal{{ $promo->id }}" tabindex="-1" aria-labelledby="promoModalLabel{{ $promo->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="promoModalLabel{{ $promo->id }}">{{ $promo->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                @if($promo->gambar)
                                    @php
                                        // Menghilangkan 'promo-event/' dari nilai gambar jika sudah ada
                                        $imageName = str_replace('promo-event/', '', $promo->gambar);
                                    @endphp
                                    <img src="{{ asset('images/promo-event/' . $imageName) }}" 
                                         class="img-fluid rounded mb-4" 
                                         alt="{{ $promo->judul }}"
                                         style="max-height: 400px; width: auto; display: block; margin: 0 auto; border: 1px solid #eee;">
                                @endif
                                <p class="text-muted mb-2">
                                    <strong>Periode:</strong><br>
                                    {{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d M Y') }}
                                </p>
                                <hr>
                                <div style="white-space: pre-wrap;">{!! nl2br(e($promo->deskripsi)) !!}</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal --}}
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Belum ada promo atau event tersedia saat ini.
        </div>
    @endif
</div>
@endsection