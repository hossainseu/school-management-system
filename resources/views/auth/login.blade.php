<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - School Management System</title>

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

    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
    }

    .login-container {
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

    .login-card {
        background: #fff;
        border-radius: 14px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
    }

    .login-card h2 {
        margin: 0 0 6px;
        font-size: 22px;
        color: #111827;
    }

    .login-card .subtitle {
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

    .session-status {
        margin-bottom: 18px;
        padding: 11px 13px;
        border-radius: 8px;
        background: #ecfdf5;
        color: #15803d;
        font-size: 13px;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: #4b5563;
    }

    .remember input {
        width: 15px;
        height: 15px;
        accent-color: #2563eb;
    }

    .forgot-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .login-btn {
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

    .login-btn:hover {
        background: #1d4ed8;
    }

    .register-link {
        text-align: center;
        margin-top: 22px;
        font-size: 13px;
        color: #6b7280;
    }

    .register-link a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 700;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        color: #9ca3af;
        font-size: 12px;
    }

    @media (max-width: 480px) {
        .login-page {
            padding: 15px;
        }

        .login-card {
            padding: 22px;
        }

        .form-options {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

</head>

<body>

<div class="login-page">

<div class="login-container">

    <div class="brand">
        <div class="brand-icon">
            🏫
        </div>

        <h1>School Management System</h1>

        <p>Manage your school smarter and easier</p>
    </div>

    <div class="login-card">

        <h2>Welcome Back</h2>

        <p class="subtitle">
            Sign in to access your school dashboard.
        </p>

        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email"
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-options">

                <label class="remember">
                    <input
                        type="checkbox"
                        name="remember"
                    >

                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="forgot-link"
                    >
                        Forgot password?
                    </a>
                @endif

            </div>

            <button type="submit" class="login-btn">
                🔐 Sign In
            </button>

        </form>

        @if (Route::has('register'))
            <div class="register-link">
                Don't have an account?
                <a href="{{ route('register') }}">
                    Create Account
                </a>
            </div>
        @endif

    </div>

    <div class="footer">
        © {{ date('Y') }} School Management System
    </div>

</div>

</div>

</body>
</html>
