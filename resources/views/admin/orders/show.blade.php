@extends('admin.layouts.app') {{-- Pastikan path layout admin Anda benar --}}

@section('title', 'Detail Pesanan #' . $order->id)

@section('content_header') {{-- Sesuaikan nama section jika berbeda --}}
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            {{-- Card Item Pesanan --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Item Pesanan</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Harga Satuan</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items as $item) {{-- Menggunakan forelse untuk penanganan jika items kosong --}}
                            <tr>
                                <td>
                                    {{ $item->menu_name }}
                                    @if($item->menu) <small class="d-block text-muted">({{ $item->menu->category->nama ?? 'Tanpa Kategori' }})</small> @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">Rp {{ number_format($item->price_at_order, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada item dalam pesanan ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Card Ringkasan Pesan WA (jika ada) --}}
            @if($order->order_details_text)
            <div class="card mt-3"> {{-- Tambah margin top --}}
                <div class="card-header"><h3 class="card-title">Ringkasan Pesan WA</h3></div>
                <div class="card-body">
                    <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit; font-size: inherit;">{{ $order->order_details_text }}</pre>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            {{-- Card Informasi Pesanan --}}
            <div class="card">
                <div class="card-header"><h3 class="card-title">Informasi Pesanan</h3></div>
                <div class="card-body">
                    <p><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                    <p><strong>Nama Pemesan:</strong> {{ $order->customer_name }}</p>
                    @if($order->customer_phone)
                        <p><strong>No. WhatsApp:</strong> {{ $order->customer_phone }}</p>
                    @endif
                    @if($order->user)
                        <p><strong>Akun Pengguna:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
                    @else
                        <p><strong>Akun Pengguna:</strong> Tamu</p>
                    @endif

                    {{-- TAMBAHKAN INFORMASI JAM KEDATANGAN --}}
                    @if($order->jam_kedatangan)
                        <p><strong>Jam Kedatangan (Estimasi):</strong> {{ \Carbon\Carbon::parse($order->jam_kedatangan)->format('H:i') }}</p>
                    @endif
                    {{-- ------------------------------------ --}}

                    <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i A') }}</p>
                    <p><strong>Total Pembayaran:</strong> <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></p>
                    @if($order->notes)
                        <p class="mb-0"><strong>Catatan:</strong></p> {{-- Hapus <br> --}}
                        <p><em class="text-muted" style="white-space: pre-wrap;">{{ $order->notes }}</em></p>
                    @endif
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-3">
                {{-- Tombol Hapus Pesanan --}}
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini secara permanen? Tindakan ini tidak dapat diurungkan.');" style="display: block; width: 100%;"> {{-- display: block untuk full width --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block"> {{-- btn-block untuk full width --}}
                        <i class="fas fa-trash-alt mr-1"></i> Hapus Pesanan Ini
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(function() { // Menggunakan $(function() {}) sebagai shorthand untuk $(document).ready(function(){})
        @if(session('success'))
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Berhasil',
                body: '{{ session('success') }}',
                autohide: true, // Tambahkan autohide
                delay: 3000    // Durasi tampil
            });
        @endif
        @if(session('error'))
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Gagal',
                body: '{{ session('error') }}',
                autohide: true,
                delay: 5000
            });
        @endif
    });
</script>
@endpush