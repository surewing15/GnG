<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StockHistoryModel;
use App\Models\StockModel;
use Illuminate\Http\Request;

class StockHistoryController extends Controller
{
    /**
     * Display the stock history.
     *
     * @return \Illuminate\View\View
     */
    public function showStockHistory()
    {
        // Fetch all stocks with their history using eager loading
        $stocks = StockModel::with('stockHistory')->get();

        // Pass the stocks data to the view
        return view('admin.pages.history.stock-history', compact('stocks'));
    }

    /**
     * Update the stock and log the change to the stock history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $stock_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStock(Request $request, $stock_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        try {
            // Find the stock record
            $stock = StockModel::findOrFail($stock_id);

            // Update the stock quantity
            $stock->stock_quantity = $validatedData['quantity'];
            $stock->save();

            // Log the change in the stock history table
            StockHistoryModel::create([
                'stock_id' => $stock->stock_id,
                'product_id' => $stock->product_id,
                'stock_quantity' => $stock->stock_quantity,
                'change_reason' => 'Stock updated manually', // Optional, add more details if needed
                'created_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Stock updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating stock: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the stock.');
        }
    }
}