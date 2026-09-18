@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>View Result</h1>
        <p>View detailed examination result information.</p>
    </div>

    <a href="{{ route('results.index') }}" class="btn btn-secondary">
        ← Results
    </a>

</div>

<div class="card result-card">

    <h2 class="card-title">
        Result Details
    </h2>

    <!-- Result Information -->
    <div class="info-grid">

        <div class="info-item">

            <span class="label">
                Student Name
            </span>

            <span class="value">
                {{ $result->student->name }}
            </span>

        </div>

        <div class="info-item">

            <span class="label">
                Student ID
            </span>

            <span class="value">
                {{ $result->student->student_id }}
            </span>

        </div>

        <div class="info-item">

            <span class="label">
                Subject
            </span>

            <span class="value">
                {{ $result->subject->name }}
            </span>

        </div>

        <div class="info-item">

            <span class="label">
                Subject Code
            </span>

            <span class="value">
                {{ $result->subject->subject_code }}
            </span>

        </div>

        <div class="info-item">

            <span class="label">
                Exam Name
            </span>

            <span class="value">
                {{ $result->exam_name }}
            </span>

        </div>

        <div class="info-item">

            <span class="label">
                Remarks
            </span>

            <span class="value">
                {{ $result->remarks ?: 'No remarks' }}
            </span>

        </div>

    </div>

    <!-- Result Summary -->
    <div class="result-box">

        <div class="result-item">

            <strong>
                {{ $result->marks }}
            </strong>

            <span>
                Marks
            </span>

        </div>

        <div class="result-item">

            <strong>
                {{ $result->grade }}
            </strong>

            <span>
                Grade
            </span>

        </div>

        <div class="result-item">

            <strong>
                {{ $result->gpa }}
            </strong>

            <span>
                GPA
            </span>

        </div>

    </div>

    <!-- Actions -->
    <div class="actions">

        <a
            href="{{ route('results.edit', $result) }}"
            class="btn btn-edit"
        >
            ✎ Edit Result
        </a>

        <a
            href="{{ route('results.index') }}"
            class="btn btn-secondary"
        >
            Back
        </a>

    </div>

</div>


@endsection

@push('styles')

<style>

    .result-card {
        max-width: 850px;
    }

    .card-title {
        margin: 0 0 25px;
        font-size: 22px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .info-item {
        padding: 16px;
        background: #f9fafb;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
    }

    .label {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .value {
        display: block;
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
    }

    .result-box {
        margin-top: 25px;
        padding: 22px;
        background: #eff6ff;
        border-radius: 10px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        text-align: center;
    }

    .result-item {
        padding: 10px;
    }

    .result-item strong {
        display: block;
        font-size: 28px;
        margin-bottom: 5px;
        color: #1f2937;
    }

    .result-item span {
        color: #6b7280;
        font-size: 13px;
    }

    .actions {
        margin-top: 25px;
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }

    .btn-edit:hover {
        background: #fde68a;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    @media (max-width: 768px) {

        .info-grid {
            grid-template-columns: 1fr;
        }

        .result-box {
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
