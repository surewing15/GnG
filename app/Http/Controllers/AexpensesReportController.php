<?php

namespace App\Http\Controllers;
use App\Models\ExpenseModel;
use Illuminate\Http\Request;

class AexpensesReportController extends Controller
{
    public function index() {
        $expenses = ExpenseModel::all();
        return view('admin.pages.reports.expenses-report', compact('expenses'));
    }

}