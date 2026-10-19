
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify Email | DukaStock</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #1e293b;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 460px;
            padding: 35px;
            background: #ffffff;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        }

        .icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #dbeafe;
            font-size: 36px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 27px;
        }

        p {
            color: #64748b;
            line-height: 1.7;
        }

        .message {
            margin: 18px 0;
            padding: 12px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            overflow-wrap: anywhere;
        }

        .error {
            margin: 18px 0;
            padding: 12px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
            text-align: left;
            overflow-wrap: anywhere;
        }

        .error p {
            margin: 5px 0;
            color: #991b1b;
        }

        form {
            width: 100%;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 12px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        button:hover {
            background: #1d4ed8;
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .logout {
            background: #e2e8f0;
            color: #334155;
        }

        .logout:hover {
            background: #cbd5e1;
        }

        .email {
            color: #1d4ed8;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .help-text {
            font-size: 13px;
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 25px 20px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <main class="card">

        <div class="icon" aria-hidden="true">✉</div>

        <h1>Verify your email</h1>

        <p>
            Welcome to DukaStock! Before accessing your inventory,
            please verify your email address using the link sent to you.
        </p>

        <p class="email">
            {{ auth()->user()->email }}
        </p>

        {{-- Successful email or verification message --}}
        @if (session('success'))
            <div class="message" role="status">
                {{ session('success') }}
            </div>
        @elseif (session('status') === 'verification-link-sent')
            <div class="message" role="status">
                A new verification link has been sent to your email.
            </div>
        @endif

        {{-- Display any errors --}}
        @if ($errors->any())
            <div class="error" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Resend verification email --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit">
                Resend verification email
            </button>
        </form>

        {{-- Log out --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout">
                Log out
            </button>
        </form>

        <p class="help-text">
            Check your inbox and spam folder. If the email does not arrive,
            try resending it or check your mail configuration.
        </p>

    </main>
</body>
</html>
