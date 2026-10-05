
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | DukaStock</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand h1 {
            color: #2563eb;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .brand p {
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #334155;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 14px;
            color: #475569;
        }

        .remember input {
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="brand">
        <h1>DukaStock</h1>
        <p>Inventory Management System</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            Please check your login details and try again.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required
                autofocus
                autocomplete="email"
            >

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
                autocomplete="current-password"
            >

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="remember">
            <input
                type="checkbox"
                name="remember"
                id="remember"
                value="1"
            >

            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="login-btn">
            Sign In
        </button>

        <div class="register-link">
            Don't have an account?
            <a href="{{ route('register') }}">Create an account</a>
        </div>

    </form>

    <div class="footer">
        &copy; {{ date('Y') }} DukaStock. All rights reserved.
    </div>

</div>

</body>
</html>