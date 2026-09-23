@extends('layouts.app')

@section('content')

<div class="card">

    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap;">

        <div>

            <h1>Sale Details</h1>

            <p>
                Details of this recorded sale.
            </p>

        </div>

        <a
            href="{{ route('sales.index') }}"
            class="btn btn-secondary"
        >
            ← Back to Sales
        </a>

    </div>

</div>


<div class="card">

    <table>

        <tr>
            <th>Product</th>

            <td>
                {{ $sale->product->name }}
            </td>
        </tr>


        <tr>
            <th>Quantity</th>

            <td>
                {{ $sale->quantity }}
            </td>
        </tr>


        <tr>
            <th>Selling Price per Item</th>

            <td>
                TZS {{ number_format($sale->selling_price, 2) }}
            </td>
        </tr>


        <tr>
            <th>Buying Price per Item</th>

            <td>
                TZS {{ number_format($sale->buying_price, 2) }}
            </td>
        </tr>


        <tr>
            <th>Total Sales Amount</th>

            <td>
                <strong>
                    TZS
                    {{ number_format($sale->selling_price * $sale->quantity, 2) }}
                </strong>
            </td>
        </tr>


        <tr>
            <th>Total Cost</th>

            <td>
                TZS
                {{ number_format($sale->buying_price * $sale->quantity, 2) }}
            </td>
        </tr>


        <tr>
            <th>Total Profit</th>

            <td>
                <strong>
                    TZS
                    {{ number_format(
                        ($sale->selling_price - $sale->buying_price)
                        * $sale->quantity,
                        2
                    ) }}
                </strong>
            </td>
        </tr>


        <tr>
            <th>Sale Date</th>

            <td>
                {{ $sale->date->format('d M Y') }}
            </td>
        </tr>

    </table>

</div>

@endsection