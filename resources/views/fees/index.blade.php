@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Fees</h1>
        <p>Manage student fee records and payments.</p>
    </div>

    <a
        href="{{ route('fees.create') }}"
        class="btn btn-primary"
    >
        + Add Fee
    </a>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="alert">
        {{ session('success') }}
    </div>

@endif


{{-- Search --}}
<div class="card search-card">

    <form
        method="GET"
        action="{{ route('fees.index') }}"
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
                href="{{ route('fees.index') }}"
                class="btn btn-secondary"
            >
                Clear
            </a>

        @endif

    </form>

</div>


{{-- Fees Table --}}
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
                    <th>Payment Method</th>
                    <th>Receipt</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                @forelse($fees as $fee)

                    <tr>

                        <td>
                            {{ $fees->firstItem() + $loop->index }}
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
                            {{ $fee->payment_method ?? '-' }}
                        </td>


                        <td>
                            {{ $fee->receipt_number ?? '-' }}
                        </td>


                        <td>

                            <div class="actions">

                                <a
                                    href="{{ route('fees.show', $fee) }}"
                                    class="btn btn-secondary btn-small"
                                >
                                    View
                                </a>


                                <a
                                    href="{{ route('fees.edit', $fee) }}"
                                    class="btn btn-warning btn-small"
                                >
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('fees.destroy', $fee) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this fee?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-small"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="11"
                            class="empty"
                        >
                            No fee records found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($fees->hasPages())

        <div class="pagination">

            {{ $fees->links() }}

        </div>

    @endif

</div>

@endsection

@push('styles')

<style>

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
        color: #1f2937;
        background: #fff;
    }

    .search-form input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
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
        min-width: 1200px;
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

    .actions {
        display: flex;
        gap: 6px;
        align-items: center;
        flex-wrap: wrap;
    }

    .actions form {
        margin: 0;
    }

    .btn-small {
        padding: 7px 10px;
        font-size: 12px;
    }

    .btn-warning {
        background: #f59e0b;
        color: white;
    }

    .btn-warning:hover {
        background: #d97706;
    }

    .btn-danger {
        background: #dc2626;
        color: white;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .empty {
        text-align: center !important;
        padding: 45px !important;
        color: #6b7280;
    }

    .pagination {
        padding: 20px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {

        .search-form {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form input,
        .search-form .btn {
            width: 100%;
        }

        .actions {
            flex-direction: column;
            align-items: stretch;
        }

        .actions .btn {
            text-align: center;
        }

    }

</style>

@endpush
