@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Kategori</h1>
        <p class="page-desc">Menambahkan kategori baru untuk mengelompokkan data barang.</p>
    </div>

    <div class="card">
        {{-- Form ini mengirim data kategori baru ke controller untuk disimpan. --}}
        <form action="/categories" method="POST">
            {{-- Token CSRF menjaga form dari request palsu. --}}
            @csrf

            <div class="form-group">
                <label>Nama Kategori</label>
                {{-- old('name') membuat input tetap terisi jika validasi gagal. --}}
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Plastik, Kemasan, Alat Makan">

                {{-- Pesan validasi akan tampil jika nama kategori belum sesuai aturan. --}}
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/categories" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
