@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit Attendance</h1>
        <p>Update student attendance information.</p>
    </div>

    <a
        href="{{ route('attendances.index', ['date' => $attendance->date->format('Y-m-d')]) }}"
        class="btn btn-secondary"
    >
        ← Attendance
    </a>

</div>

<div class="card attendance-card">

    <!-- Student Information -->
    <div class="student-info">

        <div class="info-item">

            <span class="label">
                Student Name
            </span>

            <span class="value">
                {{ $attendance->student->name }}
            </span>

        </div>

        <div class="info-item">

            <span class="label">
                Student ID
            </span>

            <span class="value">
                {{ $attendance->student->student_id }}
            </span>

        </div>

    </div>

    <!-- Validation Errors -->
    @if($errors->any())

        <div class="alert">

            <ul style="margin-left: 20px;">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Edit Form -->
    <form
        method="POST"
        action="{{ route('attendances.update', $attendance->id) }}"
    >

        @csrf

        @method('PUT')

        <!-- Attendance Date -->
        <div class="form-group">

            <label for="date">
                Attendance Date
            </label>

            <input
                type="text"
                id="date"
                value="{{ $attendance->date->format('d M Y') }}"
                readonly
                class="readonly-input"
            >

            <div class="help-text">
                Attendance date cannot be changed here.
            </div>

            @error('date')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>

        <!-- Status -->
        <div class="form-group">

            <label for="status">
                Attendance Status
            </label>

            <select
                id="status"
                name="status"
                required
            >

                <option
                    value="present"
                    {{ old('status', $attendance->status) === 'present' ? 'selected' : '' }}
                >
                    Present
                </option>

                <option
                    value="absent"
                    {{ old('status', $attendance->status) === 'absent' ? 'selected' : '' }}
                >
                    Absent
                </option>

                <option
                    value="late"
                    {{ old('status', $attendance->status) === 'late' ? 'selected' : '' }}
                >
                    Late
                </option>

            </select>

            @error('status')

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
                id="remarks"
                name="remarks"
                placeholder="Enter remarks..."
            >{{ old('remarks', $attendance->remarks) }}</textarea>

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
                ✓ Update Attendance
            </button>

            <a
                href="{{ route('attendances.index', ['date' => $attendance->date->format('Y-m-d')]) }}"
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

    .attendance-card {
        max-width: 750px;
    }

    .student-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .info-item {
        background: #f9fafb;
        padding: 16px;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
    }

    .label {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .value {
        display: block;
        font-weight: 700;
        font-size: 16px;
        color: #1f2937;
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
        font-size: 14px;
        background: white;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #2563eb;
    }

    .readonly-input {
        background: #f3f4f6;
        color: #6b7280;
        cursor: not-allowed;
    }

    textarea {
        min-height: 110px;
        resize: vertical;
    }

    .help-text {
        margin-top: 6px;
        color: #6b7280;
        font-size: 13px;
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

        .student-info {
            grid-template-columns: 1fr;
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
