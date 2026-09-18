@extends('layouts.school')

@section('content')

    <div class="page-header">

        <div>
            <h1>Edit Income</h1>
            <p>Update income and payment information.</p>
        </div>

        <div class="header-actions">
            <a
                href="{{ route('incomes.index') }}"
                class="btn btn-secondary"
            >
                ← Back to Income
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

    <div class="card income-form-card">

        <form
            method="POST"
            action="{{ route('incomes.update', $income) }}"
        >

            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- Title --}}
                <div class="form-group">

                    <label>
                        Title <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $income->title) }}"
                        placeholder="Example: Admission Fee"
                        required
                    >

                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Category --}}
                <div class="form-group">

                    <label>
                        Category <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category', $income->category) }}"
                        placeholder="Example: Student Fee"
                        required
                    >

                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Amount --}}
                <div class="form-group">

                    <label>
                        Amount <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="amount"
                        value="{{ old('amount', $income->amount) }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        required
                    >

                    @error('amount')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Income Date --}}
                <div class="form-group">

                    <label>
                        Income Date <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="income_date"
                        value="{{ old('income_date', $income->income_date?->format('Y-m-d')) }}"
                        required
                    >

                    @error('income_date')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Payment Method --}}
                <div class="form-group">

                    <label>
                        Payment Method
                    </label>

                    <select name="payment_method">

                        <option value="">
                            Select Payment Method
                        </option>

                        @foreach(['Cash', 'Bank', 'bKash', 'Nagad', 'Card', 'Other'] as $method)

                            <option
                                value="{{ $method }}"
                                {{ old('payment_method', $income->payment_method) == $method ? 'selected' : '' }}
                            >
                                {{ $method }}
                            </option>

                        @endforeach

                    </select>

                    @error('payment_method')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Reference Number --}}
                <div class="form-group">

                    <label>
                        Reference Number
                    </label>

                    <input
                        type="text"
                        name="reference_number"
                        value="{{ old('reference_number', $income->reference_number) }}"
                        placeholder="Optional reference"
                    >

                    @error('reference_number')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Description --}}
                <div class="form-group full">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        placeholder="Optional description..."
                    >{{ old('description', $income->description) }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    💾 Update Income
                </button>

                <a
                    href="{{ route('incomes.index') }}"
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

    .income-form-card {
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
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
    }

    .error {
        color: #dc2626;
        font-size: 13px;
        margin-top: 5px;
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

    .actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
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
