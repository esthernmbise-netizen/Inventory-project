<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::resource('product', ProductController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('purchases', PurchaseController::class)
    ->only(['index', 'create', 'store', 'show']);

Route::resource('sales', SaleController::class)
    ->only(['index', 'create', 'store', 'show']);
