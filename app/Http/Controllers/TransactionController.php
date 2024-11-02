<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|string|unique:tbl_transaction,transaction_id',
            'customer_name' => 'nullable|string|max:255', // Changed to nullable
            'transaction_date' => 'required|date',
            'master_stock_id' => 'required|array|min:1', // Ensure it's an array with at least one item
            'total_kilos' => 'required|array|min:1',
            'price' => 'required|numeric',
            'phone' => 'nullable|string|max:15', // Changed to nullable
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }


        // Save transaction to database
        try {
            $transaction = new TransactionModel();
            $transaction->transaction_id = $request->transaction_id;
            $transaction->customer_name = $request->customer_name;
            $transaction->transaction_date = $request->transaction_date;
            $transaction->master_stock_id = json_encode($request->master_stock_id); // Store as JSON
            $transaction->total_kilos = json_encode($request->total_kilos); // Store as JSON
            $transaction->price = $request->price;
            $transaction->phone = $request->phone;

            $transaction->save();

            return response()->json(['success' => true, 'message' => 'Transaction saved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save transaction.'], 500);
        }
    }
}