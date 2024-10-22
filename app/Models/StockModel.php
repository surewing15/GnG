<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockModel extends Model
{
    use HasFactory;

    protected $fillable = ['stock_name', 'stock_category', 'stock_quantity'];
}