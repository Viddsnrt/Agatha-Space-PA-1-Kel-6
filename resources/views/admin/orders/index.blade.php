@extends('admin.layouts.app') {{-- Menggunakan layout admin, bukan adminlte::page jika Anda punya layout kustom --}}

@section('title', 'Daftar Pesanan')

@section('content_header') {{-- Sesuaikan nama section jika berbeda di layout admin Anda --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Pesanan Pelanggan</h1>
        {{-- Tambahkan form filter jika ingin filter berdasarkan tanggal untuk PDF --}}
        <a href="{{ route('admin.orders.downloadPdf', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-pdf mr-1"></i> Download Laporan (PDF)
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- Tambahkan Form Filter di Sini (Opsional) --}}
            <form action="{{ route('admin.orders.index') }}" method="GET" class="form-inline">
                <div class="input-group mr-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari ID/Nama Pemesan..." value="{{ request('search') }}">
                </div>
                {{-- Contoh Filter Tanggal Pemesanan --}}
                {{-- <div class="input-group mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservationtime" name="date_range" placeholder="Pilih rentang tanggal">
                </div> --}}
                <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-search"></i> Cari</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
            </form>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> {{-- × lebih baik dari x --}}
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
                        <th>Tgl Pesan</th>
                        <th>Jam Datang</th> {{-- TAMBAHKAN KOLOM BARU --}}
                        <th>Total</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer_name }} {{ $order->user ? '('.$order->user->name.')' : '(Tamu)' }}</td>
                            <td>{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</td>
                            {{-- TAMPILKAN JAM KEDATANGAN --}}
                            <td>{{ $order->jam_kedatangan ? \Carbon\Carbon::parse($order->jam_kedatangan)->format('H:i') : '-' }}</td>
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
                            {{-- Sesuaikan colspan --}}
                            <td colspan="6" class="text-center">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $orders->appends(request()->query())->links() }} {{-- Tambahkan appends untuk menjaga filter saat paginasi --}}
            </div>
        </div>
    </div>
@stop

@push('css')
{{-- Jika menggunakan daterangepicker untuk filter tanggal --}}
{{-- <link rel="stylesheet" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}"> --}}
@endpush

@push('js')
{{-- Jika menggunakan daterangepicker untuk filter tanggal --}}
{{-- <script src="{{ asset('vendor/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script> --}}
<script>
    $(function () {
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

        // Contoh inisialisasi daterangepicker jika Anda menambahkannya
        /*
        $('#reservationtime').daterangepicker({
            timePicker: false, // Set true jika ingin ada pilihan jam juga
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                applyLabel: 'Terapkan',
                cancelLabel: 'Batal',
                fromLabel: 'Dari',
                toLabel: 'Ke',
                customRangeLabel: 'Rentang Kustom',
                weekLabel: 'W',
                daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                firstDay: 1
            },
            autoUpdateInput: false // Agar input kosong jika belum dipilih
        });

        $('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('#reservationtime').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        */
    });
</script>
@endpush