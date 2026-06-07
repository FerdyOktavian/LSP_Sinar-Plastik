@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Kategori Barang</h1>
        <p class="page-desc">Mengelola data kategori barang pada Toko Sinar Plastik.</p>
    </div>

    <div class="card">
        {{-- Form pencarian memakai method GET agar kata kunci terlihat di URL. --}}
        <form action="/categories" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori barang...">

            <button type="submit" class="btn">Cari</button>
            <a href="/categories" class="btn btn-secondary">Reset</a>
        </form>

        <a href="/categories/create" class="btn btn-success">+ Tambah Kategori</a>

        <br><br>

        <div class="table-wrapper">
            {{-- Tabel menampilkan daftar kategori dan tombol aksi untuk setiap data. --}}
            <table>
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th>Nama Kategori</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse menampilkan data jika ada, dan pesan kosong jika belum ada kategori. --}}
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/categories/{{ $category->id_category }}/edit" class="btn btn-warning">
                                        Edit
                                    </a>

                                    <form action="/categories/{{ $category->id_category }}" method="POST" style="margin:0;">
                                        @csrf
                                        {{-- Method DELETE digunakan karena form HTML hanya mendukung GET dan POST. --}}
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center;">Data kategori belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
