@extends('admin.layouts.app')

@section('title', 'Daftar Pesanan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Pesanan Pelanggan</h1>
        <a href="{{ route('admin.orders.downloadPdf') }}" class="btn btn-success">
            <i class="fas fa-file-pdf mr-1"></i> Download Laporan (PDF)
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- ... notifikasi session ... --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <table id="ordersTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Tgl Pesan</th> {{-- Judul Kolom --}}
                        <th>Total</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }} {{ $order->user ? '('.$order->user->name.')' : '(Tamu)' }}</td>
                            {{-- Tampilkan langsung dari server, sudah di-handle oleh app.timezone --}}
                            <td>{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-xs btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan #{{ $order->id }} ini? Tindakan ini tidak dapat diurungkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" title="Hapus Pesanan">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pesanan.</td>
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

@push('js')
<script>
    $(function () {
        // Notifikasi Toast
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

        // HAPUS ATAU KOMENTARI BAGIAN JAVASCRIPT UNTUK KONVERSI WAKTU
        /*
        function formatLocalDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
            const month = monthNames[date.getMonth()];
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            return `${day} ${month} ${year}, ${hours}:${minutes}`;
        }

        $('.js-local-datetime').each(function() {
            const utcDatetime = $(this).data('utc-datetime');
            if (utcDatetime) {
                $(this).text(formatLocalDate(utcDatetime));
            }
        });
        */
    });
</script>
@endpush