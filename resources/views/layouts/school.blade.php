<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'School Management System' }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 260px;
            background: #0f172a;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            height: 85px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .school-logo {
            width: 48px;
            height: 48px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .sidebar-header h2 {
            font-size: 18px;
            color: white;
            margin: 0;
        }

        .sidebar-header span {
            display: block;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 3px;
        }

        .sidebar-menu {
            padding: 18px 12px;
        }

        .menu-label {
            font-size: 10px;
            font-weight: bold;
            color: #64748b;
            padding: 14px 12px 7px;
            letter-spacing: 1px;
        }

        .sidebar-menu a,
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;

            color: #cbd5e1;
            text-decoration: none;

            padding: 11px 13px;
            margin: 3px 0;

            border-radius: 9px;
            border: none;
            background: transparent;

            font-size: 14px;
            font-family: inherit;

            cursor: pointer;
            text-align: left;

            transition: all 0.2s ease;
        }

        .sidebar-menu a:hover,
        .logout-btn:hover {
            background: rgba(255,255,255,0.08);
            color: white;
            transform: translateX(2px);
        }

        .sidebar-menu a.active {
            background: #2563eb;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37,99,235,0.25);
        }

        .menu-icon {
            width: 24px;
            min-width: 24px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar form {
            margin: 0;
            padding: 0;
        }

        /* =========================
           MOBILE HEADER
        ========================= */

        .mobile-header {
            display: none;
        }

        .mobile-menu-btn {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 9px;
            background: #2563eb;
            color: white;
            font-size: 22px;
            cursor: pointer;
        }

        .mobile-title {
            font-size: 17px;
            font-weight: bold;
            color: #1e293b;
        }

        .sidebar-overlay {
            display: none;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 30px;
        }

        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .page-header h1 {
            font-size: 25px;
            color: #1e293b;
        }

        .page-header p {
            margin-top: 5px;
            color: #64748b;
            font-size: 14px;
        }

        /* =========================
           BUTTONS
        ========================= */

        .btn {
            display: inline-block;
            padding: 10px 17px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .btn-success:hover {
            background: #15803d;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        /* =========================
           ALERT / NOTIFICATION
        ========================= */

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .notification {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            border: 1px solid transparent;
            animation: notificationSlide 0.35s ease;
        }

        .notification-icon {
            width: 28px;
            height: 28px;
            min-width: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
        }

        .notification-message {
            flex: 1;
            font-size: 14px;
            font-weight: 600;
        }

        .notification-close {
            width: 28px;
            height: 28px;
            border: none;
            background: transparent;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            opacity: 0.6;
        }

        .notification-close:hover {
            opacity: 1;
        }

        .alert-success {
            background: #ecfdf5;
            color: #166534;
            border-color: #bbf7d0;
        }

        .alert-success .notification-icon {
            background: #22c55e;
            color: white;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .alert-error .notification-icon {
            background: #ef4444;
            color: white;
        }

        @keyframes notificationSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================
           TABLE
        ========================= */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            background: white;
            border-radius: 12px;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table th {
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            text-align: left;
            padding: 13px 15px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        table td {
            padding: 13px 15px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        table tbody tr:hover {
            background: #f8fafc;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           FORM INPUT
        ========================= */

        input,
        select,
        textarea {
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
        }

        /* =========================
           CARD
        ========================= */

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 768px) {

            body {
                overflow-x: hidden;
            }

            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.45);
                z-index: 999;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 15px;
                padding-top: 75px;
            }

            .mobile-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 60px;

                background: white;

                display: flex;
                align-items: center;
                gap: 12px;

                padding: 9px 15px;

                z-index: 998;

                box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 18px;
            }

            .page-header h1 {
                font-size: 21px;
            }

            .page-header .btn {
                width: 100%;
                text-align: center;
            }

            table {
                min-width: 700px;
            }

            .btn {
                padding: 9px 13px;
                font-size: 13px;
            }
        }

        /* =========================
           SMALL MOBILE
        ========================= */

        @media (max-width: 480px) {

            .main {
                padding: 12px;
                padding-top: 72px;
            }

            .mobile-title {
                font-size: 15px;
            }

            .page-header {
                border-radius: 10px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="layout">

    <!-- MOBILE HEADER -->

    <div class="mobile-header">

        <button
            type="button"
            class="mobile-menu-btn"
            onclick="toggleSidebar()"
            aria-label="Open Menu">
            ☰
        </button>

        <div class="mobile-title">
            🏫 School Management System
        </div>

    </div>


    <!-- SIDEBAR -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="school-logo">
                🏫
            </div>

            <div>
                <h2>School ERP</h2>
                <span>Management System</span>
            </div>

        </div>


        <div class="sidebar-menu">

  <div class="menu-label">
    MAIN MENU
</div>

<a href="{{ route('dashboard') }}"
   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

    <span class="menu-icon">🏠</span>
    <span>Dashboard</span>

</a>

@role('admin')
    <a href="{{ route('students.index') }}"
       class="{{ request()->routeIs('students.*') ? 'active' : '' }}">

        <span class="menu-icon">👨‍🎓</span>
        <span>Students</span>

    </a>

    <a href="{{ route('teachers.index') }}"
       class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">

        <span class="menu-icon">👨‍🏫</span>
        <span>Teachers</span>

    </a>

    <a href="{{ route('classes.index') }}"
       class="{{ request()->routeIs('classes.*') ? 'active' : '' }}">

        <span class="menu-icon">🏫</span>
        <span>Classes</span>

    </a>

    <a href="{{ route('subjects.index') }}"
       class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">

        <span class="menu-icon">📚</span>
        <span>Subjects</span>

    </a>
@endrole

@role('teacher')
    <a href="{{ route('students.index') }}"
       class="{{ request()->routeIs('students.*') ? 'active' : '' }}">

        <span class="menu-icon">👨‍🎓</span>
        <span>Students</span>

    </a>

    <a href="{{ route('teachers.index') }}"
       class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">

        <span class="menu-icon">👨‍🏫</span>
        <span>Teachers</span>

    </a>

    <a href="{{ route('classes.index') }}"
       class="{{ request()->routeIs('classes.*') ? 'active' : '' }}">

        <span class="menu-icon">🏫</span>
        <span>Classes</span>

    </a>

    <a href="{{ route('subjects.index') }}"
       class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">

        <span class="menu-icon">📚</span>
        <span>Subjects</span>

    </a>
@endrole

           <div class="menu-label">
    ACADEMIC
</div>

@role('admin')
    <a href="{{ route('attendances.index') }}"
       class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">

        <span class="menu-icon">📋</span>
        <span>Attendance</span>

    </a>

    <a href="{{ route('results.index') }}"
       class="{{ request()->routeIs('results.*') ? 'active' : '' }}">

        <span class="menu-icon">📝</span>
        <span>Results</span>

    </a>

    <a href="{{ route('student-result-report') }}"
       class="{{ request()->routeIs('student-result-report') ? 'active' : '' }}">

        <span class="menu-icon">📄</span>
        <span>Result Report</span>

    </a>
@endrole

@role('teacher')
    <a href="{{ route('attendances.index') }}"
       class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">

        <span class="menu-icon">📋</span>
        <span>Attendance</span>

    </a>

    <a href="{{ route('results.index') }}"
       class="{{ request()->routeIs('results.*') ? 'active' : '' }}">

        <span class="menu-icon">📝</span>
        <span>Results</span>

    </a>

    <a href="{{ route('student-result-report') }}"
       class="{{ request()->routeIs('student-result-report') ? 'active' : '' }}">

        <span class="menu-icon">📄</span>
        <span>Result Report</span>

    </a>
@endrole

@role('admin')
    <div class="menu-label">
        FINANCE
    </div>

    <a href="{{ route('fees.index') }}"
       class="{{ request()->routeIs('fees.*') ? 'active' : '' }}">

        <span class="menu-icon">💰</span>
        <span>Fees</span>

    </a>

    <a href="{{ route('fee-report') }}"
       class="{{ request()->routeIs('fee-report') ? 'active' : '' }}">

        <span class="menu-icon">📊</span>
        <span>Fee Report</span>

    </a>

    <a href="{{ route('expenses.index') }}"
       class="{{ request()->routeIs('expenses.*') ? 'active' : '' }}">

        <span class="menu-icon">💸</span>
        <span>Expenses</span>

    </a>

    <a href="{{ route('expense-report') }}"
       class="{{ request()->routeIs('expense-report') ? 'active' : '' }}">

        <span class="menu-icon">📊</span>
        <span>Expense Report</span>

    </a>

    <a href="{{ route('incomes.index') }}"
       class="{{ request()->routeIs('incomes.*') ? 'active' : '' }}">

        <span class="menu-icon">💵</span>
        <span>Income</span>

    </a>

    <a href="{{ route('income-report') }}"
       class="{{ request()->routeIs('income-report') ? 'active' : '' }}">

        <span class="menu-icon">📊</span>
        <span>Income Report</span>

    </a>
@endrole

@role('accountant')
    <div class="menu-label">
        FINANCE
    </div>

    <a href="{{ route('fees.index') }}"
       class="{{ request()->routeIs('fees.*') ? 'active' : '' }}">

        <span class="menu-icon">💰</span>
        <span>Fees</span>

    </a>

    <a href="{{ route('fee-report') }}"
       class="{{ request()->routeIs('fee-report') ? 'active' : '' }}">

        <span class="menu-icon">📊</span>
        <span>Fee Report</span>

    </a>

    <a href="{{ route('expenses.index') }}"
       class="{{ request()->routeIs('expenses.*') ? 'active' : '' }}">

        <span class="menu-icon">💸</span>
        <span>Expenses</span>

    </a>

    <a href="{{ route('expense-report') }}"
       class="{{ request()->routeIs('expense-report') ? 'active' : '' }}">

        <span class="menu-icon">📊</span>
        <span>Expense Report</span>

    </a>

    <a href="{{ route('incomes.index') }}"
       class="{{ request()->routeIs('incomes.*') ? 'active' : '' }}">

        <span class="menu-icon">💵</span>
        <span>Income</span>

    </a>

    <a href="{{ route('income-report') }}"
       class="{{ request()->routeIs('income-report') ? 'active' : '' }}">

        <span class="menu-icon">📊</span>
        <span>Income Report</span>

    </a>
@endrole


           <div class="menu-label">
    ACCOUNT
</div>

@role('admin')
    <a href="{{ route('users.index') }}"
       class="{{ request()->routeIs('users.*') ? 'active' : '' }}">

        <span class="menu-icon">👥</span>
        <span>User Management</span>

    </a>
@endrole

<a href="{{ route('profile.edit') }}"
   class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">

    <span class="menu-icon">👤</span>
    <span>Profile</span>

</a>

<form method="POST" action="{{ route('logout') }}" style="margin: 0;">
    @csrf

    <button type="submit"
            style="
                width: 100%;
                border: none;
                background: transparent;
                color: inherit;
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 16px;
                cursor: pointer;
                font-size: inherit;
                text-align: left;
            ">

        <span class="menu-icon">🚪</span>
        <span>Logout</span>

    </button>
</form>

       

        </div>

    </aside>


    <!-- SIDEBAR OVERLAY -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeSidebar()">
    </div>


    <!-- MAIN -->

    <main class="main">

        @if(session('success'))

            <div class="alert alert-success notification"
                 id="successNotification">

                <span class="notification-icon">✓</span>

                <span class="notification-message">
                    {{ session('success') }}
                </span>

                <button
                    type="button"
                    class="notification-close"
                    onclick="closeNotification('successNotification')">
                    ×
                </button>

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-error notification"
                 id="errorNotification">

                <span class="notification-icon">!</span>

                <span class="notification-message">
                    {{ session('error') }}
                </span>

                <button
                    type="button"
                    class="notification-close"
                    onclick="closeNotification('errorNotification')">
                    ×
                </button>

            </div>

        @endif


        @yield('content')

    </main>

</div>


<script>

    /* =========================
       SIDEBAR
    ========================= */

    function toggleSidebar() {

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    }


    function closeSidebar() {

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }


    document.querySelectorAll('.sidebar a').forEach(function(link) {

        link.addEventListener('click', function() {

            if (window.innerWidth <= 768) {
                closeSidebar();
            }

        });

    });


    /* =========================
       NOTIFICATIONS
    ========================= */

    function closeNotification(id) {

        const notification = document.getElementById(id);

        if (notification) {

            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-10px)';

            setTimeout(function () {
                notification.remove();
            }, 300);

        }
    }


    setTimeout(function () {

        const success = document.getElementById('successNotification');
        const error = document.getElementById('errorNotification');

        if (success) {
            closeNotification('successNotification');
        }

        if (error) {
            closeNotification('errorNotification');
        }

    }, 4000);

</script>


@stack('scripts')

</body>
</html>

