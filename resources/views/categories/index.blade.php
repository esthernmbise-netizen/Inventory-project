@extends('layouts.categories')

@section('content')

<div class="main-card">

    <h1>
        Product Categories
    </h1>

    <p>
       <i>Categories for each product in your listore.</i>
    </p>

</div>


<div class="card">

    <h2>
        Main Workflow
    </h2>
 <div>
    <a href="{{ route('categories.show', 1) }}">
        <div class="list-group-item">
            <p>Beverages</p>
        </div>
        <span class=card-arrow>&rsaquo;</span>
    </a>
    <a href="{{ route('categories.show', 2) }}">
        <div class="list-group-item">
            <p>Snacks</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 3) }}">
        <div class="list-group-item">
            <p>Fruits</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 4) }}">
        <div class="list-group-item">
            <p>Meat</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 5) }}">
        <div class="list-group-item">
            <p>Vegetables</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 6) }}">
        <div class="list-group-item">
            <p>Household Items</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 7) }}">
        <div class="list-group-item">
            <p>Cleaning Supplies</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 8) }}">
        <div class="list-group-item">
            <p>Personal Care Products</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 9) }}">
        <div class="list-group-item">
            <p>Stationery</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 10) }}">
        <div class="list-group-item">
            <p>Food Items</p>
        </div>
    </a>
    <a href="{{ route('categories.show', 11) }}">
        <div class="list-group-item">
            <p>Clothing</p>
        </div>
    </a>
        
 </div>
    
       
    </p>

</div>

@endsection