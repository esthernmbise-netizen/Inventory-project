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
            <h1>Add New Supplier</h1>

            <p>
                Add a supplier who provides products to your business.
            </p>
        </div>

        <a
            href="{{ route('suppliers.index') }}"
            class="btn btn-secondary"
        >
            ← Back to Suppliers
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
        action="{{ route('suppliers.store') }}"
        method="POST"
    >

        @csrf


        <div style="margin-bottom: 15px;">

            <label for="name">
                Supplier Name
            </label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                placeholder="Enter supplier name"
                required
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="phone">
                Phone Number
            </label>

            <input
                type="text"
                name="phone"
                id="phone"
                value="{{ old('phone') }}"
                placeholder="e.g. 0712 345 678"
            >

        </div>


        <div style="margin-bottom: 15px;">

            <label for="address">
                Address
            </label>

            <input
                type="text"
                name="address"
                id="address"
                value="{{ old('address') }}"
                placeholder="Enter supplier address"
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
                Save Supplier
            </button>

            <a
                href="{{ route('suppliers.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection