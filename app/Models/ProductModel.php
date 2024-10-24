<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_sku',
        'product_name',
        'weight',
        'img',
    ];

    // Relationship with Stock
    public function stocks()
    {
        return $this->hasMany(StockModel::class, 'product_id');
    }
}