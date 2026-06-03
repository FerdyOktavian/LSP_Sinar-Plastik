<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $query->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/categories')->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function edit($id)
{
    $category = Category::findOrFail($id);

    return view('categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|max:100',
    ]);

    $category = Category::findOrFail($id);

    $category->update([
        'name' => $request->name,
    ]);

    return redirect('/categories')->with('success', 'Data kategori berhasil diubah.');
}

public function destroy($id)
{
    $used = Product::where('id_category', $id)->count();

    if ($used > 0) {
        return redirect('/categories')->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh data barang.');
    }

    $category = Category::findOrFail($id);
    $category->delete();

    return redirect('/categories')->with('success', 'Data kategori berhasil dihapus.');
}
}