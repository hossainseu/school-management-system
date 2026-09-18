@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Class Details</h1>
        <p>View complete class information.</p>
    </div>

    <div class="header-actions">
        <button type="button"
                class="btn btn-primary"
                onclick="window.print()">
            🖨 Print Class
        </button>

        <a
            href="{{ route('classes.edit', $class) }}"
            class="btn btn-edit"
        >
            ✎ Edit Class
        </a>

        <a
            href="{{ route('classes.index') }}"
            class="btn btn-secondary"
        >
            ← Classes
        </a>


    </div>

</div>


<div class="card class-details-card">

    <!-- Class Profile -->
    <div class="profile-header">

        <div class="class-avatar">
            🏫
        </div>

        <div>

            <h2>
                {{ $class->name }}
            </h2>

            <p>
                Class Code:
                <strong>{{ $class->class_code }}</strong>
            </p>

        </div>

    </div>


    <!-- Class Information -->
    <div class="info-grid">

        <!-- Class Name -->
        <div class="info-item">

            <span class="label">
                Class Name
            </span>

            <span class="value">
                {{ $class->name }}
            </span>

        </div>


        <!-- Class Code -->
        <div class="info-item">

            <span class="label">
                Class Code
            </span>

            <span class="value">
                {{ $class->class_code }}
            </span>

        </div>


        <!-- Section -->
        <div class="info-item">

            <span class="label">
                Section
            </span>

            <span class="value">
                {{ $class->section ?: 'N/A' }}
            </span>

        </div>


        <!-- Created -->
        <div class="info-item">

            <span class="label">
                Created
            </span>

            <span class="value">

                {{ $class->created_at?->format('d M Y') ?? 'N/A' }}

            </span>

        </div>


        <!-- Description -->
        <div class="info-item full-width">

            <span class="label">
                Description
            </span>

            <span class="value description">

                {{ $class->description ?: 'No description available.' }}

            </span>

        </div>

    </div>


<div class="assigned-students-section">

    <div class="section-header">
        <h3>Students in This Class</h3>

        <span class="student-count">
            {{ $class->students()->count() }} Students
        </span>
    </div>

    @php
        $students = $class->students()->orderBy('name')->get();
    @endphp

    @if($students->count())

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Section</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $student->name }}</strong>
                            </td>

                            <td>{{ $student->student_id }}</td>

                            <td>{{ $student->section ?: 'N/A' }}</td>

                            <td>{{ $student->phone ?: 'N/A' }}</td>

                            <td>
                                <a href="{{ route('students.show', $student) }}"
                                   class="btn btn-primary btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else

        <div class="empty-students">
            No students found in this class.
        </div>

    @endif

</div>


    <!-- Actions -->
    <div class="bottom-actions">

        <a
            href="{{ route('classes.edit', $class) }}"
            class="btn btn-primary"
        >
            ✎ Edit Class
        </a>

        <a
            href="{{ route('classes.index') }}"
            class="btn btn-secondary"
        >
            Back to Classes
        </a>

    </div>


</div>

@endsection

@push('styles')

<style>

@media print {
    @page {
        size: A4;
        margin: 15mm;
    }

    body {
        background: white !important;
        color: #111827 !important;
    }

    .sidebar,
    .mobile-header,
    .overlay,
    .header-actions,
    .bottom-actions {
        display: none !important;
    }

    .main {
        margin-left: 0 !important;
        padding: 0 !important;
    }

    .class-details-card {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
    }

    .profile-header,
    .info-grid,
    .assigned-students-section {
        page-break-inside: avoid;
    }

    .info-item {
        background: white !important;
        border: 1px solid #d1d5db !important;
    }

    .table-wrapper {
        overflow: visible !important;
        border: 1px solid #d1d5db !important;
    }

    .table-wrapper table {
        min-width: 0 !important;
        width: 100% !important;
    }

    a {
        color: #111827 !important;
        text-decoration: none !important;
    }
}


.assigned-students-section {
    margin-top: 30px;
}

.assigned-students-section .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.assigned-students-section h3 {
    margin: 0;
    font-size: 18px;
    color: #111827;
}

.student-count {
    background: #dbeafe;
    color: #1d4ed8;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
}

.empty-students {
    padding: 25px;
    text-align: center;
    background: #f9fafb;
    border: 1px dashed #d1d5db;
    border-radius: 10px;
    color: #6b7280;
}

.btn-sm {
    padding: 6px 10px;
    font-size: 12px;
}

@media (max-width: 768px) {
    .assigned-students-section .section-header {
        align-items: flex-start;
        flex-direction: column;
    }
}



    .class-details-card {
        max-width: 900px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .class-avatar {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: #dbeafe;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        flex-shrink: 0;
    }

    .profile-header h2 {
        margin: 0 0 6px;
        font-size: 24px;
        color: #111827;
    }

    .profile-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .profile-header strong {
        color: #374151;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .info-item {
        padding: 17px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 9px;
    }

    .info-item.full-width {
        grid-column: 1 / -1;
    }

    .label {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .value {
        display: block;
        color: #1f2937;
        font-size: 15px;
        font-weight: 600;
        word-break: break-word;
    }

    .description {
        font-weight: 400;
        line-height: 1.6;
        white-space: pre-line;
    }

    .bottom-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #e5e7eb;
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

        .header-actions {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }

        .header-actions .btn {
            text-align: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-item.full-width {
            grid-column: auto;
        }

        .profile-header {
            align-items: flex-start;
        }

        .bottom-actions {
            flex-direction: column;
        }

        .bottom-actions .btn {
            text-align: center;
        }

    }

</style>

@endpush
