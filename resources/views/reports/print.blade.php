<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Persediaan</title>

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            color: #111827;
            margin: 30px;
            font-size: 13px;
        }

        .no-print {
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            margin-right: 5px;
        }

        .btn-secondary {
            background: #6b7280;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #111827;
            padding-bottom: 15px;
            margin-bottom: 18px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 6px 0 0;
            color: #374151;
        }

        .info {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        table, th, td {
            border: 1px solid #111827;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .footer {
            margin-top: 45px;
            display: flex;
            justify-content: flex-end;
        }

        .signature {
            text-align: center;
            width: 220px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="btn" onclick="window.print()">Print</button>
        <button class="btn btn-secondary" onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <h2>TOKO SINAR PLASTIK</h2>
        <p>Laporan Persediaan Barang</p>
    </div>

    <div class="info">
        <div>
            <strong>Periode:</strong>
            @if(request('start_date') && request('end_date'))
                {{ request('start_date') }} sampai {{ request('end_date') }}
            @else
                Semua Data
            @endif
        </div>

        <div>
            <strong>Tanggal Cetak:</strong> {{ date('d-m-Y') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
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
                    <td colspan="7" style="text-align:center;">Data laporan belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Admin Toko</p>
            <br><br><br>
            <p>_____________________</p>
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>
</html>