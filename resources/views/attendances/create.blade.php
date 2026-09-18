@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Take Attendance</h1>
        <p>Mark daily attendance for students.</p>
    </div>

    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
        ← Attendance
    </a>

</div>

@if ($errors->any())

    <div class="alert">

        <ul style="margin-left: 20px;">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<form action="{{ route('attendances.store') }}" method="POST">

    @csrf

    <!-- Attendance Date -->
    <div class="card date-card">

        <label for="date">
            Attendance Date *
        </label>

        <input
            type="date"
            name="date"
            id="date"
            value="{{ old('date', now()->toDateString()) }}"
            required
        >

    </div>

    <!-- Students -->
    <div class="card table-card">

        <div class="card-header">

            <div>
                <h2>Student Attendance</h2>
                <p>Mark attendance status for each student.</p>
            </div>

            <div class="student-count">
                {{ $students->count() }} Students
            </div>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Remarks</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($students as $student)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $student->student_id }}
                                </strong>
                            </td>

                            <td>
                                {{ $student->name }}
                            </td>

                            <td>
                                {{ $student->class ?? '-' }}
                            </td>

                            <td>

                                <select
                                    name="attendance[{{ $student->id }}]"
                                    required
                                >

                                    <option
                                        value="present"
                                        {{ old("attendance.{$student->id}", 'present') === 'present' ? 'selected' : '' }}
                                    >
                                        Present
                                    </option>

                                    <option
                                        value="absent"
                                        {{ old("attendance.{$student->id}") === 'absent' ? 'selected' : '' }}
                                    >
                                        Absent
                                    </option>

                                    <option
                                        value="late"
                                        {{ old("attendance.{$student->id}") === 'late' ? 'selected' : '' }}
                                    >
                                        Late
                                    </option>

                                </select>

                            </td>

                            <td>

                                <input
                                    type="text"
                                    name="remarks[{{ $student->id }}]"
                                    value="{{ old("remarks.{$student->id}") }}"
                                    placeholder="Optional"
                                >

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="empty">

                                No students found.
                                Please add students first.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Buttons -->
        <div class="actions">

            <button
                type="submit"
                class="btn btn-primary"
            >
                ✓ Save Attendance
            </button>

            <a
                href="{{ route('attendances.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </div>

</form>

@endsection

@push('styles')

<style>

    .date-card {
        max-width: 500px;
    }

    .date-card label {
        display: block;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .date-card input {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        background: white;
    }

    .date-card input:focus {
        outline: none;
        border-color: #2563eb;
    }

    .table-card {
        padding: 0;
        overflow: hidden;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-header h2 {
        margin: 0 0 5px;
        font-size: 19px;
    }

    .card-header p {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    .student-count {
        background: #eff6ff;
        color: #2563eb;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    table th,
    table td {
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    table th {
        background: #f9fafb;
        color: #6b7280;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    table td {
        font-size: 14px;
        color: #374151;
    }

    table tbody tr:hover {
        background: #f9fafb;
    }

    table select,
    table input {
        padding: 9px 10px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        background: white;
    }

    table select {
        min-width: 120px;
    }

    table input {
        width: 180px;
    }

    table select:focus,
    table input:focus {
        outline: none;
        border-color: #2563eb;
    }

    .actions {
        display: flex;
        gap: 10px;
        padding: 20px 24px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .empty {
        text-align: center !important;
        padding: 45px !important;
        color: #6b7280 !important;
    }

    @media (max-width: 768px) {

        .card-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
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
