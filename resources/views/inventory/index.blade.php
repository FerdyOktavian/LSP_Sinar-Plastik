@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Persediaan Barang</h1>
        <p class="page-desc">Melihat stok terakhir dan status ketersediaan barang.</p>
    </div>

    <div class="card">
        {{-- Form pencarian membantu menemukan persediaan berdasarkan kode atau nama barang. --}}
        <form action="/inventory" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama barang...">

            <button type="submit" class="btn">Cari</button>
            <a href="/inventory" class="btn btn-secondary">Reset</a>
        </form>

        <div class="table-wrapper">
            {{-- Tabel persediaan hanya menampilkan stok dan status, tanpa tombol ubah atau hapus. --}}
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok Saat Ini</th>
                        <th>Batas Minimum</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Jika belum ada data barang, @empty akan menampilkan pesan kosong. --}}
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
                                {{-- Status stok ditentukan dari stok saat ini dibanding batas minimum. --}}
                                @if ($product->stock == 0)
                                    <span class="badge badge-danger">Tidak Tersedia</span>
                                @elseif ($product->stock <= $product->minimum_stock)
                                    <span class="badge badge-warning">Stok Rendah</span>
                                @else
                                    <span class="badge badge-success">Tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;">Data persediaan barang belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
