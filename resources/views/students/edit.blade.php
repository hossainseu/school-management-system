@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Student</h1>
        <p>Update student information.</p>
    </div>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        ← Students
    </a>

</div>

<div class="card student-form-card">

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

    <form action="{{ route('students.update', $student) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">

                <label for="name">
                    Name *
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $student->name) }}"
                    placeholder="Enter student name"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="student_id">
                    Student ID *
                </label>

                <input
                    type="text"
                    id="student_id"
                    name="student_id"
                    value="{{ old('student_id', $student->student_id) }}"
                    placeholder="Example: STU-001"
                    required
                >

                @error('student_id')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $student->email) }}"
                    placeholder="student@example.com"
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="phone">
                    Phone
                </label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $student->phone) }}"
                    placeholder="Enter phone number"
                >

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="class">
                    Class
                </label>

                <input
                    type="text"
                    id="class"
                    name="class"
                    value="{{ old('class', $student->class) }}"
                    placeholder="Example: Class 10"
                >

                @error('class')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">

                <label for="section">
                    Section
                </label>

                <input
                    type="text"
                    id="section"
                    name="section"
                    value="{{ old('section', $student->section) }}"
                    placeholder="Example: A"
                >

                @error('section')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-primary">
                ✓ Update Student
            </button>

            <a
                href="{{ route('students.index') }}"
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

    .student-form-card {
        max-width: 900px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #374151;
    }

    .form-group input {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        background: #fff;
        color: #1f2937;
        box-sizing: border-box;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
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
