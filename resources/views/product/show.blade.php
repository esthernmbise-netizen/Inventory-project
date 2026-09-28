@extends('layouts.app')

@section('content')

<div class="card">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    ">

        <div>

            <h1>Product Details</h1>

            <p>
                View complete information about this product.
            </p>

        </div>

        <div style="
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        ">

            <a
                href="{{ route('product.edit', $product) }}"
                class="btn"
            >
                Edit Product
            </a>

            <a
                href="{{ route('product.index') }}"
                class="btn btn-secondary"
            >
                ← Back to Products
            </a>

        </div>

    </div>

</div>


<div class="card">

    <h2>Product Information</h2>

    <table>

        <tr>

            <th>Product Name</th>

            <td>
                {{ $product->name }}
            </td>

        </tr>


        <tr>

            <th>Category</th>

            <td>
                {{ $product->category->name }}
            </td>

        </tr>


        <tr>

            <th>Buying Price</th>

            <td>
                TZS
                {{ number_format($product->buying_price, 2) }}
            </td>

        </tr>


        <tr>

            <th>Selling Price</th>

            <td>
                TZS
                {{ number_format($product->selling_price, 2) }}
            </td>

        </tr>


        <tr>

            <th>Current Stock</th>

            <td>
                {{ $product->quantity }}
            </td>

        </tr>


        <tr>

            <th>Minimum Stock Level</th>

            <td>
                {{ $product->minimum_stock }}
            </td>

        </tr>


        <tr>

            <th>Potential Profit per Item</th>

            <td>
                TZS
                {{ number_format(
                    $product->selling_price - $product->buying_price,
                    2
                ) }}
            </td>

        </tr>


        <tr>

            <th>Added On</th>

            <td>
                {{ $product->created_at->format('d M Y') }}
            </td>

        </tr>

    </table>

</div>


<div class="card">

    <h2>Stock Status</h2>

    @if($product->quantity <= $product->minimum_stock)

        <p>
            ⚠ This product is currently at or below its minimum stock level.
        </p>

    @else

        <p>
            ✓ This product currently has sufficient stock.
        </p>

    @endif

</div>

@endsection