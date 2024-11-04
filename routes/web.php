<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcustomerController;
use App\Http\Controllers\AorderController;
use App\Http\Controllers\AproductController;
use App\Http\Controllers\AstocksController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\AexpensesController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ApurchaseHistoryController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\WholesaleReportController;
use App\Http\Controllers\DenominationReportController;
use App\Http\Controllers\CTruckingController;
use App\Http\Controllers\CTruckingInvoiceController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AdriverController;
use App\Http\Controllers\AhelperController;
use App\Http\Controllers\AtruckController;
use App\Http\Controllers\AexpensesReportController;
use App\Http\Controllers\TransactionController;
// use App\Http\Controllers\CashierRecieptController;


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


    Route::get('/admin/inventory/reports', [InventoryReportController::class, 'index']);
    Route::get('/admin/wholesale/reports', [WholesaleReportController::class, 'index']);
    Route::get('/admin/denomination/reports', [DenominationReportController::class, 'index']);
    Route::get('/admin/expenses/reports', [AexpensesReportController::class, 'index']);

    Route::get('/total-sales', [AdminController::class, 'getTotalSales']);
    Route::get('/sales-data', [AdminController::class, 'getSalesData']);


    // Route::get('/admin/stocks', [AstocksController::class, 'create']);
    Route::post('/admin/stocks', [AstocksController::class, 'store'])->name('stocks.store');

    // Route for displaying stock history
    Route::get('/admin/history', [StockHistoryController::class, 'showStockHistory'])->name('stock.history');
    Route::get('/admin/purchase/history', [ApurchaseHistoryController::class, 'index'])->name('stock.history');

    // Route for updating stock

    // Route::post('/update-stock/{stock_id}', [StockHistoryController::class, 'updateStock'])->name('stock.update');


    Route::get('/cashier/expenses', [AexpensesController::class, 'index'])->name('expenses.index');
    Route::post('/cashier/expenses', [AexpensesController::class, 'store'])->name('expenses.store');
    Route::prefix('admin')->group(function () {
        Route::resource('driver', AdriverController::class);
    });
    Route::prefix('admin')->group(function () {
        Route::resource('helper', AhelperController::class);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('truck', AtruckController::class);
    });

    // Route::get('/admin/order/history', function () {
    //     return view('admin.pages.history.order-history');
    // });

    // Route::get('/admin/history', function () {
    //     return view('admin.pages.history.stock-history');
    // });


    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');

    Route::resource('stocks', stockController::class);
    Route::post('/clerk/store', [stockController::class, 'store'])->name('stocks.store');

    Route::get('/stocks', [stockController::class, 'index']);

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




    // Route to display the stocks page
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

    // Route to handle the form submission for stocks
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');


    // Route::get('/stocks', [AstocksController::class, 'index'])->name('stocks.index');
    // Route::get('/stocks/create', [AstocksController::class, 'create'])->name('stocks.create');
    // Route::post('admin/stocks', [AstocksController::class, 'store'])->name('stocks.store');

    // Route::resource('stocks', AstocksController::class);

    Route::get('/cashier/pos', [CashierController::class, 'index'])->name('cashier.index');

    Route::get('/cashier/order ', [CashierController::class, 'order']);
    Route::post('/cashier/add-to-cart', [CashierController::class, 'addToCart'])->name('cashier.addToCart');


    // CashierController routes
    Route::post('/cashier/update-cart-quantity', [CashierController::class, 'updateCartQuantity'])->name('cashier.updateCart');
    Route::post('/cashier/add-product', [CashierController::class, 'addProduct'])->name('cashier.addProduct');

    // CTruckingController routes with consistent cashier prefix
    Route::get('/cashier/trucking', [CTruckingController::class, 'index'])->name('cashier.trucking.index');
    Route::get('/cashier/trucking/create', [CTruckingController::class, 'create'])->name('cashier.trucking.create');
    Route::post('/cashier/trucking', [CTruckingController::class, 'store'])->name('cashier.trucking.store');
    Route::get('/cashier/sales', [SalesController::class, 'index'])->name('sales.index');

    // CTruckingInvoiceController route
    Route::get('/cashier/invoice', [CTruckingInvoiceController::class, 'index'])->name('cashier.invoice.index');


    // Route::get('/cart/receipt', [CashierRecieptController::class, 'index']);




    // Route::post('/cart/add', 'CashierController@addToCart')->name('cart.add');
    // Route::get('/cart', 'CashierController@showCart')->name('cart.show');

    Route::post('/cart/add', [CashierController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CashierController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/reset', [CashierController::class, 'resetCart'])->name('cart.reset');
    Route::post('/cart/update', [CashierController::class, 'update'])->name('cart.update');

    Route::post('/save-transaction', [TransactionController::class, 'store']);
    Route::prefix('cashier')->group(function () {
        Route::post('/transaction/add', [TransactionController::class, 'addTransaction'])->name('transaction.add');
        Route::post('/cart/add', [CashierController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart/show', [CashierController::class, 'showCart'])->name('cart.show');
        Route::post('/cart/update', [CashierController::class, 'updateCart'])->name('cart.update');
        Route::post('/cart/reset', [CashierController::class, 'resetCart'])->name('cart.reset');
    });
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    // Route::get('/cashier/wholesales/report ',[CashierReportController::class,'wholesale']);
    // Route::get('/cashier/denomination/report ',[CashierReportController::class,'denomination']);
    // Route::get('/cashier/eggsales/report ',[CashierReportController::class,'eggsales']);
    // Route::get('/cashier/retail/report ',[CashierReportController::class,'salesretail']);



});