<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* DejaVu Sans mendukung banyak karakter, termasuk simbol mata uang */
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 15px; /* Sedikit kurangi margin */
            font-size: 18px;
            color: #333;
        }
        p {
            margin-bottom: 10px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc; /* Warna border lebih lembut */
            padding: 7px; /* Sedikit tambah padding */
            text-align: left;
            vertical-align: top; /* Align atas untuk teks panjang */
        }
        th {
            background-color: #e9ecef; /* Warna header tabel lebih lembut */
            font-weight: bold;
            color: #495057;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .no-wrap {
            white-space: nowrap; /* Mencegah wrap pada kolom tertentu jika perlu */
        }
        .footer-info {
            margin-top: 30px;
            font-size: 9px;
            color: #777;
            text-align: center;
        }
        .filter-info {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 9px;
        }
        .filter-info strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Pesanan Agatha Space</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now(config('app.timezone'))->format('d F Y, H:i') }}</p>

        {{-- Menampilkan informasi filter jika ada --}}
        @if(isset($filterParams) && (isset($filterParams['search']) || isset($filterParams['start_date']) || isset($filterParams['end_date']) || isset($filterParams['filter_jam_kedatangan'])))
            <div class="filter-info">
                <strong>Filter yang diterapkan:</strong><br>
                @if(isset($filterParams['search']) && $filterParams['search'])
                    Pencarian: <em>{{ $filterParams['search'] }}</em><br>
                @endif
                @if(isset($filterParams['start_date']) && $filterParams['start_date'])
                    Dari Tanggal: <em>{{ \Carbon\Carbon::parse($filterParams['start_date'])->format('d M Y') }}</em><br>
                @endif
                @if(isset($filterParams['end_date']) && $filterParams['end_date'])
                    Sampai Tanggal: <em>{{ \Carbon\Carbon::parse($filterParams['end_date'])->format('d M Y') }}</em><br>
                @endif
                @if(isset($filterParams['filter_jam_kedatangan']) && $filterParams['filter_jam_kedatangan'])
                    Jam Kedatangan: <em>{{ $filterParams['filter_jam_kedatangan'] }}</em><br>
                @endif
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 25%;">Nama Pemesan</th>
                    <th style="width: 20%;" class="no-wrap">Tgl Pesan</th>
                    <th style="width: 15%;" class="text-center no-wrap">Jam Datang</th> {{-- TAMBAHKAN KOLOM BARU --}}
                    <th style="width: 15%;" class="text-right">Item</th>
                    <th style="width: 20%;" class="text-right">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            {{ $order->customer_name }}
                            @if($order->user)
                                <br><small style="color: #666;">({{ $order->user->name }})</small>
                            @else
                                <br><small style="color: #666;">(Tamu)</small>
                            @endif
                        </td>
                        <td class="no-wrap">{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</td>
                        {{-- TAMPILKAN JAM KEDATANGAN --}}
                        <td class="text-center no-wrap">{{ $order->jam_kedatangan ? \Carbon\Carbon::parse($order->jam_kedatangan)->format('H:i') : '-' }}</td>
                        <td class="text-right">{{ $order->items_count ?? $order->items->count() }}</td> {{-- Menampilkan jumlah item --}}
                        <td class="text-right">{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        {{-- Sesuaikan colspan --}}
                        <td colspan="6" class="text-center">Tidak ada data pesanan untuk dilaporkan dengan filter yang diterapkan.</td>
                    </tr>
                @endforelse
                @if(count($orders) > 0)
                <tr>
                    <td colspan="5" class="text-right"><strong>Total Keseluruhan (dari data terfilter):</strong></td> {{-- Sesuaikan colspan --}}
                    <td class="text-right"><strong>{{ number_format($totalOverall, 0, ',', '.') }}</strong></td>
                </tr>
                @endif
            </tbody>
        </table>

        <div class="footer-info">
            Laporan ini dihasilkan secara otomatis oleh sistem Agatha Space.
        </div>
    </div>
</body>
</html>