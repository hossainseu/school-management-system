@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Attendance</h1>
        <p>Manage student attendance by date.</p>
    </div>

    <a href="{{ route('attendances.create') }}" class="btn btn-primary">
        + Take Attendance
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Date Filter --}}
<div class="card">

    <form method="GET"
          action="{{ route('attendances.index') }}"
          style="
              display:flex;
              gap:10px;
              align-items:end;
              flex-wrap:wrap;
          ">

        <div style="display:flex; flex-direction:column; gap:6px;">

            <label
                for="date"
                style="font-size:14px; font-weight:600;"
            >
                Attendance Date
            </label>

            <input
                type="date"
                id="date"
                name="date"
                value="{{ $date }}"
                style="
                    padding:11px 12px;
                    border:1px solid #d1d5db;
                    border-radius:8px;
                "
            >

        </div>

        <button type="submit" class="btn btn-primary">
            Filter
        </button>

    </form>

</div>

{{-- Attendance Table --}}
<div class="card" style="padding:0; overflow-x:auto;">

    <div style="
        padding:20px;
        border-bottom:1px solid #e5e7eb;
    ">
        <h3 style="font-size:18px; font-weight:600;">
            Attendance for {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
        </h3>
    </div>

    <table style="
        width:100%;
        border-collapse:collapse;
        min-width:850px;
    ">

        <thead>

            <tr style="background:#f8fafc;">

                <th style="padding:15px; text-align:left;">
                    #
                </th>

                <th style="padding:15px; text-align:left;">
                    Student ID
                </th>

                <th style="padding:15px; text-align:left;">
                    Student Name
                </th>

                <th style="padding:15px; text-align:left;">
                    Class
                </th>

                <th style="padding:15px; text-align:left;">
                    Section
                </th>

                <th style="padding:15px; text-align:left;">
                    Status
                </th>

                <th style="padding:15px; text-align:left;">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($students as $index => $student)

                @php
                    $status = $attendances[$student->id] ?? null;
                @endphp

                <tr style="border-top:1px solid #f1f5f9;">

                    <td style="padding:15px;">
                        {{ $index + 1 }}
                    </td>

                    <td style="padding:15px;">
                        {{ $student->student_id }}
                    </td>

                    <td style="padding:15px;">
                        <strong>{{ $student->name }}</strong>
                    </td>

                    <td style="padding:15px;">
                        {{ $student->class ?? '-' }}
                    </td>

                    <td style="padding:15px;">
                        {{ $student->section ?? '-' }}
                    </td>

                    <td style="padding:15px;">

                        @if($status === 'present')

                            <span style="
                                display:inline-block;
                                padding:6px 11px;
                                border-radius:20px;
                                background:#dcfce7;
                                color:#166534;
                                font-size:13px;
                                font-weight:700;
                            ">
                                Present
                            </span>

                        @elseif($status === 'absent')

                            <span style="
                                display:inline-block;
                                padding:6px 11px;
                                border-radius:20px;
                                background:#fee2e2;
                                color:#991b1b;
                                font-size:13px;
                                font-weight:700;
                            ">
                                Absent
                            </span>

                        @elseif($status === 'late')

                            <span style="
                                display:inline-block;
                                padding:6px 11px;
                                border-radius:20px;
                                background:#fef3c7;
                                color:#92400e;
                                font-size:13px;
                                font-weight:700;
                            ">
                                Late
                            </span>

                        @else

                            <span style="
                                display:inline-block;
                                padding:6px 11px;
                                border-radius:20px;
                                background:#e5e7eb;
                                color:#374151;
                                font-size:13px;
                                font-weight:700;
                            ">
                                Not Taken
                            </span>

                        @endif

                    </td>

                    <td style="padding:15px;">

                        <div style="
                            display:flex;
                            gap:7px;
                            align-items:center;
                        ">

                            @if($status)

                                @php
                                    $attendance = \App\Models\Attendance::where('student_id', $student->id)
                                        ->where('date', $date)
                                        ->first();
                                @endphp

                                @if($attendance)

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('attendances.edit', $attendance->id) }}"
                                        class="btn btn-warning"
                                        style="
                                            padding:7px 11px;
                                            font-size:13px;
                                        "
                                    >
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('attendances.destroy', $attendance->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this attendance?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                            style="
                                                padding:7px 11px;
                                                font-size:13px;
                                            "
                                        >
                                            Delete
                                        </button>

                                    </form>

                                @endif

                            @else

                                {{-- Take Attendance --}}
                                <a
                                    href="{{ route('attendances.create', ['date' => $date]) }}"
                                    class="btn btn-primary"
                                    style="
                                        padding:7px 11px;
                                        font-size:13px;
                                    "
                                >
                                    Take Attendance
                                </a>

                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        style="
                            text-align:center;
                            padding:40px;
                            color:#6b7280;
                        "
                    >
                        No students found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
