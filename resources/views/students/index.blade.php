@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>👨‍🎓 Students</h1>
        <p>Manage all students in your school.</p>
    </div>

    <a href="{{ route('students.create') }}" class="btn btn-primary">
        + Add Student
    </a>

</div>

<!-- Search & Filters -->

<div style="
    background:white;
    padding:20px;
    border-radius:12px;
    margin-bottom:20px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
">

    <form method="GET"
      action="{{ route('students.index') }}"
      class="students-filter-form"
      style="
          display:grid;
          grid-template-columns:2fr 1fr 1fr auto auto;
          gap:10px;
          align-items:center;
      ">

        <!-- Search -->
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by name, student ID, phone..."
            style="
                width:100%;
                box-sizing:border-box;
                padding:12px 15px;
                border:1px solid #d1d5db;
                border-radius:8px;
                font-size:15px;
                outline:none;
            "
        >

        <!-- Class Filter -->
        <select
            name="class"
            style="
                width:100%;
                box-sizing:border-box;
                padding:12px 15px;
                border:1px solid #d1d5db;
                border-radius:8px;
                font-size:15px;
                background:white;
                outline:none;
            "
        >

            <option value="">All Classes</option>

            @foreach($classes as $className)

                <option
                    value="{{ $className }}"
                    {{ request('class') == $className ? 'selected' : '' }}
                >
                    {{ $className }}
                </option>

            @endforeach

        </select>

        <!-- Section Filter -->
        <select
            name="section"
            style="
                width:100%;
                box-sizing:border-box;
                padding:12px 15px;
                border:1px solid #d1d5db;
                border-radius:8px;
                font-size:15px;
                background:white;
                outline:none;
            "
        >

            <option value="">All Sections</option>

            @foreach($sections as $sectionName)

                <option
                    value="{{ $sectionName }}"
                    {{ request('section') == $sectionName ? 'selected' : '' }}
                >
                    {{ $sectionName }}
                </option>

            @endforeach

        </select>

        <!-- Search Button -->
        <button
            type="submit"
            class="btn btn-primary"
        >
            🔍 Search
        </button>

        <!-- Clear -->
        @if(request('search') || request('class') || request('section'))

            <a
                href="{{ route('students.index') }}"
                class="btn"
                style="
                    background:#64748b;
                    color:white;
                    text-decoration:none;
                    text-align:center;
                "
            >
                Clear
            </a>

        @endif

    </form>

</div>

<!-- Students Table -->

<div style="
    background:white;
    border-radius:12px;
    overflow-x:auto;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
">

    <table style="
        width:100%;
        border-collapse:collapse;
        min-width:850px;
    ">

        <thead>

            <tr>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    #
                </th>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    Student ID
                </th>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    Name
                </th>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    Class
                </th>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    Section
                </th>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    Phone
                </th>

                <th style="padding:15px; text-align:left; background:#f8fafc;">
                    Actions
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($students as $student)

                <tr>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">
                        {{ $students->firstItem() + $loop->index }}
                    </td>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">
                        {{ $student->student_id }}
                    </td>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">
                        <strong>{{ $student->name }}</strong>
                    </td>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">
                        {{ $student->class ?? '-' }}
                    </td>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">
                        {{ $student->section ?? '-' }}
                    </td>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">
                        {{ $student->phone ?? '-' }}
                    </td>

                    <td style="padding:15px; border-bottom:1px solid #f1f5f9;">

                        <div style="
                            display:flex;
                            gap:7px;
                        ">

                            <a
                                href="{{ route('students.show', $student) }}"
                                style="
                                    background:#dbeafe;
                                    color:#1d4ed8;
                                    padding:7px 11px;
                                    border-radius:6px;
                                    text-decoration:none;
                                    font-size:13px;
                                ">
                                View
                            </a>


                            <a
                                href="{{ route('students.edit', $student) }}"
                                style="
                                    background:#fef3c7;
                                    color:#92400e;
                                    padding:7px 11px;
                                    border-radius:6px;
                                    text-decoration:none;
                                    font-size:13px;
                                ">
                                Edit
                            </a>


                            <form
                                action="{{ route('students.destroy', $student) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this student?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    style="
                                        background:#fee2e2;
                                        color:#b91c1c;
                                        border:none;
                                        padding:7px 11px;
                                        border-radius:6px;
                                        cursor:pointer;
                                        font-size:13px;
                                    ">
                                    Delete
                                </button>

                            </form>

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
                        "
                    >

                        @if(request('search'))

                            No students found for
                            "<strong>{{ request('search') }}</strong>"

                        @else

                            No students found.

                        @endif

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    @if($students->hasPages())

        <div style="padding:20px;">
            {{ $students->links() }}
        </div>

    @endif

</div>

@endsection
@push('styles')

<style>

    @media (max-width: 768px) {

        .students-filter-form {
            grid-template-columns: 1fr !important;
        }

        .students-filter-form input,
        .students-filter-form select,
        .students-filter-form button,
        .students-filter-form a {
            width: 100%;
            box-sizing: border-box;
        }

    }

</style>

@endpush