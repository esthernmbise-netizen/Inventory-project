<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\category;

class SuperAdminController extends Controller
{
    public function index()
    {
        abort_unless(
            auth()->check() &&
            auth()->user()->role === 'super_admin',
            403,
            'You are not authorized to access this dashboard.'
        );

        return view('superadmin.dashboard', [
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
            'totalCategories' => category::count(),
            'totalSuppliers' => Supplier::count(),
        ]);
    }
}
