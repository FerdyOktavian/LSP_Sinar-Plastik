<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalStockIn = StockTransaction::where('type', 'masuk')->sum('quantity');

        $totalStockOut = StockTransaction::where('type', 'keluar')->sum('quantity');

        $lowStockProducts = Product::whereColumn('stock', '<=', 'minimum_stock')->count();

        $highestStockProduct = Product::orderBy('stock', 'desc')->first();

        return view('dashboard.index', compact(
            'totalProducts',
            'totalStockIn',
            'totalStockOut',
            'lowStockProducts',
            'highestStockProduct'
        ));
    }
}