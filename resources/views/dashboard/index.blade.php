@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Ringkasan data persediaan barang Toko Sinar Plastik.</p>

    {{-- Kartu ini menampilkan jumlah semua barang yang terdaftar. --}}
    <div class="card">
        <h3>Total Barang</h3>
        <h2>{{ $totalProducts }}</h2>
    </div>

    {{-- Total stok masuk dihitung dari seluruh transaksi bertipe masuk. --}}
    <div class="card">
        <h3>Total Stok Masuk</h3>
        <h2>{{ $totalStockIn }}</h2>
    </div>

    {{-- Total stok keluar dihitung dari seluruh transaksi bertipe keluar. --}}
    <div class="card">
        <h3>Total Stok Keluar</h3>
        <h2>{{ $totalStockOut }}</h2>
    </div>

    {{-- Menampilkan jumlah barang yang stoknya sudah rendah. --}}
    <div class="card">
        <h3>Stok Terendah</h3>
        <h2>{{ $lowStockProducts }}</h2>
        <p>Barang dengan stok kurang dari atau sama dengan batas minimum.</p>
    </div>

    {{-- Jika ada data barang, tampilkan barang dengan stok paling tinggi. --}}
    <div class="card">
        <h3>Stok Tertinggi</h3>

        @if ($highestStockProduct)
            <h2>{{ $highestStockProduct->name }}</h2>
            <p>Stok: {{ $highestStockProduct->stock }}</p>
        @else
            <p>Belum ada data barang.</p>
        @endif
    </div>
@endsection
