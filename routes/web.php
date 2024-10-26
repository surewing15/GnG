<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcustomerController;
use App\Http\Controllers\AorderController;
use App\Http\Controllers\AproductController;
use App\Http\Controllers\AstocksController;
use App\Http\Controllers\CstocksController;
use App\Http\Controllers\AexpensesController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\CashierController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', [AdminController::class, 'index']);
    Route::get('/admin/customer', [AcustomerController::class, 'index']);
    Route::get('/admin/edit', [AcustomerController::class, 'edit']);
    Route::get('/admin/order', [AorderController::class, 'index']);
    Route::get('/admin/product', [AproductController::class, 'index']);
    Route::get('/admin/stocks', [AstocksController::class, 'index']);

    Route::get('/admin/stocks', [AstocksController::class, 'index']);

    // Route::get('/admin/stocks', [AstocksController::class, 'create']);
    Route::post('/admin/stocks', [AstocksController::class, 'store'])->name('stocks.store');

    // Route for displaying stock history
    Route::get('/admin/history', [StockHistoryController::class, 'showStockHistory'])->name('stock.history');

    // Route for updating stock

    // Route::post('/update-stock/{stock_id}', [StockHistoryController::class, 'updateStock'])->name('stock.update');


    Route::get('/admin/expenses', [AexpensesController::class, 'index'])->name('expenses.index');
    Route::post('/admin/expenses', [AexpensesController::class, 'store'])->name('expenses.store');

    // Route::get('/admin/order/history', function () {
    //     return view('admin.pages.history.order-history');
    // });

    // Route::get('/admin/history', function () {
    //     return view('admin.pages.history.stock-history');
    // });

    Route::get('/clerk/stocks', [CstocksController::class, 'index']);

    Route::get('/clerk/products', function () {
        return view('clerk.pages.products.index');
    });

    Route::get('/customer/dashboard', function () {
        return view('user.index');
    });

    Route::get('/customer/invoice', function () {
        return view('user.pages.invoice');
    });

    Route::post('/product', [AproductController::class, 'store'])->name('product.store');
    Route::resource('customers', AcustomerController::class);



    // Route::get('/stocks', [AstocksController::class, 'index'])->name('stocks.index');
    // Route::get('/stocks/create', [AstocksController::class, 'create'])->name('stocks.create');
    // Route::post('admin/stocks', [AstocksController::class, 'store'])->name('stocks.store');

    // Route::resource('stocks', AstocksController::class);

    Route::get('/cashier/pos', [CashierController::class, 'index'])->name('cashier.index');

    Route::get('/cashier/order ', [CashierController::class, 'order']);


    // Route::get('/cashier/wholesales/report ',[CashierReportController::class,'wholesale']);
    // Route::get('/cashier/denomination/report ',[CashierReportController::class,'denomination']);
    // Route::get('/cashier/eggsales/report ',[CashierReportController::class,'eggsales']);
    // Route::get('/cashier/retail/report ',[CashierReportController::class,'salesretail']);



});