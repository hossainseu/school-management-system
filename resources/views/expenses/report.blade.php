@extends('layouts.school')

@section('content')

    <div class="page-header">
        <div>
            <h1>Expense Report</h1>
            <p>View expense summary, category breakdown and detailed records.</p>
        </div>

        <div class="header-actions">
            <button
                type="button"
                onclick="window.print()"
                class="btn btn-primary print-btn"
            >
                🖨 Print Report
            </button>

            <a
                href="{{ route('expenses.index') }}"
                class="btn btn-secondary"
            >
                ← Expenses
            </a>
        </div>
    </div>

    {{-- Summary --}}
    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-icon">💸</div>

            <div>
                <div class="summary-label">Total Expense</div>

                <div class="summary-value expense-value">
                    ৳{{ number_format($totalExpenses, 2) }}
                </div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">📋</div>

            <div>
                <div class="summary-label">Total Records</div>

                <div class="summary-value">
                    {{ $expenses->count() }}
                </div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">📂</div>

            <div>
                <div class="summary-label">Categories</div>

                <div class="summary-value">
                    {{ $categoryTotals->count() }}
                </div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">📊</div>

            <div>
                <div class="summary-label">Average Expense</div>

                <div class="summary-value expense-value">
                    ৳{{ number_format(
                        $expenses->count() > 0
                            ? $totalExpenses / $expenses->count()
                            : 0,
                        2
                    ) }}
                </div>
            </div>
        </div>

    </div>

    {{-- Search --}}
    <div class="card search-card">

        <form
            method="GET"
            action="{{ route('expense-report') }}"
            class="search-form"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search expense by title, category or reference..."
            >

            <button type="submit" class="btn btn-primary">
                🔍 Search
            </button>

            @if(request('search'))
                <a
                    href="{{ route('expense-report') }}"
                    class="btn btn-secondary"
                >
                    Clear
                </a>
            @endif

        </form>

    </div>

    {{-- Category Summary --}}
    <div class="card table-card">

        <div class="section-header">
            <div>
                <h2>Category Summary</h2>
                <p>Expense total by category.</p>
            </div>
        </div>

        <div class="table-wrapper">

            <table class="category-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categoryTotals as $category => $total)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="category-badge">
                                    {{ $category }}
                                </span>
                            </td>

                            <td>
                                <strong class="amount">
                                    ৳{{ number_format($total, 2) }}
                                </strong>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="empty">
                                No category data found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Expense Details --}}
    <div class="card table-card">

        <div class="section-header">
            <div>
                <h2>Expense Details</h2>
                <p>Detailed list of expense records.</p>
            </div>
        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment Method</th>
                        <th>Reference</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($expenses as $expense)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>{{ $expense->title }}</strong>
                            </td>

                            <td>
                                <span class="category-badge">
                                    {{ $expense->category }}
                                </span>
                            </td>

                            <td>
                                <strong class="amount">
                                    ৳{{ number_format($expense->amount, 2) }}
                                </strong>
                            </td>

                            <td>
                                {{ $expense->expense_date->format('d M Y') }}
                            </td>

                            <td>
                                {{ $expense->payment_method ?: '-' }}
                            </td>

                            <td>
                                {{ $expense->reference_number ?: '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty">
                                No expenses found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection

@push('styles')
<style>

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 20px;
    }

    .summary-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        flex-shrink: 0;
    }

    .summary-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .summary-value {
        font-size: 20px;
        font-weight: 800;
        color: #111827;
    }

    .expense-value {
        color: #dc2626;
    }

    .search-card {
        margin-bottom: 20px;
    }

    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .search-form input {
        flex: 1;
        padding: 11px 14px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        background: #fff;
        color: #1f2937;
    }

    .search-form input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .table-card {
        padding: 0;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .section-header {
        padding: 20px 20px 15px;
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

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .category-table {
        min-width: 500px;
    }

    table th,
    table td {
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        white-space: nowrap;
    }

    table th {
        background: #f9fafb;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    table td {
        color: #374151;
        font-size: 14px;
    }

    table tbody tr:hover {
        background: #f9fafb;
    }

    .amount {
        color: #dc2626;
        font-size: 15px;
    }

    .category-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
    }

    .empty {
        text-align: center !important;
        padding: 45px !important;
        color: #6b7280;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    @media (max-width: 1100px) {

        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 768px) {

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
            text-align: center;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .search-form {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form input,
        .search-form .btn {
            width: 100%;
        }

    }

    @media print {

        .sidebar,
        .header-actions,
        .search-card {
            display: none !important;
        }

        .main {
            margin-left: 0;
            width: 100%;
            padding: 0;
        }

        body {
            background: white;
        }

        .summary-card,
        .table-card {
            box-shadow: none;
        }

    }

</style>
@endpush
