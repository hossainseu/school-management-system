@extends('layouts.school')

@section('content')

<div class="page-header">

<div>
    <h1>Student Details</h1>
    <p>View complete student information.</p>
</div>

<div class="header-actions">

    <a href="{{ route('students.edit', $student) }}" class="btn btn-edit">
        ✎ Edit Student
    </a>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        ← Students
    </a>

</div>


</div>

<div class="card student-details-card">


{{-- Student Profile Header --}}
<div class="profile-header">

    <div class="avatar">
        {{ strtoupper(substr($student->name, 0, 1)) }}
    </div>

    <div>
        <h2>{{ $student->name }}</h2>

        <p>
            Student ID:
            <strong>{{ $student->student_id }}</strong>
        </p>
    </div>

</div>

{{-- Basic Information --}}
<div class="section-title">
    <h3>Basic Information</h3>
    <p>Student personal and contact information.</p>
</div>

<div class="info-grid">

    <div class="info-item">
        <span class="label">Student Name</span>
        <span class="value">{{ $student->name }}</span>
    </div>

    <div class="info-item">
        <span class="label">Student ID</span>
        <span class="value">{{ $student->student_id }}</span>
    </div>

    <div class="info-item">
        <span class="label">Email</span>
        <span class="value">{{ $student->email ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Phone</span>
        <span class="value">{{ $student->phone ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Class</span>
        <span class="value">{{ $student->class ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Section</span>
        <span class="value">{{ $student->section ?: 'N/A' }}</span>
    </div>

    <div class="info-item">
        <span class="label">Date of Birth</span>
        <span class="value">
            @if($student->date_of_birth)
                {{ \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') }}
            @else
                N/A
            @endif
        </span>
    </div>

    <div class="info-item">
        <span class="label">Address</span>
        <span class="value">{{ $student->address ?: 'N/A' }}</span>
    </div>

</div>

{{-- Academic Summary --}}
<div class="academic-summary">

    <div class="section-title">
        <h3>Academic Summary</h3>
        <p>Student academic performance and attendance overview.</p>
    </div>

    <div class="summary-grid">

        <div class="summary-box">
            <span class="summary-icon">📚</span>

            <div>
                <span class="summary-label">Subjects</span>
                <strong>{{ $totalSubjects }}</strong>
            </div>
        </div>

        <div class="summary-box">
            <span class="summary-icon">📊</span>

            <div>
                <span class="summary-label">Average Marks</span>
                <strong>{{ number_format($averageMarks, 2) }}</strong>
            </div>
        </div>

        <div class="summary-box">
            <span class="summary-icon">⭐</span>

            <div>
                <span class="summary-label">Average GPA</span>
                <strong>{{ number_format($totalGpa, 2) }}</strong>
            </div>
        </div>

        <div class="summary-box">
            <span class="summary-icon">✅</span>

            <div>
                <span class="summary-label">Attendance</span>
                <strong>{{ number_format($attendancePercentage, 2) }}%</strong>
            </div>
        </div>

    </div>

    {{-- Recent Results --}}
    <div class="results-section">

        <h3>Recent Results</h3>

        @if($results->count())

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>Exam</th>
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Grade</th>
                            <th>GPA</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($results as $result)

                            <tr>

                                <td>
                                    {{ $result->exam_name }}
                                </td>

                                <td>
                                    {{ $result->subject->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $result->marks }}
                                </td>

                                <td>
                                    <span class="grade-badge">
                                        {{ $result->grade }}
                                    </span>
                                </td>

                                <td>
                                    <span class="gpa-badge">
                                        {{ number_format($result->gpa, 2) }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-results">
                No academic results available for this student.
            </div>

        @endif

    </div>

    {{-- Attendance Details --}}
    <div class="attendance-info">
    <div class="attendance-table-wrapper">

    <h3>Attendance History</h3>

    @if($attendances->count())

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($attendances as $attendance)

                        <tr>

                            <td>
                                {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                            </td>

                            <td>
                                <span class="attendance-badge attendance-{{ $attendance->status }}">
                                    {{ ucfirst($attendance->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $attendance->remarks ?: 'N/A' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty-results">
            No attendance records available for this student.
        </div>

    @endif

</div>

        <h3>Attendance Overview</h3>

        <div class="attendance-grid">

            <div class="attendance-box">
                <span>Total Attendance</span>
                <strong>{{ $attendanceTotal }}</strong>
            </div>

            <div class="attendance-box">
                <span>Present</span>
                <strong>{{ $attendancePresent }}</strong>
            </div>

            <div class="attendance-box">
                <span>Attendance Rate</span>
                <strong>{{ number_format($attendancePercentage, 2) }}%</strong>
            </div>

        </div>

    </div>

</div>

{{-- Bottom Actions --}}
<div class="bottom-actions">

    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">
        ✎ Edit Student
    </a>

    <button type="button" class="btn btn-secondary" onclick="window.print()">
        🖨️ Print Profile
    </button>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        ← Back to Students
    </a>

</div>


</div>

@endsection

@push('styles')

<style>

.attendance-table-wrapper {
    margin-top: 25px;
}

.attendance-table-wrapper h3 {
    margin: 0 0 15px;
    font-size: 18px;
    color: #111827;
}

.attendance-table-wrapper .table-wrapper {
    margin-top: 0;
}
    .student-details-card {
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
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #2563eb;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: 700;
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

    .academic-summary {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e5e7eb;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .summary-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
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
        font-size: 18px;
    }

    .results-section {
        margin-top: 30px;
    }

    .results-section h3,
    .attendance-info h3 {
        margin: 0 0 15px;
        font-size: 18px;
        color: #111827;
    }

    .table-wrapper {
        overflow-x: auto;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .table-wrapper table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .table-wrapper th,
    .table-wrapper td {
        padding: 12px 14px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .table-wrapper th {
        background: #f9fafb;
        color: #374151;
        font-size: 13px;
    }

    .table-wrapper td {
        color: #4b5563;
        font-size: 14px;
    }

    .table-wrapper tr:last-child td {
        border-bottom: none;
    }

    .empty-results {
        padding: 20px;
        text-align: center;
        color: #6b7280;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .attendance-info {
        margin-top: 30px;
    }

    .attendance-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .attendance-box {
        padding: 18px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
    }

    .attendance-box span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .attendance-box strong {
        color: #111827;
        font-size: 22px;
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

        .attendance-grid {
            grid-template-columns: 1fr 1fr;
        }

    }

    @media (max-width: 768px) {

        .page-header {
            align-items: flex-start;
        }

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

        .attendance-grid {
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

    .page-header {
        margin-bottom: 20px !important;
    }

    .page-header h1 {
        font-size: 24px !important;
    }

    .page-header p {
        font-size: 12px !important;
    }

    .student-details-card {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
    }

    .profile-header {
        page-break-inside: avoid;
    }

    .info-grid {
        page-break-inside: avoid;
    }

    .academic-summary {
        page-break-inside: auto;
    }

    .summary-grid {
        page-break-inside: avoid;
    }

    .summary-box {
        background: white !important;
    }

    .results-section {
        page-break-inside: auto;
    }

    .table-wrapper {
        overflow: visible !important;
        border: 1px solid #d1d5db !important;
    }

    .table-wrapper table {
        min-width: 0 !important;
        width: 100% !important;
    }

    .attendance-info {
        page-break-inside: avoid;
    }

    .attendance-grid {
        page-break-inside: avoid;
    }

    .info-item,
    .summary-box,
    .attendance-box {
        background: white !important;
        border: 1px solid #d1d5db !important;
    }

    a {
        color: #111827 !important;
        text-decoration: none !important;
    }

}
.grade-badge,
.gpa-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
}

.grade-badge {
    background: #dbeafe;
    color: #1d4ed8;
}

.gpa-badge {
    background: #dcfce7;
    color: #15803d;
}

.attendance-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
}

.attendance-present {
    background: #dcfce7;
    color: #15803d;
}

.attendance-absent {
    background: #fee2e2;
    color: #b91c1c;
}

.attendance-late {
    background: #fef3c7;
    color: #b45309;
}
</style>

@endpush
