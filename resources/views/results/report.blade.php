@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Student Result Report</h1>
        <p>View detailed examination results for a student.</p>
    </div>

    <div style="display: flex; gap: 10px;">

        <a href="{{ route('results.index') }}" class="btn btn-secondary">
            ← Results
        </a>

        @if($student)

            <button
                onclick="window.print()"
                class="btn btn-primary"
            >
                🖨 Print Report
            </button>

        @endif

    </div>

</div>


<!-- Student Selection -->
<div class="card search-card">

    <form
        method="GET"
        action="{{ route('student-result-report') }}"
    >

        <div class="form-row">

            <select name="student_id" required>

                <option value="">
                    Select a Student
                </option>

                @foreach($students as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ $student && $student->id == $item->id ? 'selected' : '' }}
                    >
                        {{ $item->name }} — {{ $item->student_id }}
                    </option>

                @endforeach

            </select>

            <button
                type="submit"
                class="btn btn-primary"
            >
                View Report
            </button>

        </div>

    </form>

</div>


@if($student)

    <!-- Student Information -->
    <div class="card">

        <h2 style="margin: 0 0 20px;">
            Student Information
        </h2>

        <div class="student-info">

            <div class="info-item">

                <span class="label">
                    Student Name
                </span>

                <span class="value">
                    {{ $student->name }}
                </span>

            </div>

            <div class="info-item">

                <span class="label">
                    Student ID
                </span>

                <span class="value">
                    {{ $student->student_id }}
                </span>

            </div>

            <div class="info-item">

                <span class="label">
                    Class
                </span>

                <span class="value">
                    {{ $student->class ?: 'N/A' }}
                </span>

            </div>

        </div>

    </div>


    <!-- Results -->
    <div class="card" style="padding: 0; overflow-x: auto;">

        @if($results->count())

            <table style="
                width: 100%;
                border-collapse: collapse;
                min-width: 700px;
            ">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Exam</th>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>GPA</th>
                        <th>Remarks</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($results as $result)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $result->exam_name }}
                            </td>

                            <td>
                                {{ $result->subject->name }}
                            </td>

                            <td>
                                <strong>
                                    {{ $result->marks }}
                                </strong>
                            </td>

                            <td>

                                <span style="
                                    display: inline-block;
                                    padding: 5px 10px;
                                    border-radius: 20px;
                                    background: #dcfce7;
                                    color: #166534;
                                    font-weight: 700;
                                ">
                                    {{ $result->grade }}
                                </span>

                            </td>

                            <td>
                                <strong>
                                    {{ $result->gpa }}
                                </strong>
                            </td>

                            <td>
                                {{ $result->remarks ?: '-' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            @php

                $totalMarks = $results->sum('marks');
                $averageMarks = $results->avg('marks');
                $averageGpa = $results->avg('gpa');

            @endphp


            <!-- Summary -->
            <div class="summary">

                <div class="summary-box">

                    <strong>
                        {{ number_format($totalMarks, 2) }}
                    </strong>

                    <span>
                        Total Marks
                    </span>

                </div>


                <div class="summary-box">

                    <strong>
                        {{ number_format($averageMarks, 2) }}
                    </strong>

                    <span>
                        Average Marks
                    </span>

                </div>


                <div class="summary-box">

                    <strong>
                        {{ number_format($averageGpa, 2) }}
                    </strong>

                    <span>
                        Average GPA
                    </span>

                </div>

            </div>

        @else

            <div class="empty">
                No results found for this student.
            </div>

        @endif

    </div>

@else

    <div class="card">

        <div class="empty">
            Select a student above to view the result report.
        </div>

    </div>

@endif

@endsection

@push('styles')

<style>

    .form-row {
        display: flex;
        gap: 12px;
    }

    .form-row select {
        flex: 1;
    }

    select {
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        background: white;
    }

    .card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        font-size: 13px;
        text-transform: uppercase;
    }

    table td {
        font-size: 14px;
    }

    .student-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .info-item {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
    }

    .label {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .value {
        font-weight: 600;
        font-size: 16px;
    }

    .summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 20px;
    }

    .summary-box {
        background: #eff6ff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .summary-box strong {
        display: block;
        font-size: 26px;
        margin-bottom: 5px;
    }

    .summary-box span {
        color: #6b7280;
        font-size: 13px;
    }

    .empty {
        text-align: center;
        padding: 45px;
        color: #6b7280;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    @media print {

        .sidebar,
        .page-header a,
        .page-header button,
        .search-card {
            display: none !important;
        }

        .main {
            margin-left: 0;
            width: 100%;
            padding: 0;
        }

        body {
            background: white;
        }

        .card {
            box-shadow: none;
        }

    }

    @media (max-width: 768px) {

        .form-row {
            flex-direction: column;
        }

        .student-info,
        .summary {
            grid-template-columns: 1fr;
        }

        .page-header > div:last-child {
            flex-wrap: wrap;
        }

    }

</style>

@endpush
