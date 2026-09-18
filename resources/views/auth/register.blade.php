<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account - School Management System</title>

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

    .register-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
    }

    .register-container {
        width: 100%;
        max-width: 450px;
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

    .register-card {
        background: #fff;
        border-radius: 14px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
    }

    .register-card h2 {
        margin: 0 0 6px;
        font-size: 22px;
        color: #111827;
    }

    .subtitle {
        margin: 0 0 24px;
        color: #6b7280;
        font-size: 13px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
    }

    .form-group input {
        width: 100%;
        padding: 12px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #fff;
        color: #1f2937;
        font-size: 14px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 13px;
    }

    .register-btn {
        width: 100%;
        border: none;
        border-radius: 8px;
        padding: 12px 16px;
        background: #2563eb;
        color: #fff;
        cursor: pointer;
        font-size: 15px;
        font-weight: 700;
        transition: .2s;
    }

    .register-btn:hover {
        background: #1d4ed8;
    }

    .login-link {
        text-align: center;
        margin-top: 22px;
        font-size: 13px;
        color: #6b7280;
    }

    .login-link a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 700;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        color: #9ca3af;
        font-size: 12px;
    }

    @media (max-width: 480px) {
        .register-page {
            padding: 15px;
        }

        .register-card {
            padding: 22px;
        }
    }
</style>

</head>

<body>

<div class="register-page">
<div class="register-container">

    <div class="brand">

        <div class="brand-icon">
            🏫
        </div>

        <h1>School Management System</h1>

        <p>Create your school management account</p>

    </div>

    <div class="register-card">

        <h2>Create Account</h2>

        <p class="subtitle">
            Register a new account to access the system.
        </p>

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <div class="form-group">

                <label for="name">
                    Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your name"
                >

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="Enter your email"
                >

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Create a password"
                >

                @error('password')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                >

                @error('password_confirmation')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button type="submit" class="register-btn">
                👤 Create Account
            </button>

        </form>

        <div class="login-link">

            Already have an account?

            <a href="{{ route('login') }}">
                Sign In
            </a>

        </div>

    </div>

    <div class="footer">
        © {{ date('Y') }} School Management System
    </div>

</div>
</div>

</body>
</html>
