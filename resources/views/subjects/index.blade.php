@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Subjects</h1>
        <p>Manage all school subjects.</p>
    </div>

    <a href="{{ route('subjects.create') }}" class="btn btn-primary">
        + Add Subject
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Search --}}
<div class="card">

    <form method="GET"
          action="{{ route('subjects.index') }}"
          style="display:flex; gap:10px;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by subject name, code or class..."
            style="
                flex:1;
                padding:12px 15px;
                border:1px solid #d1d5db;
                border-radius:8px;
                font-size:15px;
                outline:none;
            "
        >

        <button type="submit" class="btn btn-primary">
            🔍 Search
        </button>

        @if(request('search'))

            <a href="{{ route('subjects.index') }}"
               class="btn btn-secondary">
                Clear
            </a>

        @endif

    </form>

</div>

{{-- Subject Table --}}
<div class="card" style="padding:0; overflow-x:auto;">

    <div style="padding:20px; border-bottom:1px solid #e5e7eb;">
        <h3 style="font-size:18px; font-weight:600;">
            Subject List
        </h3>
    </div>

    <table style="width:100%; border-collapse:collapse; min-width:850px;">

        <thead>

            <tr style="background:#f8fafc;">

                <th style="padding:15px; text-align:left;">
                    #
                </th>

                <th style="padding:15px; text-align:left;">
                    Subject Name
                </th>

                <th style="padding:15px; text-align:left;">
                    Subject Code
                </th>

                <th style="padding:15px; text-align:left;">
                    Class
                </th>

                <th style="padding:15px; text-align:left;">
                    Description
                </th>

                <th style="padding:15px; text-align:left;">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($subjects as $subject)

                <tr style="border-top:1px solid #f1f5f9;">

                    <td style="padding:15px;">
                        {{ $subjects->firstItem() + $loop->index }}
                    </td>

                    <td style="padding:15px;">
                        <strong>{{ $subject->name }}</strong>
                    </td>

                    <td style="padding:15px;">

                        <span style="
                            display:inline-block;
                            background:#dbeafe;
                            color:#1d4ed8;
                            padding:5px 10px;
                            border-radius:999px;
                            font-size:13px;
                            font-weight:600;
                        ">
                            {{ $subject->subject_code }}
                        </span>

                    </td>

                    <td style="padding:15px;">
                        {{ $subject->class ?? '-' }}
                    </td>

                    <td style="padding:15px; color:#64748b;">

                        {{ $subject->description
                            ? \Illuminate\Support\Str::limit($subject->description, 50)
                            : '-' }}

                    </td>

                    <td style="padding:15px;">

                        <div style="display:flex; gap:7px; align-items:center;">

                            {{-- View --}}
                            <a
                                href="{{ route('subjects.show', $subject) }}"
                                class="btn btn-info"
                                style="padding:7px 11px; font-size:13px;"
                            >
                                View
                            </a>

                            {{-- Edit --}}
                            <a
                                href="{{ route('subjects.edit', $subject) }}"
                                class="btn btn-warning"
                                style="padding:7px 11px; font-size:13px;"
                            >
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form
                                action="{{ route('subjects.destroy', $subject) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this subject?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                    style="padding:7px 11px; font-size:13px;"
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
                        colspan="6"
                        style="
                            text-align:center;
                            padding:40px;
                            color:#6b7280;
                        "
                    >

                        @if(request('search'))

                            No subjects found for
                            "<strong>{{ request('search') }}</strong>"

                        @else

                            No subjects found.

                        @endif

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- Pagination --}}
    @if($subjects->hasPages())

        <div style="padding:20px;">
            {{ $subjects->links() }}
        </div>

    @endif

</div>

@endsection
