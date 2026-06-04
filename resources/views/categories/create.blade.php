@extends('layouts.app')

@section('content')
    <h1>Tambah Kategori</h1>
    <p>Form ini digunakan untuk menambahkan data kategori barang.</p>

    <div class="card">
        {{-- Form ini mengirim data kategori baru ke controller untuk disimpan. --}}
        <form action="/categories" method="POST">
            {{-- Token CSRF melindungi form dari request yang tidak sah. --}}
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Nama Kategori</label><br>
                <input type="text" name="name" value="{{ old('name') }}" style="width: 100%; padding: 8px;">
                
                {{-- Menampilkan pesan validasi jika nama kategori belum sesuai. --}}
                @error('name')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan</button>

            <a href="/categories" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
