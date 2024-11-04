<?php
// app/Http/Controllers/TransactionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionModel;
use App\Models\TransactionItemModel;
use DB;

class TransactionController extends Controller
{

// app/Http/Controllers/TransactionController.php

public function store(Request $request)
{
    $request->validate([
        'items' => 'required|array',
        'items.*.product_id' => 'required|integer',
        'items.*.kilos' => 'required|numeric',
        'items.*.price_per_kilo' => 'required|numeric',
        'items.*.total' => 'required|numeric',
    ]);


    DB::beginTransaction();

    try {
        $transaction = TransactionModel::create([
            'date' => $request->input('date'),
            'receipt_id' => $request->input('receipt_id'),
            'customer_name' => $request->input('customer_name'),
            'phone' => $request->input('phone'),
            'total_amount' => $request->input('total_amount')
        ]);

        foreach ($request->input('items') as $itemData) {
            TransactionItemModel::create([
                'transaction_id' => $transaction->transaction_id,
                'product_id' => $itemData['product_id'],
                'kilos' => $itemData['kilos'],
                'price_per_kilo' => $itemData['price_per_kilo'],
                'total' => $itemData['total']
            ]);
        }

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Transaction saved successfully!'], 201);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Failed to save transaction: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to save transaction', 'details' => $e->getMessage()], 500);
    }
}


}