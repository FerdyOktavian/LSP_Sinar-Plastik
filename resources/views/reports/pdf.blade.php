<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Persediaan PDF</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            font-size: 12px;
        }

        h2, h4 {
            text-align: center;
            margin: 5px;
        }

        .periode {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2>TOKO SINAR PLASTIK</h2>
    <h4>Laporan Persediaan Barang</h4>

    <div class="periode">
        @if(request('start_date') && request('end_date'))
            Periode: {{ request('start_date') }} sampai {{ request('end_date') }}
        @else
            Periode: Semua Data
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->product->code ?? '-' }}</td>
                    <td>{{ $transaction->product->name ?? '-' }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" align="center">Data laporan belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>