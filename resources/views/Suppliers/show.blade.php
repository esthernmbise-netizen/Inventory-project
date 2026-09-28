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
            <h1>Supplier Details</h1>

            <p>
                View information and purchase history for this supplier.
            </p>
        </div>

        <div style="
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        ">

            <a
                href="{{ route('suppliers.edit', $supplier) }}"
                class="btn"
            >
                Edit Supplier
            </a>

            <a
                href="{{ route('suppliers.index') }}"
                class="btn btn-secondary"
            >
                ← Back to Suppliers
            </a>

        </div>

    </div>

</div>


<div class="card">

    <h2>Supplier Information</h2>

    <table>

        <tr>
            <th>Supplier Name</th>

            <td>
                {{ $supplier->name }}
            </td>
        </tr>

        <tr>
            <th>Phone Number</th>

            <td>
                {{ $supplier->phone ?? 'Not provided' }}
            </td>
        </tr>

        <tr>
            <th>Address</th>

            <td>
                {{ $supplier->address ?? 'Not provided' }}
            </td>
        </tr>

        <tr>
            <th>Added On</th>

            <td>
                {{ $supplier->created_at->format('d M Y') }}
            </td>
        </tr>

    </table>

</div>


<div class="card">

    <h2>Purchase History</h2>

    @if($supplier->purchases->count())

        <div style="overflow-x: auto;">

            <table>

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Buying Price</th>
                        <th>Total Cost</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($supplier->purchases as $purchase)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $purchase->date->format('d M Y') }}
                            </td>

                            <td>
                                {{ $purchase->product->name }}
                            </td>

                            <td>
                                {{ $purchase->quantity }}
                            </td>

                            <td>
                                TZS
                                {{ number_format($purchase->buying_price, 2) }}
                            </td>

                            <td>
                                TZS
                                {{ number_format(
                                    $purchase->buying_price * $purchase->quantity,
                                    2
                                ) }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <p>
            No purchases have been recorded from this supplier yet.
        </p>

    @endif

</div>

@endsection