@extends('layouts.app')

@section('content')
    <h1>Barang Masuk</h1>
    <p>Halaman ini digunakan untuk mencatat dan melihat riwayat barang masuk.</p>

    <div class="card">
        {{-- Tombol menuju form untuk menambahkan transaksi stok masuk. --}}
        <a href="/stock-in/create" style="display:inline-block; margin-bottom:15px; padding:8px 12px; background:#2c3e50; color:white; text-decoration:none; border-radius:4px;">
            + Tambah Barang Masuk
        </a>

        {{-- Tabel menampilkan riwayat barang masuk yang sudah dicatat. --}}
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                {{-- Jika transaksi kosong, @empty akan menampilkan pesan data belum tersedia. --}}
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->date }}</td>
                        {{-- Tanda ?? '-' mencegah error tampilan jika data barang tidak ditemukan. --}}
                        <td>{{ $transaction->product->code ?? '-' }}</td>
                        <td>{{ $transaction->product->name ?? '-' }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ $transaction->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" align="center">Data barang masuk belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
