@extends('admin.layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            {{-- ... Card Item Pesanan dan Ringkasan WA tetap sama ... --}}
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
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    {{ $item->menu_name }}
                                    @if($item->menu) <small class="d-block text-muted">({{ $item->menu->category->nama ?? 'Tanpa Kategori' }})</small> @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">Rp {{ number_format($item->price_at_order, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($order->order_details_text)
            <div class="card">
                <div class="card-header"><h3 class="card-title">Ringkasan Pesan WA</h3></div>
                <div class="card-body">
                    <pre style="white-space: pre-wrap; word-wrap: break-word;">{{ $order->order_details_text }}</pre>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-4">
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
                    <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                    
                    {{-- Baris yang Menampilkan Status Saat Ini Dihapus --}}
                    {{--
                    <p><strong>Status Saat Ini:</strong>
                        <span class="badge badge-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : ($order->status == 'processing' || $order->status == 'on_delivery' ? 'info' : 'warning')) }}">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </p>
                    --}}

                    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i A') }}</p>
                    <p><strong>Total Pembayaran:</strong> <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></p>
                    @if($order->notes)
                        <p><strong>Catatan:</strong> <br> <em class="text-muted">{{ $order->notes }}</em></p>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini secara permanen? Tindakan ini tidak dapat diurungkan.');" style="display: inline-block; width: 100%;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus Pesanan Ini
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    @if(session('success'))
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Berhasil',
            body: '{{ session('success') }}'
        });
    @endif
    @if(session('error'))
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Gagal',
            body: '{{ session('error') }}'
        });
    @endif
</script>
@endpush