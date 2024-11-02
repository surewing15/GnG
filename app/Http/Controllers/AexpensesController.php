<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;
class AexpensesController extends Controller
{
    public function index(){

        $expenses = ExpenseModel::all();

        // Pass the expenses data to the view
        return view('cashier.pages.expenses.index', compact('expenses'));
 }
public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'withdraw_by' => 'required|string|max:255',
        'recieve_by' => 'required|string|max:255',
        'expenses_description' => 'required|string|max:255',
        'expenses_amount' => 'required|numeric|min:0',
    ]);

    // Create a new expense record
    ExpenseModel::create([
        'e_description' => $request->input('expenses_description'),
        'e_amount' => $request->input('expenses_amount'),
        'e_withdraw_by' => $request->input('withdraw_by'),
        'e_recieve_by' => $request->input('recieve_by'),
    ]);

    // Redirect or return success response
    return redirect()->back()->with('success', 'Expense created successfully!');
}
}
