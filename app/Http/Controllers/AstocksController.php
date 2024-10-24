<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StockModel;
use App\Models\ProductModel;
use App\Models\StockHistoryModel;
use Illuminate\Http\Request;

class AstocksController extends Controller
{
    /**
     * Display a listing of the stocks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all stocks with their associated product information using eager loading
        $stocks = StockModel::with('product')->get();
        $products = ProductModel::all(); // Fetch all products

        // Pass the stocks and products data to the view
        return view('admin.pages.stocks.index', compact('stocks', 'products'));
    }

    /**
     * Store a newly created stock in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
                $validatedData = $request->validate([
            'product_id' => 'required|exists:tbl_product,product_id',
            'stock_quantity' => 'required|integer|min:15',
        ]);

        try {

            $product = ProductModel::where('product_id', $validatedData['product_id'])->first();

            $stock = StockModel::create([
                'product_id' => $validatedData['product_id'],
                'stock_quantity' => $validatedData['stock_quantity'],
            ]);

            $this->forwardToHistory($stock);

            return redirect()->back()->with('success', 'Stock information saved successfully.');
        } catch (\Exception $e) {
            \Log::error('Error saving stock information: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the stock information.');
        }
    }

    /**
     *
     *
     * @param  \App\Models\StockModel  $stock
     * @return void
     */
    private function forwardToHistory($stock)
    {
        // Create a new StockHistory entry based on the stock information
        StockHistoryModel::create([
            'stock_id' => $stock->stock_id,
            'stock_quantity' => $stock->stock_quantity, // Add quantity to history
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}