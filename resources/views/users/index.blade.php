@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>User Management</h1>
        <p>Manage system users and their roles.</p>
    </div>
</div>

@if(session('success')) <div class="alert alert-success">
{{ session('success') }} </div>
@endif

@if(session('error')) <div class="alert alert-error">
{{ session('error') }} </div>
@endif

{{-- Summary Cards --}}

<div class="stats-grid">

<div class="card stat-card">
    <div>
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $users->total() }}</div>
    </div>
    <div class="stat-icon">👥</div>
</div>

<div class="card stat-card">
    <div>
        <div class="stat-label">Admins</div>
        <div class="stat-value">
            {{ \App\Models\User::where('role', 'admin')->count() }}
        </div>
    </div>
    <div class="stat-icon">🛡️</div>
</div>

<div class="card stat-card">
    <div>
        <div class="stat-label">Teachers</div>
        <div class="stat-value">
            {{ \App\Models\User::where('role', 'teacher')->count() }}
        </div>
    </div>
    <div class="stat-icon">👨‍🏫</div>
</div>

<div class="card stat-card">
    <div>
        <div class="stat-label">Accountants</div>
        <div class="stat-value">
            {{ \App\Models\User::where('role', 'accountant')->count() }}
        </div>
    </div>
    <div class="stat-icon">💰</div>
</div>

</div>

{{-- Search & Filter --}}

<div class="card" style="margin-bottom: 24px;">


<form method="GET" action="{{ route('users.index') }}"
      style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;">

    <div style="flex:1; min-width:220px;">
        <label for="search" style="display:block; margin-bottom:6px; font-weight:600;">
            Search User
        </label>

        <input
            type="text"
            id="search"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by name or email..."
            style="width:100%;"
        >
    </div>

    <div style="min-width:180px;">
        <label for="role" style="display:block; margin-bottom:6px; font-weight:600;">
            Role
        </label>

        <select name="role" id="role" style="width:100%;">
            <option value="">All Roles</option>
            <option value="admin" @selected(request('role') === 'admin')>
                Admin
            </option>
            <option value="teacher" @selected(request('role') === 'teacher')>
                Teacher
            </option>
            <option value="accountant" @selected(request('role') === 'accountant')>
                Accountant
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        🔍 Search
    </button>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        Reset
    </a>

</form>


</div>

{{-- Users Table --}}

<div class="card">


<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; gap:12px; flex-wrap:wrap;">
    <div>
        <h2 style="margin:0;">System Users</h2>
        <p style="margin:5px 0 0; color:#64748b;">
            Manage user roles and accounts.
        </p>
    </div>
</div>

<div class="table-responsive">

    <table>

        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

                <tr>

                    <td>
                        {{ $users->firstItem() + $loop->index }}
                    </td>

                    <td>
                        <strong>{{ $user->name }}</strong>

                        @if(auth()->id() === $user->id)
                            <span style="
                                display:inline-block;
                                margin-left:6px;
                                padding:3px 8px;
                                border-radius:999px;
                                background:#dbeafe;
                                color:#1d4ed8;
                                font-size:12px;
                                font-weight:600;
                            ">
                                You
                            </span>
                        @endif
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>

                        @if($user->role === 'admin')

                            <span style="
                                display:inline-block;
                                padding:5px 10px;
                                border-radius:999px;
                                background:#fee2e2;
                                color:#b91c1c;
                                font-size:12px;
                                font-weight:700;
                            ">
                                Admin
                            </span>

                        @elseif($user->role === 'accountant')

                            <span style="
                                display:inline-block;
                                padding:5px 10px;
                                border-radius:999px;
                                background:#dcfce7;
                                color:#15803d;
                                font-size:12px;
                                font-weight:700;
                            ">
                                Accountant
                            </span>

                        @else

                            <span style="
                                display:inline-block;
                                padding:5px 10px;
                                border-radius:999px;
                                background:#dbeafe;
                                color:#1d4ed8;
                                font-size:12px;
                                font-weight:700;
                            ">
                                Teacher
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $user->created_at?->format('d M Y') }}
                    </td>

                    <td>

                        <div style="
                            display:flex;
                            justify-content:center;
                            align-items:center;
                            gap:8px;
                            flex-wrap:wrap;
                        ">

                            {{-- Role Update --}}
                            <form
                                method="POST"
                                action="{{ route('users.update-role', $user) }}"
                                style="display:flex; gap:6px; align-items:center;"
                            >

                                @csrf
                                @method('PATCH')

                                <select
                                    name="role"
                                    style="width:auto; min-width:120px; padding:7px 10px;"
                                >
                                    <option value="admin" @selected($user->role === 'admin')>
                                        Admin
                                    </option>

                                    <option value="teacher" @selected($user->role === 'teacher')>
                                        Teacher
                                    </option>

                                    <option value="accountant" @selected($user->role === 'accountant')>
                                        Accountant
                                    </option>
                                </select>

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                            </form>

                            {{-- Delete --}}
                            @if(auth()->id() !== $user->id)

                                <form
                                    method="POST"
                                    action="{{ route('users.destroy', $user) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" style="text-align:center; padding:40px;">
                        No users found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- Pagination --}}
@if($users->hasPages())

    <div style="margin-top:20px;">
        {{ $users->links() }}
    </div>

@endif


</div>

@endsection
