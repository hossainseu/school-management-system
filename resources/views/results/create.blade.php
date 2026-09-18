@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Add Result</h1>
        <p>Enter student examination result.</p>
    </div>

    <a href="{{ route('results.index') }}" class="btn btn-secondary">
        ← Results
    </a>

</div>

<div class="card">

    @if($errors->any())

        <div class="alert">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form
        method="POST"
        action="{{ route('results.store') }}"
    >

        @csrf

        <!-- Student -->
        <div class="form-group">

            <label for="student_id">
                Student
            </label>

            <select
                name="student_id"
                id="student_id"
                required
            >

                <option value="">
                    -- Select Student --
                </option>

                @foreach($students as $student)

                    <option
                        value="{{ $student->id }}"
                        {{ old('student_id') == $student->id ? 'selected' : '' }}
                    >
                        {{ $student->name }} ({{ $student->student_id }})
                    </option>

                @endforeach

            </select>

            @error('student_id')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Subject -->
        <div class="form-group">

            <label for="subject_id">
                Subject
            </label>

            <select
                name="subject_id"
                id="subject_id"
                required
            >

                <option value="">
                    -- Select Subject --
                </option>

                @foreach($subjects as $subject)

                    <option
                        value="{{ $subject->id }}"
                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}
                    >
                        {{ $subject->name }} ({{ $subject->subject_code }})
                    </option>

                @endforeach

            </select>

            @error('subject_id')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Exam Name -->
        <div class="form-group">

            <label for="exam_name">
                Exam Name
            </label>

            <input
                type="text"
                name="exam_name"
                id="exam_name"
                value="{{ old('exam_name') }}"
                placeholder="Example: Half Yearly Examination"
                required
            >

            @error('exam_name')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Marks -->
        <div class="form-group">

            <label for="marks">
                Marks
            </label>

            <input
                type="number"
                name="marks"
                id="marks"
                value="{{ old('marks') }}"
                min="0"
                max="100"
                step="0.01"
                placeholder="Enter marks out of 100"
                required
            >

            <div class="help-text">
                Enter marks between 0 and 100.
                Grade and GPA will be calculated automatically.
            </div>

            @error('marks')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Remarks -->
        <div class="form-group">

            <label for="remarks">
                Remarks
            </label>

            <textarea
                name="remarks"
                id="remarks"
                placeholder="Enter remarks..."
            >{{ old('remarks') }}</textarea>

            @error('remarks')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Buttons -->
        <div class="actions">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Result
            </button>

            <a
                href="{{ route('results.index') }}"
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

    .card {
        max-width: 750px;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 700;
        margin-bottom: 8px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 15px;
        background: white;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #2563eb;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .help-text {
        margin-top: 6px;
        font-size: 13px;
        color: #6b7280;
    }

    .error {
        color: #dc2626;
        font-size: 14px;
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

        .card {
            padding: 20px;
        }

        .actions {
            flex-direction: column;
        }

        .actions .btn {
            text-align: center;
        }

    }

</style>

@endpush
