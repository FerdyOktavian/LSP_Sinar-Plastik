@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Barang</h1>
        <p class="page-desc">Menambahkan data barang baru ke dalam sistem persediaan.</p>
    </div>

    <div class="card">
        <form action="/products" method="POST">
            @csrf

            <div class="form-group">
                <label>Kategori Barang</label>
                <select name="id_category">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_category }}" {{ old('id_category') == $category->id_category ? 'selected' : '' }}>
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
                <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: BRG001">

                @error('code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Plastik Kresek Hitam">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="unit" value="{{ old('unit') }}" placeholder="Contoh: pcs, pack, dus">

                @error('unit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok Awal</label>
                <input type="number" name="stock" value="{{ old('stock') }}" min="0" placeholder="Masukkan jumlah stok awal">

                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Batas Minimum Stok</label>
                <input type="number" name="minimum_stock" value="{{ old('minimum_stock') }}" min="0" placeholder="Contoh: 10">

                @error('minimum_stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/products" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection