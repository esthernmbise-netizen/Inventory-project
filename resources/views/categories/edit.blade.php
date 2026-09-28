@extends('layouts.app')

@section('content')

<div class="card">

<h1>
    Edit Category
</h1>

<form
    method="POST"
    action="{{ route('categories.update', $category) }}"
>

@csrf

@method('PUT')

<label>
    Name
</label>

<input
    type="text"
    name="name"
    value="{{ old('name', $category->name) }}"
    required
>


<label>
    Description
</label>

<textarea
    name="description"
    rows="4"
>{{ old('description', $category->description) }}</textarea>


<button
    class="btn"
    type="submit"
>
    Update Category
</button>

<a
    class="btn"
    href="{{ route('categories.index') }}"
>
    Cancel
</a>

</form>

</div>

@endsection