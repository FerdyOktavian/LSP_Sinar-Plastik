@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Barang Masuk</h1>
        <p class="page-desc">Mencatat penambahan stok barang ke dalam sistem.</p>
    </div>

    <div class="card">
        {{-- Form ini mencatat transaksi stok masuk dan menambah stok barang. --}}
        <form action="/stock-in" method="POST">
            @csrf

            <div class="form-group">
                <label>Tanggal</label>
                {{-- Tanggal digunakan sebagai waktu pencatatan barang masuk. --}}
                <input type="date" name="date" value="{{ old('date') }}">

                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Barang</label>
                <select name="id_product">
                    <option value="">-- Pilih Barang --</option>
                    {{-- Pilihan barang menampilkan kode, nama, dan stok saat ini. --}}
                    @foreach ($products as $product)
                        <option value="{{ $product->id_product }}" {{ old('id_product') == $product->id_product ? 'selected' : '' }}>
                            {{ $product->code }} - {{ $product->name }} | Stok: {{ $product->stock }}
                        </option>
                    @endforeach
                </select>

                @error('id_product')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Jumlah Masuk</label>
                {{-- Jumlah masuk minimal 1 karena stok harus bertambah. --}}
                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" placeholder="Masukkan jumlah barang masuk">

                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                {{-- Keterangan bersifat opsional untuk memberi catatan transaksi. --}}
                <textarea name="description" rows="4" placeholder="Contoh: Penambahan stok dari supplier">{{ old('description') }}</textarea>

                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/stock-in" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
