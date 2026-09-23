@extends('layouts.app')

@section('content')

<div class="card">

    <h1>Record New Sale</h1>

    <p>
        Record a sale and automatically reduce the product stock.
    </p>

</div>


<div class="card">

    <form action="{{ route('sales.store') }}" method="POST">

        @csrf

        <div style="margin-bottom: 15px;">

            <label for="product_id">
                Product
            </label>

            <select name="product_id" id="product_id" required>

                <option value="">
                    -- Select Product --
                </option>

                @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}
                    >
                        {{ $product->name }}
                        — Stock: {{ $product->quantity }}
                        — Selling Price: TZS {{ number_format($product->selling_price, 2) }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label for="quantity">
                Quantity
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

            <label for="selling_price">
                Selling Price per Item
            </label>

            <input
                type="number"
                name="selling_price"
                id="selling_price"
                value="{{ old('selling_price') }}"
                min="0"
                step="0.01"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="date">
                Sale Date
            </label>

            <input
                type="date"
                name="date"
                id="date"
                value="{{ old('date', date('Y-m-d')) }}"
                required
            >

        </div>


        <div style="display: flex; gap: 10px; flex-wrap: wrap;">

            <button type="submit" class="btn">
                Record Sale
            </button>

            <a
                href="{{ route('sales.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection