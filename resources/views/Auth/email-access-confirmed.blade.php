<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Confirmation | DukaStock</title>

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
            max-width: 480px;
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
            background: #dcfce7;
            color: #166534;
            font-size: 36px;
        }

        h1 {
            margin: 0 0 15px;
            font-size: 26px;
        }

        p {
            color: #64748b;
            line-height: 1.7;
        }

        .button {
            display: inline-block;
            width: 100%;
            margin-top: 18px;
            padding: 14px;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .note {
            margin-top: 20px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <main class="card">
        <div class="icon" aria-hidden="true">✓</div>

        <h1>Confirmation Link Accepted</h1>

        <p>
            Your DukaStock login confirmation link has been accepted.
        </p>

        <p>
            Return to the browser tab where you entered your login
            credentials. Refresh the verification page to continue.
        </p>

        <p class="note">
            For security, every new login requires a fresh confirmation
            link. Do not reuse an old link.
        </p>

        <a href="{{ route('login') }}" class="button">
            Open Login Page
        </a>
    </main>
</body>
</html>
