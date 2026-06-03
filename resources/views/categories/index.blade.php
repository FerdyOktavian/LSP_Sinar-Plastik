@extends('layouts.app')

@section('content')
    <h1>Kategori Barang</h1>
    <p>Halaman ini digunakan untuk mengelola data kategori barang.</p>
    
    <form action="/categories" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori...">
        <button type="submit">Cari</button>
        <a href="/categories">Reset</a>
    </form>

<br>
    <div class="card">
    <a href="/categories/create" class="btn">+ Tambah Kategori</a>

        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="/categories/{{ $category->id_category }}/edit">Edit</a>

                            <form action="/categories/{{ $category->id_category }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" align="center">Data kategori belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection