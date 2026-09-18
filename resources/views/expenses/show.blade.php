@extends('layouts.school')

@section('content')

    <div class="page-header">

        <div>
            <h1>Expense Details</h1>
            <p>View complete expense and payment information.</p>
        </div>

        <div class="header-actions">

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-secondary print-btn"
            >
                🖨 Print
            </button>

            <a
                href="{{ route('expenses.edit', $expense) }}"
                class="btn btn-edit"
            >
                ✎ Edit
            </a>

            <a
                href="{{ route('expenses.index') }}"
                class="btn btn-primary"
            >
                ← Expenses
            </a>

        </div>

    </div>

    <div class="card expense-details-card">

        <div class="expense-header">

            <div class="expense-icon">
                💸
            </div>

            <div>
                <h2>{{ $expense->title }}</h2>

                <p>
                    Expense ID:
                    <strong>#{{ $expense->id }}</strong>
                </p>
            </div>

        </div>

        <div class="details-grid">

            <div class="detail">
                <span class="label">Expense Title</span>

                <span class="value">
                    {{ $expense->title }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Category</span>

                <span class="value">
                    <span class="category-badge">
                        {{ $expense->category }}
                    </span>
                </span>
            </div>

            <div class="detail">
                <span class="label">Amount</span>

                <span class="value amount">
                    ৳{{ number_format($expense->amount, 2) }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Expense Date</span>

                <span class="value">
                    {{ $expense->expense_date->format('d M Y') }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Payment Method</span>

                <span class="value">
                    {{ $expense->payment_method ?: '-' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Reference Number</span>

                <span class="value">
                    {{ $expense->reference_number ?: '-' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Created At</span>

                <span class="value">
                    {{ $expense->created_at?->format('d M Y, h:i A') ?? '-' }}
                </span>
            </div>

            <div class="detail">
                <span class="label">Last Updated</span>

                <span class="value">
                    {{ $expense->updated_at?->format('d M Y, h:i A') ?? '-' }}
                </span>
            </div>

            <div class="detail full">

                <span class="label">
                    Description
                </span>

                <div class="description">
                    {{ $expense->description ?: 'No description provided.' }}
                </div>

            </div>

        </div>

        <div class="bottom-actions">

            <a
                href="{{ route('expenses.edit', $expense) }}"
                class="btn btn-edit"
            >
                ✎ Edit Expense
            </a>

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-secondary print-btn"
            >
                🖨 Print Expense
            </button>

            <a
                href="{{ route('expenses.index') }}"
                class="btn btn-primary"
            >
                Back to Expenses
            </a>

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

    .expense-details-card {
        max-width: 1000px;
    }

    .expense-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .expense-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        background: #fef2f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 29px;
        flex-shrink: 0;
    }

    .expense-header h2 {
        margin: 0 0 6px;
        font-size: 22px;
        color: #111827;
    }

    .expense-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .expense-header strong {
        color: #374151;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .detail {
        background: #f9fafb;
        border: 1px solid #f0f1f3;
        padding: 17px;
        border-radius: 10px;
    }

    .detail.full {
        grid-column: 1 / -1;
    }

    .label {
        display: block;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .value {
        display: block;
        color: #111827;
        font-size: 15px;
        font-weight: 600;
    }

    .amount {
        color: #dc2626;
        font-size: 22px;
        font-weight: 800;
    }

    .category-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 700;
    }

    .description {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 14px;
        color: #374151;
        line-height: 1.6;
        min-height: 55px;
        white-space: pre-wrap;
    }

    .bottom-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-edit {
        background: #f59e0b;
        color: #fff;
    }

    .btn-edit:hover {
        background: #d97706;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    @media (max-width: 768px) {

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
            text-align: center;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .detail.full {
            grid-column: auto;
        }

        .expense-header {
            align-items: flex-start;
        }

        .bottom-actions {
            flex-direction: column;
        }

        .bottom-actions .btn {
            width: 100%;
            text-align: center;
        }

    }

    @media print {

        .sidebar,
        .header-actions,
        .bottom-actions {
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

        .expense-details-card {
            max-width: 100%;
            box-shadow: none;
        }

    }

</style>
@endpush
