@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Barang</h1>
        <p class="page-desc">Mengubah data barang yang sudah tersimpan di sistem.</p>
    </div>

    <div class="card">
        {{-- Form update diarahkan ke barang yang sedang diedit berdasarkan id_product. --}}
        <form action="/products/{{ $product->id_product }}" method="POST">
            @csrf
            {{-- Method PUT digunakan untuk memperbarui data barang. --}}
            @method('PUT')

            <div class="form-group">
                <label>Kategori Barang</label>
                <select name="id_category">
                    <option value="">-- Pilih Kategori --</option>
                    {{-- Pilihan kategori otomatis memilih kategori lama milik barang ini. --}}
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_category }}" {{ old('id_category', $product->id_category) == $category->id_category ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('id_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Kode Barang</label>
                {{-- old() menjaga input sebelumnya, lalu memakai kode barang dari database. --}}
                <input type="text" name="code" value="{{ old('code', $product->code) }}">

                @error('code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="unit" value="{{ old('unit', $product->unit) }}">

                @error('unit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0">

                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Batas Minimum Stok</label>
                {{-- Batas minimum membantu sistem menandai barang dengan stok rendah. --}}
                <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" min="0">

                @error('minimum_stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
