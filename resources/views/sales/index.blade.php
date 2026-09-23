@extends('layouts.app')

@section('content')

<div class="card">

    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap;">

        <div>
            <h1>Sales</h1>

            <p>
                View all sales recorded in the inventory system.
            </p>
        </div>

        <a href="{{ route('sales.create') }}" class="btn">
            + Record Sale
        </a>

    </div>

</div>


@if($sales->count())

<div class="card">

    <div style="overflow-x: auto;">

        <table>

            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Selling Price</th>
                    <th>Buying Price</th>
                    <th>Profit</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($sales as $sale)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $sale->date->format('d M Y') }}
                    </td>

                    <td>
                        {{ $sale->product->name }}
                    </td>

                    <td>
                        {{ $sale->quantity }}
                    </td>

                    <td>
                        TZS {{ number_format($sale->selling_price, 2) }}
                    </td>

                    <td>
                        TZS {{ number_format($sale->buying_price, 2) }}
                    </td>

                    <td>
                        TZS
                        {{ number_format(($sale->selling_price - $sale->buying_price) * $sale->quantity, 2) }}
                    </td>

                    <td>
                        <a
                            href="{{ route('sales.show', $sale) }}"
                            class="btn btn-secondary"
                        >
                            View
                        </a>
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@else

<div class="card" style="text-align: center;">

    <h2>No Sales Yet</h2>

    <p>
        You have not recorded any sales yet.
    </p>

    <a href="{{ route('sales.create') }}" class="btn">
        + Record Your First Sale
    </a>

</div>

@endif

@endsection