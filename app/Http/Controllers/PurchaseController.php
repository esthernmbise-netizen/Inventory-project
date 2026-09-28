<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
>>>>>>> 535a3560ad0e486c80f4f76e7ee6e7c7d7fd4b0f

class PurchaseController extends Controller
{
    /**
<<<<<<< HEAD
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
=======
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
>>>>>>> 535a3560ad0e486c80f4f76e7ee6e7c7d7fd4b0f
