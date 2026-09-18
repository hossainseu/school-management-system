<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Verify Email - School Management System</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f3f6fb;
        color: #1f2937;
    }

    .page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
    }

    .container {
        width: 100%;
        max-width: 430px;
    }

    .brand {
        text-align: center;
        margin-bottom: 25px;
    }

    .brand-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #2563eb;
        color: #fff;
        border-radius: 16px;
        font-size: 34px;
        box-shadow: 0 8px 20px rgba(37, 99, 235, .20);
    }

    .brand h1 {
        margin: 0;
        font-size: 25px;
        color: #111827;
    }

    .brand p {
        margin: 7px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .card {
        background: #fff;
        border-radius: 14px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
    }

    .card h2 {
        margin: 0 0 8px;
        font-size: 22px;
        color: #111827;
    }

    .description {
        margin: 0 0 22px;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.7;
    }

    .status {
        margin-bottom: 18px;
        padding: 11px 13px;
        border-radius: 8px;
        background: #ecfdf5;
        color: #15803d;
        font-size: 13px;
    }

    .actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn {
        width: 100%;
        border: none;
        border-radius: 8px;
        padding: 12px 16px;
        background: #2563eb;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 700;
    }

    .btn:hover {
        background: #1d4ed8;
    }

    .logout-btn {
        background: #f3f4f6;
        color: #374151;
    }

    .logout-btn:hover {
        background: #e5e7eb;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        color: #9ca3af;
        font-size: 12px;
    }

    @media (max-width: 480px) {
        .page {
            padding: 15px;
        }

        .card {
            padding: 22px;
        }
    }
</style>
```

</head>

<body>

<div class="page">

```
<div class="container">

    <div class="brand">

        <div class="brand-icon">
            ✉️
        </div>

        <h1>School Management System</h1>

        <p>Verify your email address</p>

    </div>

    <div class="card">

        <h2>Verify Your Email</h2>

        <p class="description">
            Thanks for signing up! Before getting started, please verify
            your email address by clicking the link we just sent you.
            If you didn't receive the email, we can send you another one.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="status">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <div class="actions">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="btn">
                    📧 Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn logout-btn">
                    🚪 Log Out
                </button>
            </form>

        </div>

    </div>

    <div class="footer">
        © {{ date('Y') }} School Management System
    </div>

</div>
```

</div>

</body>
</html>
