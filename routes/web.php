<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AcustomerController;
use App\Http\Controllers\AorderController;
use App\Http\Controllers\AproductController;
use App\Http\Controllers\AstocksController;
use App\Http\Controllers\CstocksController;
use App\Http\Controllers\AexpensesController;


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
    Route::get('/home ',[AdminController::class,'index']);
    Route::get('/admin/customer ',[AcustomerController::class,'index']);
    Route::get('/admin/edit ',[AcustomerController::class,'edit']);
    Route::get('/admin/order ',[AorderController::class,'index']);
    Route::get('/admin/product ',[AproductController::class,'index']);
    Route::get('/admin/stocks ',[AstocksController::class,'index']);
    Route::get('/admin/expenses ',[AexpensesController::class,'index']);

    Route::get('/clerk/stocks ',action: [CstocksController::class,'index']);

    Route::get('/clerk/history', function () {
        return view('clerk.pages.stocks.history');

    });

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



});