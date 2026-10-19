<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;

// Guests: login and registration
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.submit');
});

// Logged-in users: verification, resend email, and logout
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');


  Route::get('/email/verify/{id}/{hash}', function (
    \Illuminate\Foundation\Auth\EmailVerificationRequest $request
) {
    $request->fulfill();

    $user = $request->user();

    if ($user->role === 'super_admin') {
        return redirect()->route('superadmin.dashboard')
            ->with('success', 'Email verified successfully!');
    }

    return redirect()->route('dashboard')
        ->with('success', 'Email verified successfully!');
})->middleware(['signed', 'throttle:6,1'])
  ->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'A new verification link has been sent to your email.'
        );
    })->middleware('throttle:6,1')->name('verification.send');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});

// Inventory pages: login AND verified email required
Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/superadmin', [SuperAdminController::class, 'index'])
    ->name('superadmin.dashboard');

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::resource('product', ProductController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('purchases', PurchaseController::class)
        ->only(['index', 'create', 'store', 'show']);
    
    Route::resource('sales', SaleController::class)
        ->only(['index', 'create', 'store', 'show']);
});
