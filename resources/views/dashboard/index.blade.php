@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-desc">Ringkasan kondisi persediaan barang pada Toko Sinar Plastik.</p>
    </div>

    {{-- Kumpulan kartu ringkasan untuk membaca kondisi persediaan dengan cepat. --}}
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="label">Total Barang</div>
            <div class="number">{{ $totalProducts }}</div>
            <div class="note">Jumlah barang yang terdaftar di sistem.</div>
        </div>

        <div class="stat-card">
            <div class="label">Total Stok Masuk</div>
            <div class="number">{{ $totalStockIn }}</div>
            <div class="note">Akumulasi barang masuk dari seluruh transaksi.</div>
        </div>

        <div class="stat-card">
            <div class="label">Total Stok Keluar</div>
            <div class="number">{{ $totalStockOut }}</div>
            <div class="note">Akumulasi barang keluar dari seluruh transaksi.</div>
        </div>

        <div class="stat-card">
            <div class="label">Stok Rendah</div>
            <div class="number">{{ $lowStockProducts }}</div>
            <div class="note">Barang yang stoknya sudah mencapai batas minimum.</div>
        </div>

        <div class="stat-card">
            <div class="label">Stok Tertinggi</div>

            {{-- Jika ada data barang, tampilkan barang dengan stok paling tinggi. --}}
            @if ($highestStockProduct)
                <div class="number" style="font-size: 23px;">
                    {{ $highestStockProduct->name }}
                </div>
                <div class="note">Jumlah stok: {{ $highestStockProduct->stock }}</div>
            @else
                <div class="number">0</div>
                <div class="note">Belum ada data barang.</div>
            @endif
        </div>
    </div>

    <div class="card">
        <h3>Informasi Sistem</h3>
        <p>
            Dashboard digunakan untuk menampilkan informasi singkat mengenai data barang,
            transaksi stok, stok rendah, dan barang dengan stok tertinggi.
        </p>
    </div>
@endsection
