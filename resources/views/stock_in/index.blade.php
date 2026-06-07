@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Barang Masuk</h1>
        <p class="page-desc">Mencatat dan melihat riwayat penambahan stok barang.</p>
    </div>

    <div class="card">
        <a href="/stock-in/create" class="btn btn-success">+ Tambah Barang Masuk</a>

        <br><br>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Masuk</th>
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
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">Data barang masuk belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection