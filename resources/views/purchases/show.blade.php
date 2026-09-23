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

            <h1>Purchase Details</h1>

            <p>
                View the details of this recorded purchase.
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


<div class="card">

    <table>

        <tr>

            <th>Supplier</th>

            <td>
                {{ $purchase->supplier->name }}
            </td>

        </tr>


        <tr>

            <th>Product</th>

            <td>
                {{ $purchase->product->name }}
            </td>

        </tr>


        <tr>

            <th>Quantity</th>

            <td>
                {{ $purchase->quantity }}
            </td>

        </tr>


        <tr>

            <th>Buying Price per Item</th>

            <td>
                TZS
                {{ number_format($purchase->buying_price, 2) }}
            </td>

        </tr>


        <tr>

            <th>Total Purchase Cost</th>

            <td>

                <strong>
                    TZS
                    {{ number_format(
                        $purchase->buying_price * $purchase->quantity,
                        2
                    ) }}
                </strong>

            </td>

        </tr>


        <tr>

            <th>Purchase Date</th>

            <td>
                {{ $purchase->date->format('d M Y') }}
            </td>

        </tr>


        <tr>

            <th>Recorded On</th>

            <td>
                {{ $purchase->created_at->format('d M Y H:i') }}
            </td>

        </tr>

    </table>

</div>

@endsection