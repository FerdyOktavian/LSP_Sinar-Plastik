<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('product')
            ->where('type', 'keluar')
            ->get();

        return view('stock_out.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();

        return view('stock_out.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
        ]);

        $product = Product::findOrFail($request->id_product);

        if ($request->quantity > $product->stock) {
            return back()
                ->withInput()
                ->with('error', 'Jumlah barang keluar tidak boleh melebihi stok saat ini.');
        }

        StockTransaction::create([
            'id_product' => $request->id_product,
            'date' => $request->date,
            'type' => 'keluar',
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        $product->stock = $product->stock - $request->quantity;
        $product->save();

        return redirect('/stock-out')->with('success', 'Data barang keluar berhasil disimpan.');
    }
}