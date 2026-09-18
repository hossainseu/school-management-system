@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Student Results</h1>
        <p>Manage all student examination results.</p>
    </div>

    <a href="{{ route('results.create') }}" class="btn btn-primary">
        + Add Result
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Search -->
<div class="card" style="margin-bottom: 20px;">
    <form method="GET" action="{{ route('results.index') }}"
          style="display: flex; gap: 10px;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search student, ID, subject, exam or grade..."
            style="
                flex: 1;
                padding: 11px 13px;
                border: 1px solid #d1d5db;
                border-radius: 7px;
                font-size: 14px;
            "
        >

        <button type="submit" class="btn btn-primary">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('results.index') }}"
               class="btn btn-secondary">
                Clear
            </a>
        @endif

    </form>
</div>

<!-- Results Table -->
<div class="card" style="overflow-x: auto;">

    <table style="width: 100%; border-collapse: collapse; min-width: 900px;">

        <thead>
            <tr>
                <th style="padding: 14px 16px; text-align: left;">#</th>
                <th style="padding: 14px 16px; text-align: left;">Student</th>
                <th style="padding: 14px 16px; text-align: left;">Student ID</th>
                <th style="padding: 14px 16px; text-align: left;">Subject</th>
                <th style="padding: 14px 16px; text-align: left;">Exam</th>
                <th style="padding: 14px 16px; text-align: left;">Marks</th>
                <th style="padding: 14px 16px; text-align: left;">Grade</th>
                <th style="padding: 14px 16px; text-align: left;">GPA</th>
                <th style="padding: 14px 16px; text-align: left;">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($results as $result)

                <tr>

                    <td style="padding: 14px 16px;">
                        {{ $results->firstItem() + $loop->index }}
                    </td>

                    <td style="padding: 14px 16px;">
                        <strong>
                            {{ $result->student->name }}
                        </strong>
                    </td>

                    <td style="padding: 14px 16px;">
                        {{ $result->student->student_id }}
                    </td>

                    <td style="padding: 14px 16px;">
                        {{ $result->subject->name }}
                    </td>

                    <td style="padding: 14px 16px;">
                        {{ $result->exam_name }}
                    </td>

                    <td style="padding: 14px 16px;">
                        <strong>
                            {{ $result->marks }}
                        </strong>
                    </td>

                    <td style="padding: 14px 16px;">
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

                    <td style="padding: 14px 16px;">
                        <strong>
                            {{ $result->gpa }}
                        </strong>
                    </td>

                    <td style="padding: 14px 16px;">

                        <div style="
                            display: flex;
                            gap: 6px;
                            align-items: center;
                        ">

                            <a
                                href="{{ route('results.show', $result) }}"
                                class="btn btn-info"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('results.edit', $result) }}"
                                class="btn btn-warning"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('results.destroy', $result) }}"
                                onsubmit="return confirm('Are you sure you want to delete this result?');"
                                style="display: inline;"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td
                        colspan="9"
                        style="
                            text-align: center;
                            padding: 40px;
                            color: #6b7280;
                        "
                    >
                        No results found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div style="padding: 20px;">
        {{ $results->links() }}
    </div>

</div>


@endsection
