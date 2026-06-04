<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data barang bersama kategori untuk halaman persediaan.
        $query = Product::with('category');

        // Jika ada pencarian, filter barang berdasarkan kode atau nama.
        if ($request->search) {
            $query->where('code', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        }

        // Menjalankan query dan mengambil daftar barang yang akan ditampilkan.
        $products = $query->get();

        return view('inventory.index', compact('products'));
    }
}
