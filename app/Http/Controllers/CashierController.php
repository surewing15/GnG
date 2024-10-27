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

        $cartItems = session()->get('cart', []);
        $grandTotal = array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['quantity'] * $item['price']);
        }, 0);

        return view('cashier.pages.pos.pos', compact('products', 'category', 'categories', 'cartItems', 'grandTotal'));

    }

    public function addToCart(Request $request)
    {
        $product = ProductModel::find($request->product_id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }


        $cart = session()->get('cart', []);


        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity'] += 1;
        } else {

            $cart[$product->product_id] = [
                "name" => $product->product_sku,
                "quantity" => 1,
                "price" => $product->price ?? 0,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Product added to cart successfully']);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        \Log::info('Cart Data:', $cart);

        return response()->json(['cart' => $cart]);
    }

    public function resetCart()
    {

        session()->forget('cart');

        return response()->json(['success' => 'Cart has been reset successfully']);
    }

    public function update(Request $request)
    {

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {

            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['price'] = $request->price;
            session()->put('cart', $cart);

            return response()->json(['success' => 'Cart updated successfully']);
        }

                return response()->json(['error' => 'Item not found'], 404);
    }
    


    public function order()
    {
        return view('cashier.pages.pos.order');
    }
}