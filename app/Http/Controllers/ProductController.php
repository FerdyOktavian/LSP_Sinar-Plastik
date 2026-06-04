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
        // Mengambil data barang sekaligus relasi kategorinya agar tampilan lebih lengkap.
        $query = Product::with('category');

        // Jika ada pencarian, cari barang berdasarkan kode atau nama.
        if ($request->search) {
            $query->where('code', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%');
        }

        // Menjalankan query dan mengambil semua hasil barang.
        $products = $query->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Mengambil semua kategori untuk pilihan saat menambah barang.
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data barang baru, termasuk kode barang yang tidak boleh sama.
        $request->validate([
            'id_category' => 'required',
            'code' => 'required|max:20|unique:products,code',
            'name' => 'required|max:100',
            'unit' => 'required|max:20',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        // Menyimpan data barang baru ke database.
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
        // Mengambil barang yang akan diedit dan daftar kategori untuk pilihan form.
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data update, kode barang boleh sama jika masih milik barang ini.
        $request->validate([
            'id_category' => 'required',
            'code' => 'required|max:20|unique:products,code,' . $id . ',id_product',
            'name' => 'required|max:100',
            'unit' => 'required|max:20',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);

        // Menyimpan perubahan data barang ke database.
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
        // Mengecek apakah barang sudah pernah digunakan dalam transaksi stok.
        $used = StockTransaction::where('id_product', $id)->count();

        // Barang yang punya riwayat transaksi tidak boleh dihapus agar laporan stok tetap benar.
        if ($used > 0) {
            return redirect('/products')->with('error', 'Barang tidak bisa dihapus karena sudah memiliki riwayat transaksi stok.');
        }

        // Jika belum ada transaksi, barang boleh dihapus dari database.
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Data barang berhasil dihapus.');
    }
}
