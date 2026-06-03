<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Persediaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
        }

        h2, h4 {
            text-align: center;
            margin: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            font-size: 13px;
            text-align: left;
        }

        .periode {
            text-align: center;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()">Print</button>
        <button onclick="window.close()">Tutup</button>
    </div>

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

    <div class="footer">
        <p>Dicetak oleh: Admin</p>
        <br><br>
        <p>_____________________</p>
    </div>

    <script>
        window.print();
    </script>

</body>
</html>