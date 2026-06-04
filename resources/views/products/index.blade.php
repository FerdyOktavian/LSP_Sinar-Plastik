@extends('layouts.app')

@section('content')
    <h1>Daftar Barang</h1>
    <p>Halaman ini digunakan untuk mengelola data barang pada Toko Sinar Plastik.</p>

    {{-- Form pencarian digunakan untuk mencari barang berdasarkan kode atau nama. --}}
    <form action="/products" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode/nama barang...">
        <button type="submit">Cari</button>
        <a href="/products">Reset</a>
    </form>

<br>

    <div class="card">
        <a href="/products/create" class="btn">+ Tambah Barang</a>

        {{-- Tabel ini menampilkan data barang lengkap dengan kategori, stok, dan aksi. --}}
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Batas Minimum</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse menjaga halaman tetap rapi saat data barang masih kosong. --}}
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
                            {{-- Status barang ditentukan dari stok saat ini dibanding batas minimum. --}}
                            @if ($product->stock == 0)
                                Tidak Tersedia
                            @elseif ($product->stock <= $product->minimum_stock)
                                Stok Rendah
                            @else
                                Tersedia
                            @endif
                        </td>
                        <td>
                            <a href="/products/{{ $product->id_product }}/edit">Edit</a>

                            <form action="/products/{{ $product->id_product }}" method="POST" style="display:inline;">
                                @csrf
                                {{-- Method DELETE digunakan untuk menghapus data barang. --}}
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" align="center">Data barang belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
