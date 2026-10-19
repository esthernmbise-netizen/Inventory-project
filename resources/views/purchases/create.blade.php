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

<div class="form-card">
   <div style="
        background-color: #e8eaec;
        padding:15px;
        display: float;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        border-width:20px">
    

        @if($errors->any())
            <div class="card" style="color:red; ">
                <div style="border-color:red;"
                            background-color="blue;">
                    <div class="alert alert-error">

                        <strong>Please correct the following errors:</strong>

                    <ul style="margin-bottom: 0;">

                        @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                    </div>
                </div>
                
            </div>  

        @endif


        <div class="form-card">

            <form
                action="{{ route('purchases.store') }}"
                method="POST"
            >

                @csrf


                <div class="card">
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
                </div>


                <div class="card">
                        <div style="margin-bottom: 15px;">

                        <label for="product_id">
                            Product
                        </label>

                        <select
                            name="product_id"
                            id="product_id"
                            required
                        >

                            <option value=""
                            >
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
                </div>


               <div class="card">
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
                            style="border-color: #2563eb;"
                        >

                    </div>
               </div>
               </div>


              <div class="card">
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
                max="{{ date('Y-m-d') }}"
                required

            >

            <div
                id="date-error"
                style="
                    display: none;
                    color: red;
                    font-weight: bold;
                    margin-top: 8px;
                "
            >
                    <div><svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                        fill="currentColor" viewBox="0 0 24 24" ><!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free--> <path d="M11 9h2v6h-2zm0 8h2v2h-2z"></path><path d="M12.87 2.51c-.35-.63-1.4-.63-1.75 0l-9.99 18c-.17.31-.17.69.01.99.18.31.51.49.86.49h20c.35 0 .68-.19.86-.49a1 1 0 0 0 .01-.99zM3.7 20 12 5.06 20.3 20z"></path>
                        </svg>
                    </div>Purchase date cannot be later than today.
            </div>

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

        <script>

        document.addEventListener('DOMContentLoaded', function () {

            const dateInput = document.getElementById('date');
            const errorMessage = document.getElementById('date-error');

            const today = new Date().toISOString().split('T')[0];

            dateInput.addEventListener('change', function () {

                if (this.value > today) {

                    this.classList.add('date-error');

                    errorMessage.style.display = 'block';

                } else {

                    this.classList.remove('date-error');

                    errorMessage.style.display = 'none';

                }

            });

        });

        </script>
    </div>
    
</div>
<style>

.date-error {
    border: 2px solid red !important;
    animation: blinkError 0.8s infinite;
}

@keyframes blinkError {

    0%, 100% {
        border-color: red;
    }

    50% {
        border-color: transparent;
    }

}

</style>
    

@endsection