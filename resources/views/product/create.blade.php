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

            <h1>Add New Product</h1>

            <p>
                Add a product to your inventory.
            </p>

        </div>

        <a
            href="{{ route('product.index') }}"
            class="btn btn-secondary"
        >
            ← Back to Products
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
        action="{{ route('product.store') }}"
        method="POST"
    >

        @csrf


        <div style="margin-bottom: 15px;">

            <label for="category_id">
                Category
            </label>

            <select
                name="category_id"
                id="category_id"
                required
            >

                <option value="">
                    -- Select Category --
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom: 15px;">

            <label for="name">
                Product Name
            </label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                placeholder="e.g. Sugar 1kg"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="buying_price">
                Buying Price
            </label>

            <input
                type="number"
                name="buying_price"
                id="buying_price"
                value="{{ old('buying_price') }}"
                min="0"
                step="0.01"
                placeholder="e.g. 2300"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="selling_price">
                Selling Price
            </label>

            <input
                type="number"
                name="selling_price"
                id="selling_price"
                value="{{ old('selling_price') }}"
                min="0"
                step="0.01"
                placeholder="e.g. 2800"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="quantity">
                Initial Stock Quantity
            </label>

            <input
                type="number"
                name="quantity"
                id="quantity"
                value="{{ old('quantity', 0) }}"
                min="0"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="minimum_stock">
                Minimum Stock Level
            </label>

            <input
                type="number"
                name="minimum_stock"
                id="minimum_stock"
                value="{{ old('minimum_stock', 0) }}"
                min="0"
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
                Save Product
            </button>

            <a
                href="{{ route('product.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection