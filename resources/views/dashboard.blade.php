@extends('layouts.app')

@section('content')

<style>

/*
   DASHBOARD GENERAL
   */

.dashboard {
    width: 100%;
}


/* 
   2. DASHBOARD HEADER
  */

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.dashboard-header h1 {
    margin: 0 0 6px;
    font-size: 30px;
}

.dashboard-header p {
    margin: 0;
    color: #6b7280;
}


/*
   3. DASHBOARD ACTION BUTTONS
   */

.dashboard-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.dashboard-btn {
    display: inline-block;
    padding: 11px 16px;
    border-radius: 9px;
    text-decoration: none;
    font-weight: 600;
    background: #2563eb;
    color: white;
}

.dashboard-btn:hover {
    opacity: 0.9;
}

.dashboard-btn.secondary {
    background: #111827;
}


/* 
   4. SUMMARY / STATISTICS CARDS
   */

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    border-radius: 14px;
    padding: 20px;
    border: 1px solid #eef0f4;
    box-shadow: 0 3px 14px rgba(0, 0, 0, 0.06);
}

.stat-title {
    margin-bottom: 10px;
    color: #6b7280;
    font-size: 14px;
}

.stat-value {
    color: #111827;
    font-size: 27px;
    font-weight: 700;
}

.stat-description {
    margin-top: 7px;
    color: #9ca3af;
    font-size: 13px;
}


/* 
   5. DASHBOARD TWO-COLUMN GRID
    */

.dashboard-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}


/* 
   6. GENERAL DASHBOARD CARDS
   */

.dashboard-card {
    min-width: 0;
    padding: 20px;
    background: white;
    border-radius: 14px;
    border: 1px solid #eef0f4;
    box-shadow: 0 3px 14px rgba(0, 0, 0, 0.06);
}

.card-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
}

.card-heading h2 {
    margin: 0;
    font-size: 19px;
}

.card-heading a {
    color: #2563eb;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}


/* 
   7. QUICK ACTIONS
    */

.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.quick-action {
    display: block;
    padding: 16px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    color: #111827;
    text-decoration: none;
}

.quick-action:hover {
    background: #eff6ff;
    border-color: #bfdbfe;
}

.quick-action strong {
    display: block;
    margin-bottom: 5px;
}

.quick-action span {
    color: #6b7280;
    font-size: 13px;
}


/*
   8. DASHBOARD TABLES
  */

.table-wrapper {
    overflow-x: auto;
}

.dashboard-table {
    width: 100%;
    border-collapse: collapse;
}

.dashboard-table th,
.dashboard-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #eef0f4;
    text-align: left;
    white-space: nowrap;
}

.dashboard-table th {
    color: #6b7280;
    font-size: 13px;
    font-weight: 600;
}

.dashboard-table td {
    font-size: 14px;
}


/* 
   9. STOCK STATUS
    */

.stock-warning {
    color: #dc2626;
    font-weight: 700;
}

.stock-ok {
    color: #16a34a;
    font-weight: 600;
}


/* 
   10. EMPTY TABLE STATE
   */

.empty-state {
    padding: 25px 10px;
    color: #9ca3af;
    text-align: center;
}


/* 
   11. FLOATING ADD BUTTON
    */

.floating-add {
    position: fixed;
    right: 25px;
    bottom: 25px;

    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #2563eb;
    color: white;

    text-decoration: none;

    font-size: 30px;
    font-weight: 300;

    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35);

    z-index: 100;
}

.floating-add:hover {
    transform: scale(1.05);
}


/*
   12. TABLET RESPONSIVENESS
    */

@media (max-width: 1000px) {

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }

}


/* 
   13. MOBILE RESPONSIVENESS
   */

@media (max-width: 600px) {

    .dashboard-header h1 {
        font-size: 24px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .quick-actions {
        grid-template-columns: 1fr;
    }

    .dashboard-actions {
        width: 100%;
    }

    .dashboard-btn {
        flex: 1;
        text-align: center;
    }

    .floating-add {
        right: 18px;
        bottom: 18px;
    }

}

</style>

<!--  DASHBOARD
      -->

<div class="dashboard">


<!--HEADER
    -->

<div class="dashboard-header">

    <div>

        <h1>
            Dashboard
        </h1>

        <p>
            Welcome back,
            {{ auth()->user()->name ?? 'Administrator' }}.
            Here's what's happening in your business today.
        </p>

    </div>


    <div class="dashboard-actions">

        <a
            href="{{ route('sales.create') }}"
            class="dashboard-btn"
        >
            + New Sale
        </a>

        <a
            href="{{ route('purchases.create') }}"
            class="dashboard-btn secondary"
        >
            + Purchase
        </a>

    </div>

</div>


<!-- 
     SUMMARY CARDS
    -->

<div class="stats-grid">


    <!-- TOTAL PRODUCTS -->

    <div class="stat-card">

        <div class="stat-title">
            Total Products
        </div>

        <div class="stat-value">
            {{ $totalProducts ?? 0 }}
        </div>

        <div class="stat-description">
            Products in your inventory
        </div>

    </div>


    <!-- TODAY'S SALES -->

    <div class="stat-card">

        <div class="stat-title">
            Today's Sales
        </div>

        <div class="stat-value">
            TZS {{ number_format($todaySales ?? 0, 0) }}
        </div>

        <div class="stat-description">
            Sales recorded today
        </div>

    </div>


    <!-- LOW STOCK -->

    <div class="stat-card">

        <div class="stat-title">
            Low Stock
        </div>

        <div class="stat-value">
            {{ $lowStockProducts ?? 0 }}
        </div>

        <div class="stat-description">
            Products needing attention
        </div>

    </div>


    <!-- TODAY'S PROFIT -->

    <div class="stat-card">

        <div class="stat-title">
            Today's Profit
        </div>

        <div class="stat-value">
            TZS {{ number_format($todayProfit ?? 0, 0) }}
        </div>

        <div class="stat-description">
            Estimated profit today
        </div>

    </div>

</div>


<!--  QUICK ACTIONS + BUSINESS OVERVIEW
      -->

<div class="dashboard-grid">


    <!-- QUICK ACTIONS -->

    <div class="dashboard-card">

        <div class="card-heading">

            <h2>
                Quick Actions
            </h2>

        </div>


        <div class="quick-actions">


            <a
                href="{{ route('products.create') }}"
                class="quick-action"
            >

                <strong>
                    + Add Product
                </strong>

                <span>
                    Add a new product to inventory
                </span>

            </a>


            <a
                href="{{ route('categories.create') }}"
                class="quick-action"
            >

                <strong>
                    + Add Category
                </strong>

                <span>
                    Create a product category
                </span>

            </a>


            <a
                href="{{ route('suppliers.create') }}"
                class="quick-action"
            >

                <strong>
                    + Add Supplier
                </strong>

                <span>
                    Register a new supplier
                </span>

            </a>


            <a
                href="{{ route('sales.create') }}"
                class="quick-action"
            >

                <strong>
                    + Record Sale
                </strong>

                <span>
                    Record a customer's purchase
                </span>

            </a>


        </div>

    </div>


    <!-- BUSINESS OVERVIEW -->

    <div class="dashboard-card">

        <div class="card-heading">

            <h2>
                Business Overview
            </h2>

        </div>


        <div class="quick-actions">


            <div class="quick-action">

                <strong>
                    {{ $totalCategories ?? 0 }}
                </strong>

                <span>
                    Total Categories
                </span>

            </div>


            <div class="quick-action">

                <strong>
                    {{ $totalSuppliers ?? 0 }}
                </strong>

                <span>
                    Total Suppliers
                </span>

            </div>


        </div>

    </div>

</div>


<!-- RECENT SALES -->

<div class="dashboard-card">

    <div class="card-heading">

        <h2>
            Recent Sales
        </h2>

        <a href="{{ route('sales.index') }}">
            View All
        </a>

    </div>


    <div class="table-wrapper">

        <table class="dashboard-table">

            <thead>

                <tr>

                    <th>
                        Product
                    </th>

                    <th>
                        Quantity
                    </th>

                    <th>
                        Selling Price
                    </th>

                    <th>
                        Total
                    </th>

                    <th>
                        Date
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($recentSales ?? [] as $sale)

                    <tr>

                        <td>
                            {{ $sale->product->name ?? 'Unknown Product' }}
                        </td>

                        <td>
                            {{ $sale->quantity }}
                        </td>

                        <td>
                            TZS {{ number_format($sale->selling_price, 0) }}
                        </td>

                        <td>
                            <strong>
                                TZS
                                {{ number_format($sale->quantity * $sale->selling_price, 0) }}
                            </strong>
                        </td>

                        <td>
                            {{ $sale->date
                                ? \Carbon\Carbon::parse($sale->date)->format('d M Y')
                                : '-'
                            }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="empty-state"
                        >
                            No sales have been recorded yet.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- RECENT PURCHASes  -->

<div class="dashboard-card" style="margin-top: 20px;">

    <div class="card-heading">

        <h2>
            Recent Purchases
        </h2>

        <a href="{{ route('purchases.index') }}">
            View All
        </a>

    </div>


    <div class="table-wrapper">

        <table class="dashboard-table">

            <thead>

                <tr>

                    <th>
                        Product
                    </th>

                    <th>
                        Supplier
                    </th>

                    <th>
                        Quantity
                    </th>

                    <th>
                        Buying Price
                    </th>

                    <th>
                        Date
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($recentPurchases ?? [] as $purchase)

                    <tr>

                        <td>
                            {{ $purchase->product->name ?? 'Unknown Product' }}
                        </td>

                        <td>
                            {{ $purchase->supplier->name ?? 'Unknown Supplier' }}
                        </td>

                        <td>
                            {{ $purchase->quantity }}
                        </td>

                        <td>
                            TZS {{ number_format($purchase->buying_price, 0) }}
                        </td>

                        <td>
                            {{ $purchase->date
                                ? \Carbon\Carbon::parse($purchase->date)->format('d M Y')
                                : '-'
                            }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="empty-state"
                        >
                            No purchases have been recorded yet.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



<!--    LOW STOCK ALERTS-->
     

<div class="dashboard-card" style="margin-top: 20px;">

    <div class="card-heading">

        <h2>
            Low Stock Alerts
        </h2>

        <a href="{{ route('products.index') }}">
            View Products
        </a>

    </div>


    <div class="table-wrapper">

        <table class="dashboard-table">

            <thead>

                <tr>

                    <th>
                        Product
                    </th>

                    <th>
                        Current Stock
                    </th>

                    <th>
                        Minimum Stock
                    </th>

                    <th>
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($lowStockList ?? [] as $product)

                    <tr>

                        <td>
                            {{ $product->name }}
                        </td>

                        <td class="stock-warning">
                            {{ $product->quantity }}
                        </td>

                        <td>
                            {{ $product->minimum_stock }}
                        </td>

                        <td class="stock-warning">
                            Low Stock
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="empty-state"
                        >
                            ✓ All products have sufficient stock.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


</div>


   <!-- FLOATING ADD BUTTON-->


<a
href="{{ route('products.create') }}"
class="floating-add"
title="Add Product"

>


+


</a>

@endsection
