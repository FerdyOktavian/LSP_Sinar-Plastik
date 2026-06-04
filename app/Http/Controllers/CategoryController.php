<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query awal kategori agar bisa ditambahkan filter pencarian.
        $query = Category::query();

        // Jika ada kata kunci, tampilkan kategori yang namanya mirip dengan pencarian.
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Menjalankan query dan mengambil hasil akhirnya.
        $categories = $query->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validasi nama kategori agar wajib diisi dan tidak terlalu panjang.
        $request->validate([
            'name' => 'required|max:100',
        ]);

        // Menyimpan kategori baru ke database.
        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/categories')->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Mengambil data kategori yang akan diedit berdasarkan id.
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validasi nama kategori sebelum data diperbarui.
        $request->validate([
            'name' => 'required|max:100',
        ]);

        // Mencari kategori yang akan diubah.
        $category = Category::findOrFail($id);

        // Menyimpan perubahan nama kategori ke database.
        $category->update([
            'name' => $request->name,
        ]);

        return redirect('/categories')->with('success', 'Data kategori berhasil diubah.');
    }

    public function destroy($id)
    {
        // Mengecek apakah kategori masih digunakan oleh data barang.
        $used = Product::where('id_category', $id)->count();

        // Kategori yang masih dipakai tidak boleh dihapus agar data barang tetap valid.
        if ($used > 0) {
            return redirect('/categories')->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh data barang.');
        }

        // Jika tidak digunakan, kategori boleh dihapus.
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Data kategori berhasil dihapus.');
    }
}
