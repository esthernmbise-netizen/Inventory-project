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
            <h1>Record New Purchase</h1>

            <p>
                Record products purchased from a supplier and automatically increase stock.
            </p>
        </div>

        <a
            href="{{ route('purchases.index') }}"
            class="btn btn-secondary"
        >
            ← Back to Purchases
        </a>

    </div>

</div>


@if($errors->any())

    <div class="alert alert-error">

        <strong>Please correct the following errors:</strong>

        <ul style="margin-bottom: 0;">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


<div class="card">

    <form
        action="{{ route('purchases.store') }}"
        method="POST"
    >

        @csrf


        <div style="margin-bottom: 15px;">

            <label for="supplier_id">
                Supplier
            </label>

            <select
                name="supplier_id"
                id="supplier_id"
                required
            >

                <option value="">
                    -- Select Supplier --
                </option>

                @foreach($suppliers as $supplier)

                    <option
                        value="{{ $supplier->id }}"
                        {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                    >
                        {{ $supplier->name }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label for="product_id">
                Product
            </label>

            <select
                name="product_id"
                id="product_id"
                required
            >

                <option value="">
                    -- Select Product --
                </option>

                @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}
                    >
                        {{ $product->name }}
                        — Current Stock: {{ $product->quantity }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label for="quantity">
                Quantity Purchased
            </label>

            <input
                type="number"
                name="quantity"
                id="quantity"
                value="{{ old('quantity') }}"
                min="1"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="buying_price">
                Buying Price per Item
            </label>

            <input
                type="number"
                name="buying_price"
                id="buying_price"
                value="{{ old('buying_price') }}"
                min="0"
                step="0.01"
                placeholder="e.g. 2500"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="date">
                Purchase Date
            </label>

            <input
                type="date"
                name="date"
                id="date"
                value="{{ old('date', date('Y-m-d')) }}"
                required
            >

        </div>


        <div style="
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        ">

            <button
                type="submit"
                class="btn"
            >
                Record Purchase
            </button>

            <a
                href="{{ route('purchases.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection