<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {
            $query->where('code', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_category' => 'required',
            'code' => 'required|max:20|unique:products,code',
            'name' => 'required|max:100',
            'unit' => 'required|max:20',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'id_category' => $request->id_category,
            'code' => $request->code,
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'minimum_stock' => $request->minimum_stock,
        ]);

        return redirect('/products')->with('success', 'Data barang berhasil ditambahkan.');
    }

        public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_category' => 'required',
            'code' => 'required|max:20|unique:products,code,' . $id . ',id_product',
            'name' => 'required|max:100',
            'unit' => 'required|max:20',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'id_category' => $request->id_category,
            'code' => $request->code,
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'minimum_stock' => $request->minimum_stock,
        ]);

        return redirect('/products')->with('success', 'Data barang berhasil diubah.');
    }

    public function destroy($id)
    {
        $used = StockTransaction::where('id_product', $id)->count();

        if ($used > 0) {
            return redirect('/products')->with('error', 'Barang tidak bisa dihapus karena sudah memiliki riwayat transaksi stok.');
        }

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Data barang berhasil dihapus.');
    }
}