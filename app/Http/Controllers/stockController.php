<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockModel;
use App\Models\ProductModel;
use App\Models\MasterStockModel;

class stockController extends Controller
{
    public function index()
    {

        $products = ProductModel::all();


        return view('clerk.pages.stocks.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:tbl_product,product_id',
            'bags' => 'required|integer|min:0',
            'heads' => 'required|integer|min:0',
            'kilos' => 'required|numeric|min:0',
        ]);

        StockModel::create([
            'product_id' => $request->input('product_id'),
            'stock_bags' => $request->input('bags'),
            'stocks_heads' => $request->input('heads'),
            'stock_kilos' => $request->input('kilos'),
        ]);


        MasterStockModel::create([
            'product_id' => $request->input('product_id'),
            'total_all_kilos' => $request->input('kilos'),
        ]);

        return redirect()->back()->with('success', 'Stock added successfully and master stock updated.');
    }




}
