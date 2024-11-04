<?php

namespace App\Http\Controllers;

use App\Models\MasterStockModel;
use App\Models\TransactionModel;
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

        // Fetch all stock information grouped by product_id and sum total_all_kilos
        $stockTotals = MasterStockModel::select('product_id')
            ->selectRaw('SUM(total_all_kilos) as total_kilos')
            ->groupBy('product_id')
            ->pluck('total_kilos', 'product_id');

        // Assign the total kilos to each product
        $products->each(function ($product) use ($stockTotals) {
            $product->total_kilos = $stockTotals[$product->product_id] ?? 0;
        });

        $cartItems = session()->get('cart', []);
        $grandTotal = array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['quantity'] * $item['price']);
        }, 0);

        return view('cashier.pages.pos.pos', compact('products', 'category', 'categories', 'cartItems', 'grandTotal'));
    }



    public function addToCart(Request $request)
    {
        // Check if the product exists
        $product = ProductModel::find($request->product_id);
        if (!$product) {
            \Log::error('Product not found', ['product_id' => $request->product_id]);
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Sum up all total_all_kilos values for the same product_id to get the total stock available
        $totalKilosAvailable = MasterStockModel::where('product_id', $product->product_id)->sum('total_all_kilos');

        if ($totalKilosAvailable <= 0) {
            \Log::error('Out of stock', ['product_id' => $product->product_id, 'total_kilos' => $totalKilosAvailable]);
            return response()->json(['error' => 'Product is out of stock'], 400);
        }

        // Retrieve the cart from session or initialize it
        $cart = session()->get('cart', []);

        // Add to or update the product quantity in the cart
        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity'] += 1;
        } else {
            $cart[$product->product_id] = [
                "name" => $product->product_sku,
                "quantity" => 1,
                "price" => $product->price ?? 0,
            ];
        }

        // Deduct 1 kilo from the stock
        $remainingKilosToDeduct = 1;
        $masterStocks = MasterStockModel::where('product_id', $product->product_id)
            ->where('total_all_kilos', '>', 0)
            ->orderBy('master_stock_id')
            ->get();

        foreach ($masterStocks as $masterStock) {
            if ($remainingKilosToDeduct <= 0)
                break;

            if ($masterStock->total_all_kilos >= $remainingKilosToDeduct) {
                $masterStock->total_all_kilos -= $remainingKilosToDeduct;
                $masterStock->save();
                $remainingKilosToDeduct = 0;
            } else {
                $remainingKilosToDeduct -= $masterStock->total_all_kilos;
                $masterStock->total_all_kilos = 0;
                $masterStock->save();
            }
        }

        // Calculate the updated total kilos for the product after deduction
        $updatedTotalKilos = MasterStockModel::where('product_id', $product->product_id)->sum('total_all_kilos');

        // Update the session cart
        session()->put('cart', $cart);

        \Log::info('Product added to cart', ['cart' => $cart]);

        // Return success response along with updated total kilos
        return response()->json([
            'success' => 'Product added to cart successfully',
            'updatedTotalKilos' => $updatedTotalKilos,
            'product_id' => $product->product_id
        ]);
    }





    public function showCart()
    {
        $cart = session()->get('cart', []);
        \Log::info('Cart Data:', $cart);

        return response()->json(['cart' => $cart]);
    }

    public function resetCart()
    {
        // Retrieve the cart from session
        $cart = session()->get('cart', []);

        // Restore stock for each product in the cart
        foreach ($cart as $productId => $item) {
            $quantityToRestore = $item['quantity'];

            // Find all stock entries for this product_id
            $masterStocks = MasterStockModel::where('product_id', $productId)
                ->orderBy('master_stock_id')
                ->get();

            foreach ($masterStocks as $masterStock) {
                if ($quantityToRestore <= 0)
                    break;

                // Restore stock by distributing the quantity across entries
                $masterStock->total_all_kilos += $quantityToRestore;
                $masterStock->save();
                $quantityToRestore = 0;  // Ensure restoration is applied only once
            }
        }

        // Clear the cart from session
        session()->forget('cart');

        return response()->json(['success' => 'Cart has been reset and stock has been restored successfully']);
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

    public function addTransaction(Request $request)
    {
        try {
            // Retrieve request data
            $productId = $request->input('product_id');
            $customerName = $request->input('customer_name');
            $totalKilosArray = $request->input('total_kilos');
            $totalKilos = array_sum($totalKilosArray); // Sum the total kilos array
            $price = $request->input('price');
            $phone = $request->input('phone');
            $transactionDate = now();

            // Save the transaction
            $transaction = new TransactionModel();
            $transaction->customer_name = $customerName;
            $transaction->transaction_date = $transactionDate;
            $transaction->total_kilos = $totalKilos; // Save summed total kilos
            $transaction->price = $price;
            $transaction->phone = $phone;
            $transaction->save();

            return response()->json(['success' => true, 'message' => 'Transaction added successfully.']);
        } catch (\Exception $e) {
            \Log::error('Failed to save transaction: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to save transaction.'], 500);
        }
    }


    public function order()
    {
        return view('cashier.pages.pos.order');
    }
    public function completePurchase(Request $request)
    {
        $productId = $request->input('product_id');
        $kilos = $request->input('total_kilos');

        // Fetch the product
        $product = ProductModel::find($productId);

        // Deduct kilos from product stock
        $product->total_kilos -= $kilos;
        $product->save();

        // Add transaction to the database
        TransactionModel::create([
            'product_id' => $productId,
            'customer_name' => $request->input('customer_name'),
            'kilos' => $kilos,
            'price' => $request->input('price'),
            'phone' => $request->input('phone')
        ]);

        return response()->json(['success' => 'Purchase completed successfully']);
    }
    public function updateCart(Request $request)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$request->id])) {
            // Update quantity and price
            $cart[$request->id]['quantity'] = $request->quantity;
            $cart[$request->id]['price'] = $request->price;

            // Save updated cart back to the session
            session()->put('cart', $cart);

            return response()->json(['success' => 'Cart updated successfully']);
        }

        return response()->json(['error' => 'Item not found in cart'], 404);
    }



}