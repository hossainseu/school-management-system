@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Fee Report</h1>
        <p>View fee collection and payment summary.</p>
    </div>

    <div class="header-actions">

        <button
            onclick="window.print()"
            class="btn btn-secondary print-btn"
        >
            🖨 Print Report
        </button>

        <a
            href="{{ route('fees.index') }}"
            class="btn btn-primary"
        >
            ← Fees
        </a>

    </div>

</div>


{{-- Summary --}}
<div class="summary-grid">

    <div class="summary-card">

        <div class="summary-icon">💰</div>

        <div>
            <div class="summary-label">
                Total Fees
            </div>

            <div class="summary-value">
                ৳{{ number_format($totalFees, 2) }}
            </div>
        </div>

    </div>


    <div class="summary-card">

        <div class="summary-icon">✅</div>

        <div>
            <div class="summary-label">
                Paid
            </div>

            <div class="summary-value">
                ৳{{ number_format($paidFees, 2) }}
            </div>
        </div>

    </div>


    <div class="summary-card">

        <div class="summary-icon">⏳</div>

        <div>
            <div class="summary-label">
                Unpaid
            </div>

            <div class="summary-value">
                ৳{{ number_format($unpaidFees, 2) }}
            </div>
        </div>

    </div>


    <div class="summary-card">

        <div class="summary-icon">⚠️</div>

        <div>
            <div class="summary-label">
                Partial
            </div>

            <div class="summary-value">
                ৳{{ number_format($partialFees, 2) }}
            </div>
        </div>

    </div>

</div>


{{-- Search --}}
<div class="card search-card">

    <form
        method="GET"
        action="{{ route('fee-report') }}"
        class="search-form"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search student, fee type, status or receipt..."
        >

        <button
            type="submit"
            class="btn btn-primary"
        >
            Search
        </button>

        @if(request('search'))

            <a
                href="{{ route('fee-report') }}"
                class="btn btn-secondary"
            >
                Clear
            </a>

        @endif

    </form>

</div>


{{-- Report Table --}}
<div class="card table-card">

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Student ID</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                    <th>Receipt</th>
                </tr>

            </thead>


            <tbody>

                @forelse($fees as $fee)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $fee->student->name }}
                            </strong>
                        </td>

                        <td>
                            {{ $fee->student->student_id }}
                        </td>

                        <td>
                            {{ $fee->fee_type }}
                        </td>

                        <td>
                            <strong>
                                ৳{{ number_format($fee->amount, 2) }}
                            </strong>
                        </td>

                        <td>
                            {{ $fee->due_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td>
                            {{ $fee->paid_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td>

                            @if($fee->status === 'paid')

                                <span class="status status-paid">
                                    Paid
                                </span>

                            @elseif($fee->status === 'partial')

                                <span class="status status-partial">
                                    Partial
                                </span>

                            @else

                                <span class="status status-unpaid">
                                    Unpaid
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $fee->receipt_number ?? '-' }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="9"
                            class="empty"
                        >
                            No fee records found.
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
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 20px;
    }

    .summary-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
    }

    .table-card {
        padding: 0;
        overflow: hidden;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
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

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-paid {
        background: #dcfce7;
        color: #166534;
    }

    .status-partial {
        background: #fef3c7;
        color: #92400e;
    }

    .status-unpaid {
        background: #fee2e2;
        color: #991b1b;
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
            grid-template-columns: repeat(2, 1fr);
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
