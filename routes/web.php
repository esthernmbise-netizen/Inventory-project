<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


// ===============================
// GUEST ROUTES
// ===============================

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

    // Registration
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.submit');
});


// ===============================
// PROTECTED ROUTES
// ===============================

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');


    // Home
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });


    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
     ->name('dashboard');


    // Categories
    Route::resource('categories', CategoryController::class);


    // Products
    Route::resource('products', ProductController::class);

    Route::resource('product', ProductController::class);


    // Suppliers
    Route::resource('suppliers', SupplierController::class);


    // Purchases
    Route::resource('purchases', PurchaseController::class)
        ->only(['index', 'create', 'store', 'show']);


    // Sales
    Route::resource('sales', SaleController::class)
        ->only(['index', 'create', 'store', 'show']);
});
