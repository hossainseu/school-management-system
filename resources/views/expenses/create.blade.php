@extends('layouts.school')

@section('content')

    <div class="page-header">
        <div>
            <h1>Add Expense</h1>
            <p>Create a new expense record.</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                ← Back to Expenses
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="errors">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card expense-form-card">

        <form action="{{ route('expenses.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Expense Title <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Example: Electricity Bill"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Category <span class="required">*</span>
                    </label>

                    <select name="category" required>
                        <option value="">Select Category</option>

                        <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>
                            Salary
                        </option>

                        <option value="Electricity" {{ old('category') == 'Electricity' ? 'selected' : '' }}>
                            Electricity
                        </option>

                        <option value="Internet" {{ old('category') == 'Internet' ? 'selected' : '' }}>
                            Internet
                        </option>

                        <option value="Stationery" {{ old('category') == 'Stationery' ? 'selected' : '' }}>
                            Stationery
                        </option>

                        <option value="Maintenance" {{ old('category') == 'Maintenance' ? 'selected' : '' }}>
                            Maintenance
                        </option>

                        <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>
                            Transport
                        </option>

                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Amount <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="amount"
                        value="{{ old('amount') }}"
                        placeholder="0.00"
                        min="0"
                        step="0.01"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Expense Date <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="expense_date"
                        value="{{ old('expense_date', date('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>
                        Payment Method
                    </label>

                    <select name="payment_method">
                        <option value="">Select Payment Method</option>

                        <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="Bank" {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>
                            Bank
                        </option>

                        <option value="Mobile Banking" {{ old('payment_method') == 'Mobile Banking' ? 'selected' : '' }}>
                            Mobile Banking
                        </option>

                        <option value="Cheque" {{ old('payment_method') == 'Cheque' ? 'selected' : '' }}>
                            Cheque
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        Reference Number
                    </label>

                    <input
                        type="text"
                        name="reference_number"
                        value="{{ old('reference_number') }}"
                        placeholder="Optional"
                    >
                </div>

                <div class="form-group full">
                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        placeholder="Write expense details..."
                    >{{ old('description') }}</textarea>
                </div>

            </div>

            <div class="actions">

                <button type="submit" class="btn btn-primary">
                    💾 Save Expense
                </button>

                <a
                    href="{{ route('expenses.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

@endsection

@push('styles')
<style>

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .expense-form-card {
        max-width: 950px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        margin-bottom: 7px;
        color: #374151;
        font-size: 14px;
        font-weight: 700;
    }

    .required {
        color: #dc2626;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background: #fff;
        color: #1f2937;
        font-size: 14px;
        font-family: inherit;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
        line-height: 1.5;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .errors {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
        padding: 15px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .errors strong {
        display: block;
        margin-bottom: 7px;
    }

    .errors ul {
        margin: 0;
        padding-left: 20px;
    }

    .errors li {
        margin-bottom: 3px;
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
            width: 100%;
            text-align: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .actions {
            flex-direction: column;
        }

        .actions .btn {
            width: 100%;
            text-align: center;
        }
    }

</style>
@endpush

