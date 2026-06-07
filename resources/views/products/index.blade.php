@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Daftar Barang</h1>
        <p class="page-desc">Mengelola data barang, kategori, stok, satuan, dan batas minimum stok.</p>
    </div>

    <div class="card">
        <form action="/products" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama barang...">

            <button type="submit" class="btn">Cari</button>
            <a href="/products" class="btn btn-secondary">Reset</a>
        </form>

        <a href="/products/create" class="btn btn-success">+ Tambah Barang</a>

        <br><br>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Minimum</th>
                        <th>Status</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
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
                                @if ($product->stock == 0)
                                    <span class="badge badge-danger">Tidak Tersedia</span>
                                @elseif ($product->stock <= $product->minimum_stock)
                                    <span class="badge badge-warning">Stok Rendah</span>
                                @else
                                    <span class="badge badge-success">Tersedia</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/products/{{ $product->id_product }}/edit" class="btn btn-warning">
                                        Edit
                                    </a>

                                    <form action="/products/{{ $product->id_product }}" method="POST" style="margin:0;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;">Data barang belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection