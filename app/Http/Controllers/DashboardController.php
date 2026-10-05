<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Sale;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic totals
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        // Low stock products
        $lowStockProducts = Product::whereColumn(
            'quantity',
            '<=',
            'minimum_stock'
        )->count();

        // Today's sales
        $todaySales = Sale::whereDate('date', today())
            ->get()
            ->sum(function ($sale) {
                return $sale->quantity * $sale->selling_price;
            });

        // Today's profit
        $todayProfit = Sale::whereDate('date', today())
            ->get()
            ->sum(function ($sale) {
                return $sale->quantity *
                    ($sale->selling_price - $sale->buying_price);
            });

        // Recent sales
        $recentSales = Sale::with('product')
            ->latest('date')
            ->take(5)
            ->get();

        // Recent purchases
        $recentPurchases = Purchase::with(['product', 'supplier'])
            ->latest('date')
            ->take(5)
            ->get();

        // Low stock products list
        $lowStockList = Product::whereColumn(
            'quantity',
            '<=',
            'minimum_stock'
        )
        ->orderBy('quantity')
        ->take(5)
        ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'lowStockProducts',
            'todaySales',
            'todayProfit',
            'recentSales',
            'recentPurchases',
            'lowStockList'
        ));
    }
}
