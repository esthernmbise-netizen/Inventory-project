@extends('layouts.app')

@section('content')

<div class="card">

<h1>
    {{ $category->name }}
</h1>

<p>
    {{ $category->description ?: 'No description.' }}
</p>

<a
    class="btn"
    href="{{ route('categories.edit', $category) }}"
>
    Edit
</a>

<a
    class="btn"
    href="{{ route('categories.index') }}"
>
    Back
</a>

</div>


<div class="card">

<h2>
    Products in this Category
</h2>

@forelse($category->products as $product)

<p>
    {{ $product->name }}
    —
    Stock: {{ $product->quantity }}
</p>

@empty

<p>
    No products in this category.
</p>

@endforelse

</div>

@endsection