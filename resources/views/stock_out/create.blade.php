@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Barang Keluar</h1>
        <p class="page-desc">Mencatat pengurangan stok barang dari sistem.</p>
    </div>

    <div class="card">
        {{-- Form ini mencatat transaksi stok keluar dan mengurangi stok barang. --}}
        <form action="/stock-out" method="POST">
            @csrf

            <div class="form-group">
                <label>Tanggal</label>
                {{-- Tanggal digunakan sebagai waktu pencatatan barang keluar. --}}
                <input type="date" name="date" value="{{ old('date') }}">

                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Barang</label>
                <select name="id_product">
                    <option value="">-- Pilih Barang --</option>
                    {{-- Stok saat ini ditampilkan agar jumlah keluar tidak melebihi persediaan. --}}
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
                <label>Jumlah Keluar</label>
                {{-- Jumlah keluar minimal 1 dan akan divalidasi lagi di controller. --}}
                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" placeholder="Masukkan jumlah barang keluar">

                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                {{-- Keterangan opsional untuk mencatat alasan atau tujuan barang keluar. --}}
                <textarea name="description" rows="4" placeholder="Contoh: Barang terjual">{{ old('description') }}</textarea>

                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/stock-out" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
