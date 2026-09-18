@extends('layouts.school')

@section('content')

<div class="page-header">


<div>
    <h1>Teacher Details</h1>
    <p>View complete teacher information.</p>
</div>

<div class="header-actions">

    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-edit">
        ✎ Edit Teacher
    </a>

    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
        ← Teachers
    </a>

</div>

</div>

<div class="card teacher-details-card">

{{-- Profile Header --}}
<div class="profile-header">

    <div class="avatar">
        👨‍🏫
    </div>

    <div>
        <h2>{{ $teacher->name }}</h2>

        <p>
            Teacher ID:
            <strong>{{ $teacher->teacher_id }}</strong>
        </p>
    </div>

</div>

{{-- Teacher Information --}}
<div class="section-title">

    <h3>Teacher Information</h3>

    <p>
        Personal, professional and contact information.
    </p>

</div>

<div class="info-grid">

    <div class="info-item">
        <span class="label">Teacher Name</span>
        <span class="value">{{ $teacher->name }}</span>
    </div>

    <div class="info-item">
        <span class="label">Teacher ID</span>
        <span class="value">{{ $teacher->teacher_id }}</span>
    </div>

    <div class="info-item">
        <span class="label">Email</span>
        <span class="value">{{ $teacher->email ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Phone</span>
        <span class="value">{{ $teacher->phone ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Subject</span>
        <span class="value">{{ $teacher->subject ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Qualification</span>
        <span class="value">{{ $teacher->qualification ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Joining Date</span>

        <span class="value">

            @if($teacher->joining_date)

                {{ \Carbon\Carbon::parse($teacher->joining_date)->format('d M Y') }}

            @else

                N/A

            @endif

        </span>
    </div>

    <div class="info-item">
        <span class="label">Address</span>
        <span class="value">{{ $teacher->address ?: 'N/A' }}</span>
    </div>

</div>

{{-- Professional Summary --}}
<div class="professional-summary">

    <div class="section-title">

        <h3>Professional Summary</h3>

        <p>
            Quick overview of the teacher's professional information.
        </p>

    </div>

    <div class="summary-grid">

        <div class="summary-box">

            <span class="summary-icon">📚</span>

            <div>
                <span class="summary-label">Subject</span>
                <strong>{{ $teacher->subject ?: 'N/A' }}</strong>
            </div>

        </div>

        <div class="summary-box">

            <span class="summary-icon">🎓</span>

            <div>
                <span class="summary-label">Qualification</span>
                <strong>{{ $teacher->qualification ?: 'N/A' }}</strong>
            </div>

        </div>

        <div class="summary-box">

            <span class="summary-icon">📅</span>

            <div>
                <span class="summary-label">Joining Date</span>

                <strong>

                    @if($teacher->joining_date)
                        {{ \Carbon\Carbon::parse($teacher->joining_date)->format('d M Y') }}
                    @else
                        N/A
                    @endif

                </strong>

            </div>

        </div>

    </div>

</div>

<div class="assigned-students-section">

    <div class="section-header">
        <h3>Assigned Students</h3>
        <span class="student-count">{{ $totalStudents }} Students</span>
    </div>

    @if($students->count())

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Section</th>
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
                            <td>{{ $student->class ?: 'N/A' }}</td>
                            <td>{{ $student->section ?: 'N/A' }}</td>
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
            No assigned students found for this teacher.
        </div>

    @endif

</div>


{{-- Bottom Actions --}}
<div class="bottom-actions">

    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-primary">
        ✎ Edit Teacher
    </a>

    <button type="button" class="btn btn-secondary" onclick="window.print()">
        🖨️ Print Profile
    </button>

    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
        ← Teacher List
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

    .teacher-details-card {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
    }

    .profile-header,
    .info-grid,
    .summary-grid,
    .professional-summary,
    .assigned-students-section {
        page-break-inside: avoid;
    }

    .info-item,
    .summary-box {
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

    .teacher-details-card {
        max-width: 950px;
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

    .avatar {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: #dbeafe;
        color: #1d4ed8;
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

    .section-title {
        margin-bottom: 18px;
    }

    .section-title h3 {
        margin: 0 0 5px;
        font-size: 20px;
        color: #111827;
    }

    .section-title p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
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

    .professional-summary {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e5e7eb;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .summary-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 17px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .summary-icon {
        font-size: 24px;
    }

    .summary-label {
        display: block;
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .summary-box strong {
        display: block;
        color: #111827;
        font-size: 15px;
        word-break: break-word;
    }

    .bottom-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
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

    @media (max-width: 900px) {

        .summary-grid {
            grid-template-columns: 1fr 1fr;
        }

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

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .profile-header {
            align-items: flex-start;
        }

        .bottom-actions {
            flex-direction: column;
        }

        .bottom-actions .btn {
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

    }

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

        .teacher-details-card {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
            border: none !important;
        }

        .info-grid,
        .summary-grid,
        .profile-header,
        .professional-summary {
            page-break-inside: avoid;
        }

        .info-item,
        .summary-box {
            background: white !important;
            border: 1px solid #d1d5db !important;
        }

        a {
            color: #111827 !important;
            text-decoration: none !important;
        }

    }

</style>

@endpush
