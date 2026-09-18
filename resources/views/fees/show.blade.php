@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Fee Details</h1>
        <p>View complete fee and payment information.</p>
    </div>

    <div class="header-actions">

        <button
            onclick="window.print()"
            class="btn btn-secondary print-btn"
        >
            🖨 Print
        </button>

        <a
            href="{{ route('fees.edit', $fee) }}"
            class="btn btn-edit"
        >
            ✎ Edit
        </a>

        <a
            href="{{ route('fees.index') }}"
            class="btn btn-primary"
        >
            ← Fees
        </a>

    </div>

</div>


<div class="card fee-details-card">

    {{-- Student Header --}}
    <div class="student-header">

        <div class="student-avatar">
            👨‍🎓
        </div>

        <div>

            <h2>
                {{ $fee->student->name }}
            </h2>

            <p>
                Student ID:
                <strong>
                    {{ $fee->student->student_id }}
                </strong>
            </p>

        </div>

    </div>


    {{-- Fee Details --}}
    <div class="details-grid">

        <div class="detail">

            <span class="label">
                Fee Type
            </span>

            <span class="value">
                {{ $fee->fee_type }}
            </span>

        </div>


        <div class="detail">

            <span class="label">
                Amount
            </span>

            <span class="value amount">
                ৳{{ number_format($fee->amount, 2) }}
            </span>

        </div>


        <div class="detail">

            <span class="label">
                Due Date
            </span>

            <span class="value">
                {{ $fee->due_date?->format('d M Y') ?? '-' }}
            </span>

        </div>


        <div class="detail">

            <span class="label">
                Paid Date
            </span>

            <span class="value">
                {{ $fee->paid_date?->format('d M Y') ?? '-' }}
            </span>

        </div>


        <div class="detail">

            <span class="label">
                Status
            </span>

            <span class="value">

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

            </span>

        </div>


        <div class="detail">

            <span class="label">
                Payment Method
            </span>

            <span class="value">
                {{ $fee->payment_method ?? '-' }}
            </span>

        </div>


        <div class="detail">

            <span class="label">
                Receipt Number
            </span>

            <span class="value">
                {{ $fee->receipt_number ?? '-' }}
            </span>

        </div>


        <div class="detail">

            <span class="label">
                Created At
            </span>

            <span class="value">
                {{ $fee->created_at?->format('d M Y, h:i A') ?? '-' }}
            </span>

        </div>


        <div class="detail full">

            <span class="label">
                Remarks
            </span>

            <div class="remarks">
                {{ $fee->remarks ?? 'No remarks' }}
            </div>

        </div>

    </div>


    {{-- Bottom Actions --}}
    <div class="bottom-actions">

        <a
            href="{{ route('fees.edit', $fee) }}"
            class="btn btn-edit"
        >
            ✎ Edit Fee
        </a>

        <button
            onclick="window.print()"
            class="btn btn-secondary print-btn"
        >
            🖨 Print Fee
        </button>

        <a
            href="{{ route('fees.index') }}"
            class="btn btn-primary"
        >
            Back to Fees
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

    .fee-details-card {
        max-width: 1000px;
    }

    .student-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .student-avatar {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
    }

    .student-header h2 {
        margin: 0 0 6px;
        font-size: 22px;
        color: #111827;
    }

    .student-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .student-header strong {
        color: #374151;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
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
        font-weight: 600;
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
        color: #2563eb;
        font-size: 21px;
        font-weight: 800;
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
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

    .remarks {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 14px;
        color: #374151;
        line-height: 1.6;
        min-height: 50px;
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
        color: white;
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

        .student-header {
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

        .card {
            box-shadow: none;
            max-width: 100%;
        }

    }

</style>

@endpush
