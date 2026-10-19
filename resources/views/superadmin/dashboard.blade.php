
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DukaStock | Super Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #0f172a;
        }
        header {
            background: #172554;
            color: white;
            padding: 22px 5%;
        }
        header h1 { margin: 0 0 6px; font-size: 24px; }
        header p { margin: 0; color: #cbd5e1; }
        main { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        .welcome { margin-bottom: 24px; }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
        }
        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0f172a0a;
        }
        .card p { color: #64748b; margin: 0 0 12px; }
        .card h2 { margin: 0; font-size: 30px; }
        .note {
            margin-top: 24px;
            padding: 18px;
            background: white;
            border-radius: 12px;
            line-height: 1.6;
        }
        .logout { color: white; float: right; }
        @media (max-width: 480px) {
            header h1 { font-size: 20px; }
            main { margin-top: 20px; }
        }
    </style>
</head>
<body>
    <header>
        <a class="logout" href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Log out
        </a>
        <h1>DukaStock Control Center</h1>
        <p>Super Admin Dashboard</p>

        <form id="logout-form" action="{{ route('logout') }}"
              method="POST" style="display:none">
            @csrf
        </form>
    </header>

    <main>
        <div class="welcome">
            <h2>Welcome, {{ auth()->user()->name }}</h2>
            <p>Manage and monitor the DukaStock platform.</p>
        </div>

        <div class="cards">
            <div class="card">
                <p>Registered users</p>
                <h2>{{ $totalUsers }}</h2>
            </div>
            <div class="card">
                <p>Products</p>
                <h2>{{ $totalProducts }}</h2>
            </div>
            <div class="card">
                <p>Categories</p>
                <h2>{{ $totalCategories }}</h2>
            </div>
            <div class="card">
                <p>Suppliers</p>
                <h2>{{ $totalSuppliers }}</h2>
            </div>
        </div>

        <div class="note">
            <strong>Platform management</strong>
            <p>
                This is the first version of the Super Admin dashboard.
                Shop management, owner assignments, and platform activity
                will be connected in the next implementation stage.
            </p>
        </div>
    </main>
</body>
</html>
