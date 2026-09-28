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

<<<<<<< HEAD
Route::resource('products', ProductController::class);
=======
Route::resource('product', ProductController::class);
>>>>>>> 535a3560ad0e486c80f4f76e7ee6e7c7d7fd4b0f

Route::resource('suppliers', SupplierController::class);

Route::resource('purchases', PurchaseController::class)
    ->only(['index', 'create', 'store', 'show']);

Route::resource('sales', SaleController::class)
    ->only(['index', 'create', 'store', 'show']);
