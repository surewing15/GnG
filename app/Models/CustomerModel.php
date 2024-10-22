<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    // Define the table name if it differs from the default
    protected $table = 'tbl_cust';

    // Specify which columns are mass assignable
    protected $fillable = [
        'Cust_name',
        'Cust_address',
        'phone_number'
    ];
}