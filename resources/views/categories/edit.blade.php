@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Kategori</h1>
        <p class="page-desc">Mengubah data kategori barang yang sudah tersimpan.</p>
    </div>

    <div class="card">
        <form action="/categories/{{ $category->id_category }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="/categories" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection