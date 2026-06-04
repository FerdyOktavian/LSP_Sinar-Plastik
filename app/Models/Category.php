<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Nama tabel yang digunakan model Category.
    protected $table = 'categories';

    // Primary key khusus karena tabel memakai id_category, bukan id.
    protected $primaryKey = 'id_category';

    // Kolom yang boleh diisi saat membuat atau mengubah data kategori.
    protected $fillable = [
        'name',
    ];
}
