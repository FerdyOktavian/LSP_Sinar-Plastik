<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('product')
            ->where('type', 'masuk')
            ->get();

        return view('stock_in.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();

        return view('stock_in.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
        ]);

        StockTransaction::create([
            'id_product' => $request->id_product,
            'date' => $request->date,
            'type' => 'masuk',
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        $product = Product::findOrFail($request->id_product);
        $product->stock = $product->stock + $request->quantity;
        $product->save();

        return redirect('/stock-in')->with('success', 'Data barang masuk berhasil disimpan.');
    }
}