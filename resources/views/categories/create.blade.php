@extends('layouts.app')

@section('content')
    <h1>Tambah Kategori</h1>
    <p>Form ini digunakan untuk menambahkan data kategori barang.</p>

    <div class="card">
        <form action="/categories" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Nama Kategori</label><br>
                <input type="text" name="name" value="{{ old('name') }}" style="width: 100%; padding: 8px;">
                
                @error('name')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan</button>

            <a href="/categories" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection