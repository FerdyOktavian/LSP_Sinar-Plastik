<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $table = 'stock_transactions';
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'id_product',
        'date',
        'type',
        'quantity',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}