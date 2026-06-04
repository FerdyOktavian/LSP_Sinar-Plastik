<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Nama tabel yang menyimpan data barang.
    protected $table = 'products';

    // Primary key khusus untuk tabel products.
    protected $primaryKey = 'id_product';

    // Kolom yang boleh diisi secara massal dari controller.
    protected $fillable = [
        'id_category',
        'code',
        'name',
        'unit',
        'stock',
        'minimum_stock',
    ];

    public function category()
    {
        // Setiap barang terhubung ke satu kategori melalui id_category.
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
