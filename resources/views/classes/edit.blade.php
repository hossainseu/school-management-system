@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Class</h1>
        <p>Update class information.</p>
    </div>

    <a
        href="{{ route('classes.index') }}"
        class="btn btn-secondary"
    >
        ← Classes
    </a>

</div>


<div class="card class-form-card">

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
        action="{{ route('classes.update', ['class' => $class->id]) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="form-grid">

            {{-- Class Name --}}
            <div class="form-group">

                <label for="name">
                    Class Name
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $class->name) }}"
                    placeholder="Example: Class 6"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Class Code --}}
            <div class="form-group">

                <label for="class_code">
                    Class Code
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="class_code"
                    name="class_code"
                    value="{{ old('class_code', $class->class_code) }}"
                    placeholder="Example: CLS-06"
                    required
                >

                @error('class_code')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            {{-- Section --}}
            <div class="form-group">

                <label for="section">
                    Section
                </label>

                <input
                    type="text"
                    id="section"
                    name="section"
                    value="{{ old('section', $class->section) }}"
                    placeholder="Example: A"
                >

                @error('section')
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
                    placeholder="Enter class description..."
                >{{ old('description', $class->description) }}</textarea>

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
                ✓ Update Class
            </button>

            <a
                href="{{ route('classes.index') }}"
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

    .class-form-card {
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
