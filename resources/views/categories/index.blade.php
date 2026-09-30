@extends('layouts.app')

@section('content')

<div class="card">

    <h1>
        Categories
    </h1>

    <a
        class="btn"
        href="{{ route('categories.create') }}"
    >
        + Add Category
    </a>

</div>


<div class="card">

<table>

<thead>

<tr>
    <th>Name</th>
    <th>Description</th>
    <th>Actions</th>
</tr>

</thead>

<tbody>

@forelse($categories as $category)

<tr>

<td>
    {{ $category->name }}
</td>

<td>
    {{ $category->description ?: '—' }}
</td>

<td class="actions">

<a
    class="btn"
    href="{{ route('categories.show', $category) }}"
>
    View
</a>

<a
    class="btn"
    href="{{ route('categories.edit', $category) }}"
>
    Edit
</a>

<form
    method="POST"
    action="{{ route('categories.destroy', $category) }}"
>

@csrf
@method('DELETE')

<button
    class="btn btn-danger"
    type="submit"
    onclick="return confirm('Delete this category?')"
>
    Delete
</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="3">
    No categories yet.
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection