@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Ringkasan data persediaan barang Toko Sinar Plastik.</p>

    <div class="card">
        <h3>Total Barang</h3>
        <h2>{{ $totalProducts }}</h2>
    </div>

    <div class="card">
        <h3>Total Stok Masuk</h3>
        <h2>{{ $totalStockIn }}</h2>
    </div>

    <div class="card">
        <h3>Total Stok Keluar</h3>
        <h2>{{ $totalStockOut }}</h2>
    </div>

    <div class="card">
        <h3>Stok Terendah</h3>
        <h2>{{ $lowStockProducts }}</h2>
        <p>Barang dengan stok kurang dari atau sama dengan batas minimum.</p>
    </div>

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