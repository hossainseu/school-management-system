@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Income Details</h1>
        <p>View complete information about this income record.</p>
    </div>

    <div class="header-actions">
        <button type="button" onclick="window.print()" class="btn btn-primary print-btn">
            🖨 Print
        </button>

        <a href="{{ route('incomes.edit', $income) }}" class="btn btn-warning">
            ✏ Edit
        </a>

        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">
            ← Income
        </a>
    </div>
</div>

<div class="card details-card">

    <div class="details-grid">

        <div class="detail-item">
            <div class="detail-label">Title</div>
            <div class="detail-value">
                {{ $income->title }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Category</div>
            <div class="detail-value">
                <span class="category-badge">
                    {{ $income->category }}
                </span>
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Amount</div>
            <div class="detail-value amount">
                ৳{{ number_format($income->amount, 2) }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Income Date</div>
            <div class="detail-value">
                {{ $income->income_date?->format('d M Y') ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Payment Method</div>
            <div class="detail-value">
                {{ $income->payment_method ?: '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Reference Number</div>
            <div class="detail-value">
                {{ $income->reference_number ?: '-' }}
            </div>
        </div>

        <div class="detail-item full">
            <div class="detail-label">Description</div>
            <div class="detail-value description">
                {{ $income->description ?: 'No description provided.' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Created At</div>
            <div class="detail-value">
                {{ $income->created_at?->format('d M Y, h:i A') ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Last Updated</div>
            <div class="detail-value">
                {{ $income->updated_at?->format('d M Y, h:i A') ?? '-' }}
            </div>
        </div>

    </div>

    <div class="bottom-actions">
        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">
            ← Back to Income
        </a>

        <a href="{{ route('incomes.edit', $income) }}" class="btn btn-warning">
            ✏ Edit Income
        </a>

        <button type="button" onclick="window.print()" class="btn btn-primary">
            🖨 Print Details
        </button>
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

    .details-card {
        max-width: 1000px;
        padding: 25px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .detail-item {
        padding: 18px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .detail-item.full {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 7px;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: .4px;
    }

    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        word-break: break-word;
    }

    .amount {
        color: #16a34a;
        font-size: 24px;
        font-weight: 800;
    }

    .category-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        background: #ecfdf5;
        color: #15803d;
        font-size: 13px;
        font-weight: 700;
    }

    .description {
        white-space: pre-wrap;
        line-height: 1.7;
        font-weight: 400;
    }

    .bottom-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-warning {
        background: #f59e0b;
        color: #fff;
    }

    .btn-warning:hover {
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

        .details-card {
            padding: 18px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full {
            grid-column: auto;
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
            margin-left: 0 !important;
            width: 100% !important;
            padding: 0 !important;
        }

        body {
            background: #fff !important;
        }

        .details-card {
            max-width: 100%;
            box-shadow: none !important;
            border: none !important;
        }

        .detail-item {
            break-inside: avoid;
        }
    }
</style>

@endpush
