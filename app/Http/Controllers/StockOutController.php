<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        // Mengambil riwayat transaksi stok keluar beserta data barangnya.
        $transactions = StockTransaction::with('product')
            ->where('type', 'keluar')
            ->get();

        return view('stock_out.index', compact('transactions'));
    }

    public function create()
    {
        // Mengambil semua barang agar bisa dipilih saat mencatat stok keluar.
        $products = Product::all();

        return view('stock_out.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input stok keluar agar data barang, tanggal, dan jumlahnya benar.
        $request->validate([
            'id_product' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
        ]);

        // Mengambil data barang yang stoknya akan dikurangi.
        $product = Product::findOrFail($request->id_product);

        // Mencegah jumlah barang keluar lebih besar dari stok yang tersedia.
        if ($request->quantity > $product->stock) {
            return back()
                ->withInput()
                ->with('error', 'Jumlah barang keluar tidak boleh melebihi stok saat ini.');
        }

        // Menyimpan catatan transaksi dengan tipe keluar sebagai riwayat stok.
        StockTransaction::create([
            'id_product' => $request->id_product,
            'date' => $request->date,
            'type' => 'keluar',
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        // Mengurangi stok barang sesuai quantity yang keluar.
        $product->stock = $product->stock - $request->quantity;
        $product->save();

        return redirect('/stock-out')->with('success', 'Data barang keluar berhasil disimpan.');
    }
}
