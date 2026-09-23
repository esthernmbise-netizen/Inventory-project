@extends('layouts.app')

@section('content')

<div class="card">

<h1>
    Add Category
</h1>

<form
    method="POST"
    action="{{ route('categories.store') }}"
>

@csrf

<label>
    Name
</label>

<input
    type="text"
    name="name"
    value="{{ old('name') }}"
    required
>


<label>
    Description
</label>

<textarea
    name="description"
    rows="4"
>{{ old('description') }}</textarea>


<button
    class="btn"
    type="submit"
>
    Save Category
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