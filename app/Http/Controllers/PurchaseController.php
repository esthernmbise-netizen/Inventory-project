<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display all purchases.
     */
    public function index()
    {
        $purchases = Purchase::with([
            'supplier',
            'product'
        ])
        ->latest('date')
        ->latest()
        ->get();

        return view('purchases.index', compact('purchases'));
    }


    /**
     * Show the form for creating a new purchase.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        $suppliers = Supplier::orderBy('name')->get();

        return view('purchases.create', compact(
            'products',
            'suppliers'
        ));
    }


    /**
     * Store a new purchase.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'buying_price' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
        ]);

        DB::transaction(function () use ($validated) {

            // Create the purchase record
            Purchase::create($validated);

            // Find the product
            $product = Product::lockForUpdate()
                ->findOrFail($validated['product_id']);

            // Increase the current stock
            $product->increment(
                'quantity',
                $validated['quantity']
            );

            // Update the current buying price
            $product->update([
                'buying_price' => $validated['buying_price'],
            ]);
        });

        return redirect()
            ->route('purchases.index')
            ->with(
                'success',
                'Purchase recorded and stock increased.'
            );
    }


    /**
     * Display one purchase.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'product'
        ]);

        return view('purchases.show', compact('purchase'));
    }
}