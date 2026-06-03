@extends('layouts.app')

@section('content')
    <h1>Laporan Persediaan</h1>
    <p>Halaman ini digunakan untuk melihat laporan transaksi persediaan barang.</p>

    <div class="card">
        <form action="/reports" method="GET" style="margin-bottom: 20px;">
            <label>Tanggal Awal</label><br>
            <input type="date" name="start_date" value="{{ request('start_date') }}" style="padding: 8px; margin-bottom: 10px;"><br>

            <label>Tanggal Akhir</label><br>
            <input type="date" name="end_date" value="{{ request('end_date') }}" style="padding: 8px; margin-bottom: 10px;"><br>

            <button type="submit" class="btn">Filter</button>

            <a href="/reports" class="btn btn-secondary">Reset</a>

            <a href="/reports/print?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
            target="_blank"
            class="btn btn-success">
                Print
            </a>

            <a href="/reports/pdf?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
            class="btn btn-danger">
                Download PDF
            </a>

            <a href="/reports/excel?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
            class="btn btn-success">
                Download CSV
            </a>
        </form>

        <table border="1" cellpadding="10" cellspacing="0" width="100%">
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
    </div>
@endsection