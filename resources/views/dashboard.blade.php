@extends('layouts.school')

@section('content')

<!-- Dashboard Header -->
<div class="page-header dashboard-page-header">

    <div>

        <h1>
            School Management Dashboard
        </h1>

        <p>
            Welcome back,
            <strong>{{ auth()->user()->name }}</strong>.
            You are logged in as
            <strong>{{ ucfirst(auth()->user()->role) }}</strong>.
        </p>

    </div>

    <div class="dashboard-date-box">

        <div class="dashboard-date">
            📅 {{ now()->format('d M Y') }}
        </div>

        <div class="dashboard-time">
            🕒 {{ now()->format('h:i A') }}
        </div>

    </div>

</div>


<!-- Statistics -->
<h2 class="section-title">📊 Overview</h2>

<div class="stats-grid">

    <div class="stat-card">

    <div class="stat-icon">👨‍🎓</div>

    <h3>Total Students</h3>

    <div class="number">
        {{ $studentCount }}
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
        <a href="{{ route('students.index') }}" class="dashboard-view-link">
            View Students →
        </a>
    @endif

</div>

    <div class="stat-card">

    <div class="stat-icon">👨‍🏫</div>

    <h3>Total Teachers</h3>

    <div class="number">
        {{ $teacherCount }}
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
        <a href="{{ route('teachers.index') }}" class="dashboard-view-link">
            View Teachers →
        </a>
    @endif

</div>

   <div class="stat-card">

    <div class="stat-icon">🏫</div>

    <h3>Total Classes</h3>

    <div class="number">
        {{ $classCount }}
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
        <a href="{{ route('classes.index') }}" class="dashboard-view-link">
            View Classes →
        </a>
    @endif

</div>

    <div class="stat-card">

    <div class="stat-icon">📚</div>

    <h3>Total Subjects</h3>

    <div class="number">
        {{ $subjectCount }}
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
        <a href="{{ route('subjects.index') }}" class="dashboard-view-link">
            View Subjects →
        </a>
    @endif

</div>


</div>

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')

    <!-- Attendance -->
    <h2 class="section-title">📋 Today's Attendance</h2>

    <div class="stats-grid">

        <div class="stat-card">
            <h3>Total Attendance</h3>
            <div class="number">{{ $todayAttendance }}</div>
        </div>

        <div class="stat-card">
            <h3>Present</h3>
            <div class="number">{{ $presentCount }}</div>
        </div>

        <div class="stat-card">
            <h3>Absent</h3>
            <div class="number">{{ $absentCount }}</div>
        </div>

        <div class="stat-card">
            <h3>Late</h3>
            <div class="number">{{ $lateCount }}</div>
        </div>

    </div>

@endif

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
<!-- Recent Results -->
<h2 class="section-title">📝 Recent Results</h2>

<div class="card" style="overflow-x: auto;">

    <table style="width: 100%; border-collapse: collapse;">

        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Exam</th>
                <th>Marks</th>
                <th>Grade</th>
            </tr>
        </thead>

        <tbody>

            @forelse($recentResults as $result)

                <tr>
                    <td>
                        {{ $result->student->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $result->subject->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $result->exam_name }}
                    </td>

                    <td>
                        {{ $result->marks }}
                    </td>

                    <td>
                        <strong>
                            {{ $result->grade }}
                        </strong>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align: center; padding: 25px;">
                        No results found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>
@endif

<!-- Quick Actions -->

<h2 class="section-title">⚡ Quick Actions</h2>

<div class="quick-actions-grid">

    {{-- Academic Actions --}}
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')

        <a href="{{ route('students.create') }}" class="quick-action-card">
            <div class="quick-action-icon">👨‍🎓</div>

            <div>
                <strong>Add Student</strong>
                <span>Create a new student record</span>
            </div>
        </a>


        <a href="{{ route('teachers.create') }}" class="quick-action-card">
            <div class="quick-action-icon">👨‍🏫</div>

            <div>
                <strong>Add Teacher</strong>
                <span>Create a new teacher record</span>
            </div>
        </a>


        <a href="{{ route('classes.create') }}" class="quick-action-card">
            <div class="quick-action-icon">🏫</div>

            <div>
                <strong>Add Class</strong>
                <span>Create a new class</span>
            </div>
        </a>


        <a href="{{ route('subjects.create') }}" class="quick-action-card">
            <div class="quick-action-icon">📚</div>

            <div>
                <strong>Add Subject</strong>
                <span>Create a new subject</span>
            </div>
        </a>


        <a href="{{ route('attendances.create') }}" class="quick-action-card">
            <div class="quick-action-icon">📅</div>

            <div>
                <strong>Mark Attendance</strong>
                <span>Record student attendance</span>
            </div>
        </a>


        <a href="{{ route('results.create') }}" class="quick-action-card">
            <div class="quick-action-icon">📝</div>

            <div>
                <strong>Add Result</strong>
                <span>Enter marks and GPA</span>
            </div>
        </a>

    @endif


    {{-- Finance Actions --}}
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')

        <a href="{{ route('fees.create') }}" class="quick-action-card">
            <div class="quick-action-icon">💰</div>

            <div>
                <strong>Add Fee</strong>
                <span>Record student fee</span>
            </div>
        </a>


        <a href="{{ route('expenses.create') }}" class="quick-action-card">
            <div class="quick-action-icon">💸</div>

            <div>
                <strong>Add Expense</strong>
                <span>Record school expense</span>
            </div>
        </a>


        <a href="{{ route('incomes.create') }}" class="quick-action-card">
            <div class="quick-action-icon">💵</div>

            <div>
                <strong>Add Income</strong>
                <span>Record school income</span>
            </div>
        </a>


        <a href="{{ route('income-report') }}" class="quick-action-card">
            <div class="quick-action-icon">📊</div>

            <div>
                <strong>Finance Reports</strong>
                <span>View income and finance reports</span>
            </div>
        </a>

    @endif

</div>
@if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')
<!-- Fees -->
<div class="dashboard-section-header">

    <h2 class="section-title">💰 Fee Overview</h2>

    <div class="dashboard-section-actions">
        <a href="{{ route('fees.index') }}" class="dashboard-action-link">
            View Fees →
        </a>

        <a href="{{ route('fee-report') }}" class="dashboard-action-link">
            Fee Report →
        </a>
    </div>

</div>


<div class="financial-grid">

    <div class="financial-card">
        <h3>Total Fees</h3>
        <div class="amount">
            ৳ {{ number_format($totalFees, 2) }}
        </div>
    </div>

    <div class="financial-card">
        <h3>Paid Fees</h3>
        <div class="amount">
            ৳ {{ number_format($paidFees, 2) }}
        </div>
    </div>

    <div class="financial-card">
        <h3>Unpaid / Due</h3>
        <div class="amount">
            ৳ {{ number_format($unpaidFees, 2) }}
        </div>
    </div>

</div>
@endif

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')
<!-- Expenses -->
<div class="dashboard-section-header">

    <h2 class="section-title">💸 Expense Overview</h2>

    <div class="dashboard-section-actions">
        <a href="{{ route('expenses.index') }}" class="dashboard-action-link">
            View Expenses →
        </a>

        <a href="{{ route('expense-report') }}" class="dashboard-action-link">
            Expense Report →
        </a>
    </div>

</div>

<div class="financial-grid">

    <div class="financial-card">
        <h3>Total Expenses</h3>
        <div class="amount">
            ৳ {{ number_format($totalExpenses, 2) }}
        </div>
    </div>

    <div class="financial-card">
        <h3>Expense Records</h3>
        <div class="amount">
            {{ $expenseCount }}
        </div>
    </div>

    <div class="financial-card">
        <h3>This Month</h3>
        <div class="amount">
            ৳ {{ number_format($monthlyExpenses, 2) }}
        </div>
    </div>

</div>
@endif

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')
<!-- Income -->
<div class="dashboard-section-header">

    <h2 class="section-title">💵 Income Overview</h2>

    <div class="dashboard-section-actions">
        <a href="{{ route('incomes.index') }}" class="dashboard-action-link">
            View Income →
        </a>

        <a href="{{ route('income-report') }}" class="dashboard-action-link">
            Income Report →
        </a>
    </div>

</div>

<div class="financial-grid">

    <div class="financial-card">

        <h3>Total Income</h3>

        <div class="amount">
            ৳ {{ number_format($totalIncome, 2) }}
        </div>

    </div>

    <div class="financial-card">

        <h3>Income Records</h3>

        <div class="amount">
            {{ $incomeCount }}
        </div>

    </div>

    <div class="financial-card">

        <h3>This Month</h3>

        <div class="amount">
            ৳ {{ number_format($monthlyIncome, 2) }}
        </div>

    </div>

</div>
@endif

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')
<!-- Financial Summary -->
<div class="dashboard-section-header">

    <h2 class="section-title">📊 Financial Summary</h2>

    <div class="dashboard-section-actions">

        <a href="{{ route('fee-report') }}" class="dashboard-action-link">
            Fee Report →
        </a>

        <a href="{{ route('expense-report') }}" class="dashboard-action-link">
            Expense Report →
        </a>

        <a href="{{ route('income-report') }}" class="dashboard-action-link">
            Income Report →
        </a>

    </div>

</div>

<div class="financial-grid">

    <div class="financial-card">

        <h3>Total Income</h3>

        <div class="amount">
            ৳ {{ number_format($totalIncome, 2) }}
        </div>

    </div>

    <div class="financial-card">

        <h3>Total Expense</h3>

        <div class="amount">
            ৳ {{ number_format($totalExpenses, 2) }}
        </div>

    </div>

    <div class="financial-card">

        <h3>Net Balance</h3>

        <div class="amount">
            ৳ {{ number_format($netBalance, 2) }}
        </div>

    </div>

</div>
@endif

<!-- Recent Activity -->
<!-- Dashboard Alerts -->

@if(count($dashboardAlerts))

    <h2 class="section-title">🔔 Important Notifications</h2>

    <div class="dashboard-alerts">

        @foreach($dashboardAlerts as $alert)

            <div class="dashboard-alert alert-{{ $alert['type'] }}">

                <div class="dashboard-alert-icon">
                    {{ $alert['icon'] }}
                </div>

                <div class="dashboard-alert-content">

                    <strong>
                        {{ $alert['title'] }}
                    </strong>

                    <p>
                        {{ $alert['message'] }}
                    </p>

                </div>

                <a href="{{ $alert['url'] }}" class="dashboard-alert-action">
                    {{ $alert['action'] }} →
                </a>

            </div>

        @endforeach

    </div>

@else

    <h2 class="section-title">🔔 System Status</h2>

    <div class="dashboard-alert alert-success">

        <div class="dashboard-alert-icon">
            ✅
        </div>

        <div class="dashboard-alert-content">

            <strong>
                All Systems Running Normally
            </strong>

            <p>
                There are no important alerts at the moment.
            </p>

        </div>

    </div>

@endif

<div class="dashboard-section-header">
    <h2 class="section-title">🔔 Recent Activity</h2>

    <div class="dashboard-section-actions">

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
            <a href="{{ route('attendances.index') }}"
               class="dashboard-action-link">
                Attendance →
            </a>

            <a href="{{ route('results.index') }}"
               class="dashboard-action-link">
                Results →
            </a>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')
            <a href="{{ route('fees.index') }}"
               class="dashboard-action-link">
                Fees →
            </a>

            <a href="{{ route('expenses.index') }}"
               class="dashboard-action-link">
                Expenses →
            </a>

            <a href="{{ route('incomes.index') }}"
               class="dashboard-action-link">
                Income →
            </a>
        @endif

    </div>
</div>

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')

    <div class="activity-grid">

        <!-- Recent Attendance -->

        <div class="activity-card">

            <div class="activity-card-header">
                <div>
                    <h3>📅 Recent Attendance</h3>
                    <p>Latest student attendance records</p>
                </div>

                <a href="{{ route('attendances.index') }}">
                    View All
                </a>
            </div>

            @forelse($recentAttendances as $attendance)

                <div class="activity-item">

                    <div class="activity-icon attendance-icon">
                        📅
                    </div>

                    <div class="activity-content">

                        <strong>
                            {{ $attendance->student->name ?? 'N/A' }}
                        </strong>

                        <span>
                            {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                        </span>

                    </div>

                    <span class="activity-status status-{{ $attendance->status }}">
                        {{ ucfirst($attendance->status) }}
                    </span>

                </div>

            @empty

                <div class="activity-empty">
                    No recent attendance records.
                </div>

            @endforelse

        </div>


        <!-- Recent Results -->

        <div class="activity-card">

            <div class="activity-card-header">
                <div>
                    <h3>📝 Recent Results</h3>
                    <p>Latest student results</p>
                </div>

                <a href="{{ route('results.index') }}">
                    View All
                </a>
            </div>

            @forelse($recentResults as $result)

                <div class="activity-item">

                    <div class="activity-icon result-icon">
                        📝
                    </div>

                    <div class="activity-content">

                        <strong>
                            {{ $result->student->name ?? 'N/A' }}
                        </strong>

                        <span>
                            {{ $result->subject->name ?? 'N/A' }}
                            • {{ $result->exam_name }}
                        </span>

                    </div>

                    <span class="activity-grade">
                        {{ $result->grade }}
                    </span>

                </div>

            @empty

                <div class="activity-empty">
                    No recent results.
                </div>

            @endforelse

        </div>

    </div>

@endif


@if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')

    <div class="activity-grid">

        <!-- Recent Fees -->

        <div class="activity-card">

            <div class="activity-card-header">

                <div>
                    <h3>💰 Recent Fees</h3>
                    <p>Latest fee records</p>
                </div>

                <a href="{{ route('fees.index') }}">
                    View All
                </a>

            </div>

            @forelse($recentFees as $fee)

                <div class="activity-item">

                    <div class="activity-icon fee-icon">
                        💰
                    </div>

                    <div class="activity-content">

                        <strong>
                            {{ $fee->student->name ?? 'N/A' }}
                        </strong>

                        <span>
                            {{ $fee->fee_type }}
                        </span>

                    </div>

                    <strong class="activity-amount">
                        ৳ {{ number_format($fee->amount, 2) }}
                    </strong>

                </div>

            @empty

                <div class="activity-empty">
                    No recent fee records.
                </div>

            @endforelse

        </div>


        <!-- Recent Expenses -->

        <div class="activity-card">

            <div class="activity-card-header">

                <div>
                    <h3>💸 Recent Expenses</h3>
                    <p>Latest expense records</p>
                </div>

                <a href="{{ route('expenses.index') }}">
                    View All
                </a>

            </div>

            @forelse($recentExpenses as $expense)

                <div class="activity-item">

                    <div class="activity-icon expense-icon">
                        💸
                    </div>

                    <div class="activity-content">

                        <strong>
                            {{ $expense->title }}
                        </strong>

                        <span>
                            {{ $expense->category }}
                        </span>

                    </div>

                    <strong class="activity-amount">
                        ৳ {{ number_format($expense->amount, 2) }}
                    </strong>

                </div>

            @empty

                <div class="activity-empty">
                    No recent expense records.
                </div>

            @endforelse

        </div>


        <!-- Recent Income -->

        <div class="activity-card">

            <div class="activity-card-header">

                <div>
                    <h3>💵 Recent Income</h3>
                    <p>Latest income records</p>
                </div>

                <a href="{{ route('incomes.index') }}">
                    View All
                </a>

            </div>

            @forelse($recentIncome as $income)

                <div class="activity-item">

                    <div class="activity-icon income-icon">
                        💵
                    </div>

                    <div class="activity-content">

                        <strong>
                            {{ $income->title }}
                        </strong>

                        <span>
                            {{ $income->category }}
                        </span>

                    </div>

                    <strong class="activity-amount">
                        ৳ {{ number_format($income->amount, 2) }}
                    </strong>

                </div>

            @empty

                <div class="activity-empty">
                    No recent income records.
                </div>

            @endforelse

        </div>

    </div>

@endif


@if(auth()->user()->role === 'admin' || auth()->user()->role === 'accountant')
<!-- Monthly Chart -->
<h2 class="section-title">📈 Monthly Financial Summary</h2>

<div class="chart-card">

    <div class="chart-container">

        <canvas id="financialChart"></canvas>

    </div>

</div>
@endif

@endsection

@push('styles')

<style>

/* ==========================================
   DASHBOARD GENERAL
   ========================================== */

.section-title {
    font-size: 20px;
    margin: 25px 0 15px;
    color: #1e293b;
}

.dashboard-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin: 25px 0 15px;
}

.dashboard-section-header .section-title {
    margin: 0;
}

.dashboard-section-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.dashboard-action-link,
.dashboard-view-link,
.activity-view-link {
    color: #2563eb;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
}

.dashboard-action-link:hover,
.dashboard-view-link:hover,
.activity-view-link:hover {
    text-decoration: underline;
}


/* ==========================================
   DASHBOARD HEADER
   ========================================== */

.dashboard-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 10px;
}

.dashboard-page-header h1 {
    margin-bottom: 6px;
}

.dashboard-page-header p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}

.dashboard-page-header p strong {
    color: #1e293b;
}

.dashboard-date-box {
    min-width: 170px;
    padding: 14px 18px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    text-align: center;
}

.dashboard-date {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.dashboard-time {
    font-size: 12px;
    color: #64748b;
}


/* ==========================================
   STATISTICS
   ========================================== */

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
}

.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(15,23,42,0.08);
}

.stat-card h3 {
    font-size: 14px;
    color: #64748b;
    margin: 0 0 10px;
}

.stat-card .number {
    font-size: 30px;
    font-weight: 700;
    color: #1e293b;
}

.stat-icon {
    font-size: 28px;
    margin-bottom: 10px;
}

.dashboard-view-link {
    display: inline-block;
    margin-top: 12px;
}


/* ==========================================
   COMMON CARD
   ========================================== */

.card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.card table {
    width: 100%;
    border-collapse: collapse;
}

.card table th,
.card table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.card table th {
    background: #f8fafc;
}


/* ==========================================
   QUICK ACTIONS
   ========================================== */

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 30px;
}

.quick-action-card {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    padding-right: 45px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    text-decoration: none;
    color: #111827;
    transition: transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
}

.quick-action-card:hover {
    transform: translateY(-3px);
    border-color: #bfdbfe;
    box-shadow: 0 10px 25px rgba(15,23,42,0.08);
}

.quick-action-card::after {
    content: "→";
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 18px;
    font-weight: 700;
    color: #cbd5e1;
    transition: 0.2s ease;
}

.quick-action-card:hover::after {
    right: 10px;
    color: #2563eb;
}

.quick-action-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 10px;
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: transform 0.2s ease,
                background 0.2s ease;
}

.quick-action-card:hover .quick-action-icon {
    transform: scale(1.08);
    background: #dbeafe;
}

.quick-action-card strong {
    display: block;
    margin-bottom: 4px;
    font-size: 14px;
    transition: color 0.2s ease;
}

.quick-action-card:hover strong {
    color: #2563eb;
}

.quick-action-card span {
    display: block;
    color: #64748b;
    font-size: 11px;
    line-height: 1.4;
}


/* ==========================================
   FINANCIAL CARDS
   ========================================== */

.financial-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
}

.financial-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.financial-card h3 {
    color: #64748b;
    font-size: 14px;
    margin: 0 0 10px;
}

.financial-card .amount {
    font-size: 26px;
    font-weight: 700;
    color: #1e293b;
}


/* ==========================================
   CHART
   ========================================== */

.chart-card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.chart-container {
    position: relative;
    height: 350px;
}


/* ==========================================
   RECENT ACTIVITY
   ========================================== */

.activity-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 25px;
}

.activity-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s ease,
                box-shadow 0.2s ease;
}

.activity-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(15,23,42,0.08);
}

.activity-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e2e8f0;
}

.activity-card-header h3 {
    margin: 0 0 4px;
    font-size: 16px;
    color: #1e293b;
}

.activity-card-header p {
    margin: 0;
    font-size: 12px;
    color: #64748b;
}

.activity-card-header a {
    color: #2563eb;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.activity-card-header a:hover {
    text-decoration: underline;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s ease;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-item:hover {
    background: #f8fafc;
}

.activity-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.attendance-icon {
    background: #eff6ff;
}

.result-icon {
    background: #f5f3ff;
}

.fee-icon {
    background: #ecfdf5;
}

.expense-icon {
    background: #fef2f2;
}

.income-icon {
    background: #ecfdf5;
}

.activity-content {
    flex: 1;
    min-width: 0;
}

.activity-content strong {
    display: block;
    color: #1e293b;
    font-size: 14px;
    margin-bottom: 3px;
}

.activity-content span {
    display: block;
    color: #64748b;
    font-size: 12px;
}

.activity-content small {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
    font-size: 11px;
}

.activity-status,
.activity-grade {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.status-present {
    background: #dcfce7;
    color: #15803d;
}

.status-absent {
    background: #fee2e2;
    color: #b91c1c;
}

.status-late {
    background: #fef3c7;
    color: #b45309;
}

.activity-grade {
    background: #dbeafe;
    color: #1d4ed8;
}

.activity-amount {
    color: #1e293b;
    font-size: 13px;
    white-space: nowrap;
}

.activity-empty {
    padding: 20px;
    text-align: center;
    color: #64748b;
    font-size: 13px;
}


/* ==========================================
   DASHBOARD ALERTS
   ========================================== */

.dashboard-alerts {
    display: grid;
    gap: 12px;
    margin-bottom: 25px;
}

.dashboard-alert {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 16px 18px;
    background: #fff;
    border-radius: 12px;
    border-left: 4px solid #2563eb;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.dashboard-alert-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.dashboard-alert-content {
    flex: 1;
}

.dashboard-alert-content strong {
    display: block;
    font-size: 14px;
    color: #1e293b;
    margin-bottom: 4px;
}

.dashboard-alert-content p {
    margin: 0;
    font-size: 12px;
    color: #64748b;
}

.dashboard-alert-action {
    color: #2563eb;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.dashboard-alert-action:hover {
    text-decoration: underline;
}

.alert-warning {
    border-left-color: #f59e0b;
}

.alert-warning .dashboard-alert-icon {
    background: #fef3c7;
}

.alert-info {
    border-left-color: #2563eb;
}

.alert-info .dashboard-alert-icon {
    background: #dbeafe;
}

.alert-danger {
    border-left-color: #dc2626;
}

.alert-danger .dashboard-alert-icon {
    background: #fee2e2;
}

.alert-success {
    border-left-color: #16a34a;
}

.alert-success .dashboard-alert-icon {
    background: #dcfce7;
}


/* ==========================================
   RESPONSIVE
   ========================================== */

@media (max-width: 1100px) {

    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .quick-actions-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .financial-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .activity-grid {
        grid-template-columns: 1fr;
    }
}


@media (max-width: 768px) {

    .dashboard-page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .dashboard-date-box {
        width: 100%;
        box-sizing: border-box;
        text-align: left;
    }

    .stats-grid,
    .quick-actions-grid,
    .financial-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .dashboard-section-actions {
        width: 100%;
    }

    .dashboard-action-link {
        flex: 1;
        justify-content: center;
    }

    .activity-card {
        padding: 16px;
    }

    .activity-card-header {
        align-items: flex-start;
    }

    .activity-item {
        gap: 9px;
    }

    .activity-icon {
        width: 34px;
        height: 34px;
        min-width: 34px;
        font-size: 16px;
    }

    .activity-content strong {
        font-size: 13px;
    }

    .activity-content span {
        font-size: 11px;
    }

    .activity-status,
    .activity-grade {
        font-size: 10px;
        padding: 4px 7px;
    }

    .activity-amount {
        font-size: 12px;
    }

    .dashboard-alert {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .dashboard-alert-content {
        min-width: 0;
    }

    .dashboard-alert-action {
        width: 100%;
        margin-left: 57px;
    }

    .quick-action-card {
        padding: 15px;
        padding-right: 45px;
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        font-size: 19px;
    }

    .quick-action-card strong {
        font-size: 13px;
    }

    .quick-action-card span {
        font-size: 11px;
    }

    .chart-container {
        height: 280px;
    }
}


@media (max-width: 480px) {

    .section-title {
        font-size: 18px;
    }

    .stat-card,
    .financial-card,
    .chart-card {
        padding: 16px;
    }

    .stat-card .number {
        font-size: 26px;
    }

    .financial-card .amount {
        font-size: 23px;
    }

    .dashboard-alert {
        padding: 14px;
    }

    .dashboard-alert-action {
        margin-left: 0;
    }

    .chart-container {
        height: 240px;
    }
}

</style>

@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const labels = @json($monthlyLabels);

    const incomeData = @json($monthlyIncomeData);

    const expenseData = @json($monthlyExpenseData);

    const ctx = document.getElementById('financialChart');

    if (ctx) {

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: labels,

                datasets: [

                    {
                        label: 'Monthly Income',
                        data: incomeData
                    },

                    {
                        label: 'Monthly Expense',
                        data: expenseData
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {
                        beginAtZero: true
                    }

                }

            }

        });

    }

</script>

@endpush
