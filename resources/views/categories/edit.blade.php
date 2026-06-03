@extends('layouts.app')

@section('content')
    <h1>Edit Kategori</h1>
    <p>Form ini digunakan untuk mengubah data kategori barang.</p>

    <div class="card">
        <form action="/categories/{{ $category->id_category }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label>Nama Kategori</label><br>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" style="width: 100%; padding: 8px;">

                @error('name')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding:8px 12px; background:#2c3e50; color:white; border:none; border-radius:4px;">
                Update
            </button>

            <a href="/categories" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection