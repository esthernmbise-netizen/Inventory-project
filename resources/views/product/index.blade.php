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
            <h1>Products</h1>

            <p>
                Manage all products in your inventory.
            </p>
        </div>

        <a
            href="{{ route('product.create') }}"
            class="btn"
        >
            + Add Product
        </a>

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


@if(session('error'))

    <div class="alert alert-error">
        {{ session('error') }}
    </div>

@endif


@if($product->count())

    <div class="card">

        <div style="overflow-x: auto;">

            <table>

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Minimum Stock</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($products as $product)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $product->name }}
                            </td>

                            <td>
                                {{ $product->category->name }}
                            </td>

                            <td>
                                TZS
                                {{ number_format($product->buying_price, 2) }}
                            </td>

                            <td>
                                TZS
                                {{ number_format($product->selling_price, 2) }}
                            </td>

                            <td>

                                {{ $product->quantity }}

                                @if($product->quantity <= $product->minimum_stock)

                                    <span style="
                                        margin-left: 5px;
                                        font-size: 12px;
                                    ">
                                        ⚠ Low Stock
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $product->minimum_stock }}
                            </td>

                            <td>

                                <div style="
                                    display: flex;
                                    gap: 8px;
                                    flex-wrap: wrap;
                                ">

                                    <a
                                        href="{{ route('product.show', $product) }}"
                                        class="btn btn-secondary"
                                    >
                                        View
                                    </a>

                                    <a
                                        href="{{ route('product.edit', $product) }}"
                                        class="btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('product.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@else

    <div class="card" style="text-align: center;">

        <h2>No Products Yet</h2>

        <p>
            You have not added any products to your inventory.
        </p>

        <a
            href="{{ route('product.create') }}"
            class="btn"
        >
            + Add Your First Product
        </a>

    </div>

@endif

@endsection