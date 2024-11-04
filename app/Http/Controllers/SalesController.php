<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionModel;


class SalesController extends Controller
{
    public function index()
    {
        $transactions = TransactionModel::with('items')->get();
        return view('cashier.pages.sales.index', compact('transactions'));

    }
}