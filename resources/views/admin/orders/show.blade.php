@extends('adminlte::page')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content_header')
    <h1>Detail Pesanan #{{ $order->id }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
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
                    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i A') }}</p>
                    <p><strong>Total Pembayaran:</strong> <strong class="text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></p>
                    @if($order->notes)
                        <p><strong>Catatan:</strong> <br> <em class="text-muted">{{ $order->notes }}</em></p>
                    @endif
                     <hr>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="status">Update Status Pesanan:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="on_delivery" {{ $order->status == 'on_delivery' ? 'selected' : '' }}>Dikirim</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                    </form>
                </div>
            </div>
             <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-block"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pesanan</a>
        </div>
    </div>
@stop