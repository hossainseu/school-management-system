@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Profile</h1>
        <p>Manage your account information and password.</p>
    </div>
</div>

@if (session('status') === 'profile-updated')
    <div class="alert alert-success">
        Profile information updated successfully.
    </div>
@endif

@if (session('status') === 'password-updated')
    <div class="alert alert-success">
        Password updated successfully.
    </div>
@endif

<div class="profile-grid">

    {{-- Profile Information --}}
    <div class="card profile-card">

        <div class="section-header">
            <h2>Profile Information</h2>
            <p>Update your name and email address.</p>
        </div>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name">Name</label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                >

                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                >

                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="verification-message">
                        Your email address is not verified.

                        <form method="post" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="link-button">
                                Click here to resend the verification email.
                            </button>
                        </form>

                        @if (session('status') === 'verification-link-sent')
                            <div class="verification-success">
                                A new verification link has been sent to your email address.
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">
                💾 Save Changes
            </button>

        </form>

    </div>


    {{-- Update Password --}}
    <div class="card profile-card">

        <div class="section-header">
            <h2>Update Password</h2>
            <p>Make sure your account uses a strong password.</p>
        </div>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password">Current Password</label>

                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                >

                @error('current_password', 'updatePassword')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                >

                @error('password', 'updatePassword')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                >

                @error('password_confirmation', 'updatePassword')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                🔐 Update Password
            </button>

        </form>

    </div>


    {{-- Delete Account --}}
    <div class="card profile-card danger-card">

        <div class="section-header">
            <h2>Delete Account</h2>
            <p>Permanently delete your account and all associated data.</p>
        </div>

        <form method="post"
              action="{{ route('profile.destroy') }}"
              onsubmit="return confirm('Are you sure you want to permanently delete your account?');">

            @csrf
            @method('delete')

            <div class="form-group">
                <label for="delete_password">Password</label>

                <input
                    id="delete_password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    required
                >

                @error('password', 'userDeletion')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">
                🗑 Delete Account
            </button>

        </form>

    </div>

</div>


@endsection

@push('styles')

<style>

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .profile-card {
        padding: 0;
        overflow: hidden;
    }

    .section-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-header h2 {
        margin: 0 0 5px;
        font-size: 18px;
        color: #111827;
    }

    .section-header p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    .profile-card form {
        padding: 22px;
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
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background: #fff;
        color: #1f2937;
        font-size: 14px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
    }

    .field-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 13px;
    }

    .verification-message {
        margin-top: 10px;
        padding: 12px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 7px;
        color: #92400e;
        font-size: 13px;
    }

    .link-button {
        border: none;
        background: none;
        padding: 0;
        margin-top: 7px;
        color: #2563eb;
        cursor: pointer;
        font-size: 13px;
        text-decoration: underline;
    }

    .verification-success {
        margin-top: 8px;
        color: #15803d;
    }

    .danger-card {
        grid-column: 1 / -1;
    }

    .danger-card .section-header {
        background: #fef2f2;
    }

    .btn-danger {
        background: #dc2626;
        color: #fff;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }

    .alert {
        margin-bottom: 20px;
    }

    @media (max-width: 900px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .danger-card {
            grid-column: auto;
        }
    }

</style>

@endpush
