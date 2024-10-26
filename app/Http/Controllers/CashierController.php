<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\StockModel;

class CashierController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductModel::getCategoryOptions();
        $category = $request->input('category');

        if ($category) {
            $products = ProductModel::where('category', $category)
                ->with('stock')
                ->get();
        } else {
            $products = ProductModel::with('stock')->get();
        }

        $products->each(function ($product) {
            $product->total_stock = $product->stock->sum('stock_quantity');
        });

        return view('cashier.pages.pos.pos', compact('products', 'category', 'categories'));
    }

    public function order()
    {
        return view('cashier.pages.pos.order');
    }

}