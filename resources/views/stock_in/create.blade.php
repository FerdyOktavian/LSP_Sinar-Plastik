@extends('layouts.app')

@section('content')
    <h1>Tambah Barang Masuk</h1>
    <p>Form ini digunakan untuk mencatat penambahan stok barang.</p>

    <div class="card">
        {{-- Form ini mencatat transaksi stok masuk dan menambah stok barang. --}}
        <form action="/stock-in" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Tanggal</label><br>
                {{-- Tanggal dipakai sebagai waktu pencatatan transaksi stok masuk. --}}
                <input type="date" name="date" value="{{ old('date') }}" style="width: 100%; padding: 8px;">

                @error('date')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Barang</label><br>
                <select name="id_product" style="width: 100%; padding: 8px;">
                    <option value="">-- Pilih Barang --</option>
                    {{-- Pilihan barang menampilkan kode, nama, dan stok saat ini agar mudah dicek. --}}
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
                <label>Jumlah Masuk</label><br>
                {{-- Jumlah masuk minimal 1 karena stok yang dicatat harus bertambah. --}}
                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" style="width: 100%; padding: 8px;">

                @error('quantity')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Keterangan</label><br>
                {{-- Keterangan bersifat opsional untuk menjelaskan asal atau catatan transaksi. --}}
                <textarea name="description" style="width: 100%; padding: 8px;">{{ old('description') }}</textarea>

                @error('description')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding:8px 12px; background:#2c3e50; color:white; border:none; border-radius:4px;">
                Simpan
            </button>

            <a href="/stock-in" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
