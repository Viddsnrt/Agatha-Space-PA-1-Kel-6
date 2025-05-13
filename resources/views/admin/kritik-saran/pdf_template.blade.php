<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Laporan Kritik & Saran' }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Font yang mendukung karakter unicode */
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .date {
            text-align: right;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>{{ $title ?? 'Laporan Kritik & Saran' }}</h2>
    <div class="date">Tanggal Cetak: {{ $date ?? date('d/m/Y') }}</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Jenis</th>
                <th>Pesan</th>
                <th>Tampilkan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kritiksarans as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>{{ $item->pesan }}</td>
                    <td>{{ $item->tampilkan ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>