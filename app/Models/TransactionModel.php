<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    protected $table = 'tbl_transaction';
    protected $primaryKey = 'transaction_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'transaction_id',
        'customer_name',
        'transaction_date',
        'master_stock_id',
        'total_kilos',
        'price',
        'phone'
    ];
    protected $casts = [
        'master_stock_id' => 'array',
        'total_kilos' => 'array',
    ];
    public $timestamps = false;
}