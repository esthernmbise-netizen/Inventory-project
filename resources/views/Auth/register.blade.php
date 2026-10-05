<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | DukaStock</title>

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

        .register-container {
            width: 100%;
            max-width: 430px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
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
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #334155;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 15px;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
        }

        .register-btn:hover {
            background: #1d4ed8;
        }

        .login-link {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: #64748b;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="brand">
        <h1>DukaStock</h1>
        <p>Create your Inventory Management account</p>
    </div>

    <form method="POST" action="{{ route('register.submit') }}">

        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Enter your full name"
                required
                autofocus
            >

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required
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
                placeholder="Create a password"
                required
            >

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Confirm your password"
                required
            >
        </div>

        <button type="submit" class="register-btn">
            Create Account
        </button>

    </form>

    <div class="login-link">
        Already have an account?
        <a href="{{ route('login') }}">Login here</a>
    </div>

</div>

</body>
</html>

