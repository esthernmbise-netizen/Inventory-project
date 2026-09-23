<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product')
            ->latest('date')
            ->latest()
            ->get();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('quantity', '>', 0)
            ->orderBy('name')
            ->get();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
        ]);

        DB::transaction(function () use ($validated) {

            $product = Product::lockForUpdate()
                ->findOrFail($validated['product_id']);

            if ($product->quantity < $validated['quantity']) {
                abort(422, 'Not enough stock for this sale.');
            }

            Sale::create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'selling_price' => $validated['selling_price'],
                'buying_price' => $product->buying_price,
                'date' => $validated['date'],
            ]);

            $product->decrement(
                'quantity',
                $validated['quantity']
            );
        });

        return redirect()
            ->route('sales.index')
            ->with(
                'success',
                'Sale recorded and stock decreased.'
            );
    }

    public function show(Sale $sale)
    {
        $sale->load('product');

        return view('sales.show', compact('sale'));
    }
}