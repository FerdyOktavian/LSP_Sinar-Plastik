@extends('layouts.app')

@section('content')
    <h1>Tambah Barang</h1>
    <p>Form ini digunakan untuk menambahkan data barang.</p>

    <div class="card">
        <form action="/products" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Kategori</label><br>
                <select name="id_category" style="width: 100%; padding: 8px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_category }}" {{ old('id_category') == $category->id_category ? 'selected' : '' }}>
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
                <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: BRG001" style="width: 100%; padding: 8px;">

                @error('code')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Nama Barang</label><br>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Plastik Kresek Hitam" style="width: 100%; padding: 8px;">

                @error('name')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Satuan</label><br>
                <input type="text" name="unit" value="{{ old('unit') }}" placeholder="Contoh: pcs / pack / dus" style="width: 100%; padding: 8px;">

                @error('unit')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Stok</label><br>
                <input type="number" name="stock" value="{{ old('stock') }}" min="0" style="width: 100%; padding: 8px;">

                @error('stock')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Batas Minimum Stok</label><br>
                <input type="number" name="minimum_stock" value="{{ old('minimum_stock') }}" min="0" style="width: 100%; padding: 8px;">

                @error('minimum_stock')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding:8px 12px; background:#2c3e50; color:white; border:none; border-radius:4px;">
                Simpan
            </button>

            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection