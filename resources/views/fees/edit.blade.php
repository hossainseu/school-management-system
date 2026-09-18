@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Fee</h1>
        <p>Update student fee information.</p>
    </div>

    <a
        href="{{ route('fees.index') }}"
        class="btn btn-secondary"
    >
        ← Fees
    </a>

</div>


<div class="card fee-form-card">

    @if ($errors->any())

        <div class="alert">

            <strong>Please fix the following errors:</strong>

            <ul style="margin: 8px 0 0 20px;">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('fees.update', $fee) }}"
    >

        @csrf
        @method('PUT')


        <div class="form-grid">

            {{-- Student --}}
            <div class="form-group">

                <label for="student_id">
                    Student
                    <span class="required">*</span>
                </label>

                <select
                    name="student_id"
                    id="student_id"
                    required
                >

                    @foreach($students as $student)

                        <option
                            value="{{ $student->id }}"
                            {{ old('student_id', $fee->student_id) == $student->id ? 'selected' : '' }}
                        >
                            {{ $student->name }} ({{ $student->student_id }})
                        </option>

                    @endforeach

                </select>

                @error('student_id')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Fee Type --}}
            <div class="form-group">

                <label for="fee_type">
                    Fee Type
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="fee_type"
                    name="fee_type"
                    value="{{ old('fee_type', $fee->fee_type) }}"
                    placeholder="e.g. Monthly Fee"
                    required
                >

                @error('fee_type')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Amount --}}
            <div class="form-group">

                <label for="amount">
                    Amount
                    <span class="required">*</span>
                </label>

                <input
                    type="number"
                    id="amount"
                    name="amount"
                    value="{{ old('amount', $fee->amount) }}"
                    min="0"
                    step="0.01"
                    placeholder="0.00"
                    required
                >

                @error('amount')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Due Date --}}
            <div class="form-group">

                <label for="due_date">
                    Due Date
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date', $fee->due_date?->format('Y-m-d')) }}"
                >

                @error('due_date')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Paid Date --}}
            <div class="form-group">

                <label for="paid_date">
                    Paid Date
                </label>

                <input
                    type="date"
                    id="paid_date"
                    name="paid_date"
                    value="{{ old('paid_date', $fee->paid_date?->format('Y-m-d')) }}"
                >

                @error('paid_date')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Status --}}
            <div class="form-group">

                <label for="status">
                    Status
                    <span class="required">*</span>
                </label>

                <select
                    name="status"
                    id="status"
                    required
                >

                    <option
                        value="unpaid"
                        {{ old('status', $fee->status) === 'unpaid' ? 'selected' : '' }}
                    >
                        Unpaid
                    </option>

                    <option
                        value="partial"
                        {{ old('status', $fee->status) === 'partial' ? 'selected' : '' }}
                    >
                        Partial
                    </option>

                    <option
                        value="paid"
                        {{ old('status', $fee->status) === 'paid' ? 'selected' : '' }}
                    >
                        Paid
                    </option>

                </select>

                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Payment Method --}}
            <div class="form-group">

                <label for="payment_method">
                    Payment Method
                </label>

                <select
                    name="payment_method"
                    id="payment_method"
                >

                    <option value="">
                        Select Method
                    </option>

                    <option
                        value="Cash"
                        {{ old('payment_method', $fee->payment_method) === 'Cash' ? 'selected' : '' }}
                    >
                        Cash
                    </option>

                    <option
                        value="Bank"
                        {{ old('payment_method', $fee->payment_method) === 'Bank' ? 'selected' : '' }}
                    >
                        Bank
                    </option>

                    <option
                        value="Mobile Banking"
                        {{ old('payment_method', $fee->payment_method) === 'Mobile Banking' ? 'selected' : '' }}
                    >
                        Mobile Banking
                    </option>

                    <option
                        value="Card"
                        {{ old('payment_method', $fee->payment_method) === 'Card' ? 'selected' : '' }}
                    >
                        Card
                    </option>

                </select>

                @error('payment_method')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Receipt Number --}}
            <div class="form-group">

                <label for="receipt_number">
                    Receipt Number
                </label>

                <input
                    type="text"
                    id="receipt_number"
                    name="receipt_number"
                    value="{{ old('receipt_number', $fee->receipt_number) }}"
                    placeholder="e.g. REC-1001"
                >

                @error('receipt_number')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Remarks --}}
            <div class="form-group full-width">

                <label for="remarks">
                    Remarks
                </label>

                <textarea
                    id="remarks"
                    name="remarks"
                    placeholder="Additional notes..."
                >{{ old('remarks', $fee->remarks) }}</textarea>

                @error('remarks')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

        </div>


        <div class="actions">

            <button
                type="submit"
                class="btn btn-primary"
            >
                ✓ Update Fee
            </button>

            <a
                href="{{ route('fees.index') }}"
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

    .fee-form-card {
        max-width: 1000px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 2px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #374151;
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
        font-size: 14px;
        background: #fff;
        color: #1f2937;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .form-group textarea {
        min-height: 110px;
        resize: vertical;
    }

    .error {
        color: #dc2626;
        font-size: 13px;
        margin-top: 5px;
    }

    .actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    @media (max-width: 768px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full-width {
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
