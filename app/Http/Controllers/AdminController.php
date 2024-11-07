<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionItemModel;

use Carbon\Carbon;
use App\Models\ExpenseModel;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_type = Auth::user()->usertype;

            $totalSales = $this->getTotalSalesData(); // Total sales
            $salesData = $this->getSalesDataArray(); // Sales data array
            $expenses = ExpenseModel::all(); // Get all expense records

            $totalExpenses = $expenses->sum('e_amount'); // Sum of all expenses

            // Calculate total cash by subtracting expenses from total sales
            $totalCash = $totalSales - $totalExpenses;

            $customers = TransactionModel::select('customer_name', 'receipt_id', 'total_amount')->distinct()->get();
            $totalCustomerCount = TransactionModel::count('customer_name');

            $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
            $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();
            $lastWeekCustomerCount = TransactionModel::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count('customer_name');

            $percentageChange = $lastWeekCustomerCount ? (($totalCustomerCount - $lastWeekCustomerCount) / $lastWeekCustomerCount) * 100 : 0;

            if ($user_type == 'admin') {
                return view('admin.index', [
                    'totalSales' => $totalSales,
                    'totalExpenses' => $totalExpenses,
                    'totalCash' => $totalCash, // Pass total cash to the view
                    'salesData' => $salesData,
                    'expenses' => $expenses, // Pass expenses to the view
                    'totalCustomerCount' => $totalCustomerCount,
                    'percentageChange' => number_format($percentageChange, 2),
                    'customers' => $customers,
                ]);
            } else if ($user_type == 'user') {
                return view('user.index');
            } else if ($user_type == 'clerk') {
                return view('clerk.index');
            } else if ($user_type == 'cashier') {
                return view('cashier.index');
            } else {
                return redirect('/')->with('error', 'Unauthorized access');
            }
        } else {
            return redirect('/login')->with('error', 'Please log in first');
        }
    }





    private function getTotalSalesData()
    {

        return TransactionItemModel::sum('total');
    }

    private function getSalesDataArray()
    {

        $totalSales = TransactionItemModel::sum('total');

        $lastMonth = Carbon::now()->subMonth();
        $lastMonthSales = TransactionItemModel::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total');


        $thisWeek = Carbon::now()->startOfWeek();
        $thisWeekSales = TransactionItemModel::where('created_at', '>=', $thisWeek)
            ->sum('total');


        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();
        $lastWeekSales = TransactionItemModel::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('total');


        $percentageChange = $lastWeekSales ? (($thisWeekSales - $lastWeekSales) / $lastWeekSales) * 100 : 0;

        return [
            'total_sales' => $totalSales,
            'last_month_sales' => $lastMonthSales,
            'this_week_sales' => $thisWeekSales,
            'percentage_change' => $percentageChange,
        ];
    }

}