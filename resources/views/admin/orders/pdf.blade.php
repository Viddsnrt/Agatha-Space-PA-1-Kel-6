<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; margin:0; padding:0; }
        .container { padding: 20px; }
        h1 { text-align: center; margin-bottom: 20px; font-size: 18px;}
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Pesanan</h1>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now(config('app.timezone'))->format('d M Y, H:i') }}</p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Tgl Pesan</th>
                    <th class="text-right">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }} {{ $order->user ? '('.$order->user->name.')' : '(Tamu)' }}</td>
                        <td>{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-right">{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data pesanan untuk dilaporkan.</td>
                    </tr>
                @endforelse
                @if(count($orders) > 0)
                <tr>
                    <td colspan="3" class="text-right"><strong>Total Keseluruhan:</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalOverall, 0, ',', '.') }}</strong></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>