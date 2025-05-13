@extends('adminlte::page')

@section('title', 'Daftar Pesanan')

@section('content_header')
    <h1>Daftar Pesanan Pelanggan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Tgl Pesan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }} {{ $order->user ? '('.$order->user->name.')' : '(Tamu)' }}</td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : ($order->status == 'processing' || $order->status == 'on_delivery' ? 'info' : 'warning')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- Tambahkan tombol hapus jika perlu --}}
                                {{-- <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@stop