<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total semua data barang yang terdaftar.
        $totalProducts = Product::count();

        // Menjumlahkan seluruh quantity dari transaksi barang masuk.
        $totalStockIn = StockTransaction::where('type', 'masuk')->sum('quantity');

        // Menjumlahkan seluruh quantity dari transaksi barang keluar.
        $totalStockOut = StockTransaction::where('type', 'keluar')->sum('quantity');

        // Menghitung barang yang stoknya sudah mencapai atau di bawah batas minimum.
        $lowStockProducts = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

        // Mengambil satu barang dengan jumlah stok paling tinggi.
        $highestStockProduct = Product::orderBy('stock', 'desc')->first();

        // Mengirim semua data ringkasan ke halaman dashboard.
        return view('dashboard.index', compact(
            'totalProducts',
            'totalStockIn',
            'totalStockOut',
            'lowStockProducts',
            'highestStockProduct'
        ));
    }
}
