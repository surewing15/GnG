<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class AproductController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = ProductModel::all();

        // Pass the products to the view
        return view('admin.pages.product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'p_name' => 'required|string|max:255',
            'p_sku' => 'required|string|max:100',
            'p_weight' => 'required|integer|min:1',
            'p_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if provided
        $imagePath = null; // Default null in case no image is uploaded
        if ($request->hasFile('p_image')) {
            $imagePath = $request->file('p_image')->store('products', 'public'); // Stores in 'storage/app/public/products'
        }

        // Create a new product instance
        $product = new ProductModel();
        $product->product_name = $validatedData['p_name'];
        $product->product_sku = $validatedData['p_sku'];
        $product->weight = $validatedData['p_weight'];
        $product->img = $imagePath; // Store image path or null if no image uploaded
        $product->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added successfully.');
    }
}