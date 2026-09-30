<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
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

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('purchases.create', compact(
            'products',
            'suppliers'
        ));
    }

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

            Purchase::create($validated);

            $product = Product::lockForUpdate()
                ->findOrFail($validated['product_id']);

            $product->increment(
                'quantity',
                $validated['quantity']
            );

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

    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'product'
        ]);

        return view('purchases.show', compact('purchase'));
    }
}