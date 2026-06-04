<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        // Mengambil riwayat transaksi stok masuk beserta data barangnya.
        $transactions = StockTransaction::with('product')
            ->where('type', 'masuk')
            ->get();

        return view('stock_in.index', compact('transactions'));
    }

    public function create()
    {
        // Mengambil semua barang agar bisa dipilih saat mencatat stok masuk.
        $products = Product::all();

        return view('stock_in.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input stok masuk agar barang, tanggal, dan jumlahnya sesuai aturan.
        $request->validate([
            'id_product' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
        ]);

        // Menyimpan catatan transaksi dengan tipe masuk sebagai riwayat stok.
        StockTransaction::create([
            'id_product' => $request->id_product,
            'date' => $request->date,
            'type' => 'masuk',
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        // Menambahkan jumlah stok barang sesuai quantity yang baru masuk.
        $product = Product::findOrFail($request->id_product);
        $product->stock = $product->stock + $request->quantity;
        $product->save();

        return redirect('/stock-in')->with('success', 'Data barang masuk berhasil disimpan.');
    }
}
