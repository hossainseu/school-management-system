@extends('layouts.school')

@section('content')

    <div class="page-header">

        <div>
            <h1>Income Management</h1>
            <p>Manage school income, payments and financial records.</p>
        </div>

        <div class="header-actions">

            <a
                href="{{ route('incomes.create') }}"
                class="btn btn-primary"
            >
                + Add Income
            </a>

            <a
                href="{{ route('income-report') }}"
                class="btn btn-secondary"
            >
                📊 Income Report
            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card search-card">

        <form
            method="GET"
            action="{{ route('incomes.index') }}"
            class="search-form"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by title, category, payment method or reference..."
            >

            <button
                type="submit"
                class="btn btn-primary"
            >
                🔍 Search
            </button>

            @if(request('search'))

                <a
                    href="{{ route('incomes.index') }}"
                    class="btn btn-secondary"
                >
                    Clear
                </a>

            @endif

        </form>

    </div>

    <div class="card table-card">

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Income Date</th>
                        <th>Payment Method</th>
                        <th>Reference</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($incomes as $income)

                        <tr>

                            <td>
                                {{ $incomes->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $income->title }}
                                </strong>
                            </td>

                            <td>
                                <span class="category-badge">
                                    {{ $income->category }}
                                </span>
                            </td>

                            <td>
                                <strong class="amount">
                                    ৳{{ number_format($income->amount, 2) }}
                                </strong>
                            </td>

                            <td>
                                {{ $income->income_date?->format('d M Y') ?? '-' }}
                            </td>

                            <td>
                                {{ $income->payment_method ?: '-' }}
                            </td>

                            <td>
                                {{ $income->reference_number ?: '-' }}
                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('incomes.show', $income) }}"
                                        class="btn btn-small btn-view"
                                    >
                                        View
                                    </a>

                                    <a
                                        href="{{ route('incomes.edit', $income) }}"
                                        class="btn btn-small btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('incomes.destroy', $income) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this income?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-small btn-delete"
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
                                colspan="8"
                                class="empty"
                            >
                                No income records found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($incomes->hasPages())

            <div class="pagination">

                {{ $incomes->withQueryString()->links() }}

            </div>

        @endif

    </div>

@endsection


@push('styles')
<style>

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
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
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
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
        min-width: 1050px;
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

    .amount {
        color: #16a34a;
        font-size: 15px;
    }

    .category-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #ecfdf5;
        color: #15803d;
        font-size: 12px;
        font-weight: 700;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .actions form {
        margin: 0;
    }

    .btn-small {
        padding: 7px 10px;
        font-size: 12px;
        border-radius: 6px;
    }

    .btn-view {
        background: #0ea5e9;
        color: #fff;
    }

    .btn-view:hover {
        background: #0284c7;
    }

    .btn-edit {
        background: #f59e0b;
        color: #fff;
    }

    .btn-edit:hover {
        background: #d97706;
    }

    .btn-delete {
        background: #dc2626;
        color: #fff;
    }

    .btn-delete:hover {
        background: #b91c1c;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .empty {
        text-align: center !important;
        padding: 45px !important;
        color: #6b7280;
    }

    .pagination {
        padding: 18px 20px;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
            text-align: center;
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

</style>
@endpush
