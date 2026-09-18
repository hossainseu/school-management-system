@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Add Subject</h1>
        <p>Create a new school subject.</p>
    </div>

    <a
        href="{{ route('subjects.index') }}"
        class="btn btn-secondary"
    >
        ← Subjects
    </a>

</div>


<div class="card subject-form-card">

    {{-- Validation Errors --}}
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
        action="{{ route('subjects.store') }}"
        method="POST"
    >

        @csrf


        <div class="form-grid">

            {{-- Subject Name --}}
            <div class="form-group">

                <label for="name">
                    Subject Name
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Example: Mathematics"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Subject Code --}}
            <div class="form-group">

                <label for="subject_code">
                    Subject Code
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="subject_code"
                    name="subject_code"
                    value="{{ old('subject_code') }}"
                    placeholder="Example: MATH-101"
                    required
                >

                @error('subject_code')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Class --}}
            <div class="form-group">

                <label for="class">
                    Class
                </label>

                <input
                    type="text"
                    id="class"
                    name="class"
                    value="{{ old('class') }}"
                    placeholder="Example: Class 8"
                >

                @error('class')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Description --}}
            <div class="form-group full-width">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Enter subject description..."
                >{{ old('description') }}</textarea>

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
                ✓ Save Subject
            </button>

            <a
                href="{{ route('subjects.index') }}"
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

    .subject-form-card {
        max-width: 900px;
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
    .form-group textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
    }

    .form-group textarea {
        min-height: 120px;
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
