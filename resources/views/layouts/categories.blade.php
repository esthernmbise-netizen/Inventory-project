<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ?? 'Categories' }}
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        nav {
            background: #111827;
            padding: 14px 20px;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 16px;
        }

        .main-card {
            background-color: #fddf9e;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            display: flex;
            flex-direction: column;
            box-sizing:20px;
        }

        .card {
            background-color: #eeeae2;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
        }

        .list-group-item {
            background-color: #fdf6dffb;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,.05);
            border: 1px solid #f8d76b;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 8px;
            border: 0;
            background: #111827;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #b91c1c;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 6px 0 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .success {
            padding: 12px;
            background: #dcfce7;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .error {
            padding: 12px;
            background: #fee2e2;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        @media (max-width: 700px) {

            table {
                display: block;
                overflow-x: auto;
            }

        }

    </style>

</head>

<body>

<nav>

    <a href="{{ route('dashboard') }}">
        Dashboard
    </a>

    <a href="{{ route('categories.index') }}">
        Categories
    </a>

    <a href="{{ route('products.index') }}">
        Products
    </a>

    <a href="{{ route('suppliers.index') }}">
        Suppliers
    </a>

    <a href="{{ route('purchases.index') }}">
        Purchases
    </a>

    <a href="{{ route('sales.index') }}">
        Sales
    </a>

</nav>

<div class="container">

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="error">

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    @yield('content')

</div>

</body>

</html>