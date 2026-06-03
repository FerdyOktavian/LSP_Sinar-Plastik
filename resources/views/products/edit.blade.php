@extends('layouts.app')

@section('content')
    <h1>Edit Barang</h1>
    <p>Form ini digunakan untuk mengubah data barang.</p>

    <div class="card">
        <form action="/products/{{ $product->id_product }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label>Kategori</label><br>
                <select name="id_category" style="width: 100%; padding: 8px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_category }}"
                            {{ old('id_category', $product->id_category) == $category->id_category ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('id_category')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Kode Barang</label><br>
                <input type="text" name="code" value="{{ old('code', $product->code) }}" style="width: 100%; padding: 8px;">

                @error('code')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Nama Barang</label><br>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width: 100%; padding: 8px;">

                @error('name')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Satuan</label><br>
                <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" style="width: 100%; padding: 8px;">

                @error('unit')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Stok</label><br>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" style="width: 100%; padding: 8px;">

                @error('stock')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Batas Minimum Stok</label><br>
                <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" min="0" style="width: 100%; padding: 8px;">

                @error('minimum_stock')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding:8px 12px; background:#2c3e50; color:white; border:none; border-radius:4px;">
                Update
            </button>

            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection