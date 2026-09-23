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
            <h1>Suppliers</h1>

            <p>
                Manage the suppliers who provide products to your business.
            </p>
        </div>

        <a href="{{ route('suppliers.create') }}" class="btn">
            + Add Supplier
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


@if($suppliers->count())

    <div class="card">

        <div style="overflow-x: auto;">

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Supplier Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($suppliers as $supplier)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $supplier->name }}
                            </td>

                            <td>
                                {{ $supplier->phone ?? 'Not provided' }}
                            </td>

                            <td>
                                {{ $supplier->address ?? 'Not provided' }}
                            </td>

                            <td>

                                <div style="
                                    display: flex;
                                    gap: 8px;
                                    flex-wrap: wrap;
                                ">

                                    <a
                                        href="{{ route('suppliers.show', $supplier) }}"
                                        class="btn btn-secondary"
                                    >
                                        View
                                    </a>

                                    <a
                                        href="{{ route('suppliers.edit', $supplier) }}"
                                        class="btn"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('suppliers.destroy', $supplier) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this supplier?');"
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

        <h2>No Suppliers Yet</h2>

        <p>
            You have not added any suppliers to your inventory system.
        </p>

        <a href="{{ route('suppliers.create') }}" class="btn">
            + Add Your First Supplier
        </a>

    </div>

@endif

@endsection