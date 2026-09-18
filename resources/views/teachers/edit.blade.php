@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Teacher</h1>
        <p>Update teacher information.</p>
    </div>

    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
        ← Teachers
    </a>

</div>

<div class="card teacher-form-card">

    @if($errors->any())

        <div class="alert">

            <strong>Please fix the following errors:</strong>

            <ul style="margin: 8px 0 0 20px;">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('teachers.update', $teacher) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-grid">

            <!-- Teacher Name -->
            <div class="form-group">

                <label for="name">
                    Teacher Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $teacher->name) }}"
                    placeholder="Enter teacher name"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Teacher ID -->
            <div class="form-group">

                <label for="teacher_id">
                    Teacher ID <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="teacher_id"
                    name="teacher_id"
                    value="{{ old('teacher_id', $teacher->teacher_id) }}"
                    placeholder="Example: T001"
                    required
                >

                @error('teacher_id')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Email -->
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $teacher->email) }}"
                    placeholder="teacher@example.com"
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Phone -->
            <div class="form-group">

                <label for="phone">
                    Phone
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $teacher->phone) }}"
                    placeholder="018XXXXXXXX"
                >

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Subject -->
            <div class="form-group">

                <label for="subject">
                    Subject
                </label>

                <input
                    type="text"
                    id="subject"
                    name="subject"
                    value="{{ old('subject', $teacher->subject) }}"
                    placeholder="Example: Mathematics"
                >

                @error('subject')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Qualification -->
            <div class="form-group">

                <label for="qualification">
                    Qualification
                </label>

                <input
                    type="text"
                    id="qualification"
                    name="qualification"
                    value="{{ old('qualification', $teacher->qualification) }}"
                    placeholder="Example: MSc in Mathematics"
                >

                @error('qualification')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Joining Date -->
            <div class="form-group">

                <label for="joining_date">
                    Joining Date
                </label>

                <input
                    type="date"
                    id="joining_date"
                    name="joining_date"
                    value="{{ old('joining_date', $teacher->joining_date) }}"
                >

                @error('joining_date')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <!-- Address -->
            <div class="form-group full-width">

                <label for="address">
                    Address
                </label>

                <textarea
                    id="address"
                    name="address"
                    placeholder="Enter teacher address..."
                >{{ old('address', $teacher->address) }}</textarea>

                @error('address')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="actions">

            <button
                type="submit"
                class="btn btn-primary"
            >
                ✓ Update Teacher
            </button>

            <a
                href="{{ route('teachers.index') }}"
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

    .teacher-form-card {
        max-width: 950px;
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
