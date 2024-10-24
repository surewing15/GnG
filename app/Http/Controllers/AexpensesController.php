<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;
class AexpensesController extends Controller
{
    public function index(){

        $expenses = ExpenseModel::all();

        // Pass the expenses data to the view
        return view('admin.pages.expenses.index', compact('expenses'));
 }
public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'expenses_description' => 'required|string|max:255',
        'expenses_amount' => 'required|numeric|min:0',
    ]);

    // Create a new expense record
    ExpenseModel::create([
        'e_description' => $request->input('expenses_description'),
        'e_amount' => $request->input('expenses_amount'),
    ]);

    // Redirect or return success response
    return redirect()->back()->with('success', 'Expense created successfully!');
}
}