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
            <h1>Purchases</h1>

            <p>
                View all purchases made from suppliers.
            </p>
        </div>

        <a
            href="{{ route('purchases.create') }}"
            class="btn"
        >
            + Record Purchase
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


@if($purchases->count())

    <div class="card">

        <div style="overflow-x: auto;">

            <table>

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Buying Price</th>
                        <th>Total Cost</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($purchases as $purchase)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $purchase->date->format('d M Y') }}
                            </td>

                            <td>
                                {{ $purchase->supplier->name }}
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

                            <td>

                                <a
                                    href="{{ route('purchases.show', $purchase) }}"
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

        <h2>No Purchases Yet</h2>

        <p>
            You have not recorded any purchases yet.
        </p>

        <a
            href="{{ route('purchases.create') }}"
            class="btn"
        >
            + Record Your First Purchase
        </a>

    </div>

@endif

@endsection