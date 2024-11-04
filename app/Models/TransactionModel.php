<?php

// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_transactions';
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'date',
        'receipt_id',
        'customer_name',
        'phone',
        'total_amount'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItemModel::class, 'transaction_id', 'transaction_id');
    }
}