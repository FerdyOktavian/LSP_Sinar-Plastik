@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Barang Keluar</h1>
        <p class="page-desc">Mencatat dan melihat riwayat pengurangan stok barang.</p>
    </div>

    <div class="card">
        <a href="/stock-out/create" class="btn btn-success">+ Tambah Barang Keluar</a>

        <br><br>

        <div class="table-wrapper">
            {{-- Tabel ini menampilkan riwayat transaksi barang keluar. --}}
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Jika transaksi kosong, @empty akan menampilkan pesan data belum tersedia. --}}
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->date }}</td>
                            {{-- Tanda ?? '-' menjadi pengganti jika relasi barang tidak tersedia. --}}
                            <td>{{ $transaction->product->code ?? '-' }}</td>
                            <td>{{ $transaction->product->name ?? '-' }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">Data barang keluar belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
