@extends('layouts.app')

@section('content')
    <h1>Persediaan Barang</h1>
    <p>Halaman ini digunakan untuk melihat stok terakhir dan status barang.</p>

    <div class="card">

    {{-- Form pencarian membantu mencari persediaan berdasarkan kode atau nama barang. --}}
    <form action="/inventory" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode/nama barang...">
        <button type="submit">Cari</button>
        <a href="/inventory">Reset</a>
    </form>

    <br>
        {{-- Tabel persediaan menampilkan stok saat ini tanpa tombol ubah atau hapus. --}}
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok Saat Ini</th>
                    <th>Batas Minimum</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse menampilkan daftar barang, atau pesan kosong jika belum ada data. --}}
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->minimum_stock }}</td>
                        <td>
                            {{-- Status stok dihitung dari stok saat ini dan batas minimum. --}}
                            @if ($product->stock == 0)
                                Tidak Tersedia
                            @elseif ($product->stock <= $product->minimum_stock)
                                Stok Rendah
                            @else
                                Tersedia
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" align="center">Data persediaan barang belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
