<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_stock'; // Ensure this matches the actual table name
    protected $primaryKey = 'stock_id'; // Ensure this matches the primary key column

    protected $fillable = [
        'product_id',
        'stock_quantity',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'product_id');
    }


    protected static function booted()
    {
        static::updated(function ($stock) {

            StockHistoryModel::create([
                'stock_id' => $stock->stock_id,
                'stock_quantity' => $stock->stock_quantity,
                'updated_at' => now(),
            ]);
        });
    }
    public function stockHistory()
    {
        return $this->hasMany(StockHistoryModel::class,  'stock_id');
    }
}