@extends('layouts.app')

@section('content')
    <h1>Tambah Barang Keluar</h1>
    <p>Form ini digunakan untuk mencatat pengurangan stok barang.</p>

    <div class="card">
        @if (session('error'))
            <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:4px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="/stock-out" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Tanggal</label><br>
                <input type="date" name="date" value="{{ old('date') }}" style="width: 100%; padding: 8px;">

                @error('date')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Barang</label><br>
                <select name="id_product" style="width: 100%; padding: 8px;">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id_product }}" {{ old('id_product') == $product->id_product ? 'selected' : '' }}>
                            {{ $product->code }} - {{ $product->name }} | Stok: {{ $product->stock }}
                        </option>
                    @endforeach
                </select>

                @error('id_product')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Jumlah Keluar</label><br>
                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" style="width: 100%; padding: 8px;">

                @error('quantity')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Keterangan</label><br>
                <textarea name="description" style="width: 100%; padding: 8px;">{{ old('description') }}</textarea>

                @error('description')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding:8px 12px; background:#2c3e50; color:white; border:none; border-radius:4px;">
                Simpan
            </button>

            <a href="/stock-out" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection