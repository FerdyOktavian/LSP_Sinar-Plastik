<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Persediaan PDF</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111827;
            font-size: 11px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #111827;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        .info {
            margin-bottom: 12px;
        }

        .info table {
            border: none;
            width: 100%;
        }

        .info td {
            border: none;
            padding: 2px;
            font-size: 11px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .report-table, 
        .report-table th, 
        .report-table td {
            border: 1px solid #111827;
        }

        .report-table th {
            background: #f3f4f6;
            font-weight: bold;
            text-align: left;
        }

        .report-table th,
        .report-table td {
            padding: 6px;
        }

        .footer {
            margin-top: 35px;
            width: 100%;
        }

        .signature {
            width: 200px;
            float: right;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>TOKO SINAR PLASTIK</h2>
        <p>Laporan Persediaan Barang</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>
                    <strong>Periode:</strong>
                    {{-- Menampilkan periode laporan jika filter tanggal dipakai. --}}
                    @if(request('start_date') && request('end_date'))
                        {{ request('start_date') }} sampai {{ request('end_date') }}
                    @else
                        Semua Data
                    @endif
                </td>
                <td style="text-align:right;">
                    <strong>Tanggal Cetak:</strong> {{ date('d-m-Y') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- Tabel ini menjadi isi utama file PDF laporan persediaan. --}}
    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse memastikan PDF tetap menampilkan pesan jika data laporan kosong. --}}
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->date }}</td>
                    {{-- Tanda ?? '-' dipakai sebagai pengganti jika data barang tidak tersedia. --}}
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

</body>
</html>
