<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    // Nama tabel yang menyimpan riwayat transaksi stok.
    protected $table = 'stock_transactions';

    // Primary key khusus untuk tabel stock_transactions.
    protected $primaryKey = 'id_transaction';

    // Kolom yang boleh diisi saat mencatat stok masuk atau keluar.
    protected $fillable = [
        'id_product',
        'date',
        'type',
        'quantity',
        'description',
    ];

    public function product()
    {
        // Setiap transaksi stok terhubung ke satu data barang.
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
