@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Teachers</h1>
        <p>Manage all teachers in your school.</p>
    </div>

    <a href="{{ route('teachers.create') }}" class="btn btn-primary">
        + Add Teacher
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
          action="{{ route('teachers.index') }}"
          style="display:flex; gap:10px;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by name, teacher ID, phone or subject..."
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
            <a href="{{ route('teachers.index') }}"
               class="btn btn-secondary">
                Clear
            </a>
        @endif

    </form>
</div>

{{-- Teachers Table --}}
<div class="card" style="padding:0; overflow-x:auto;">

    <table style="width:100%; border-collapse:collapse; min-width:900px;">

        <thead>
            <tr style="background:#f8fafc;">
                <th style="padding:15px; text-align:left;">#</th>
                <th style="padding:15px; text-align:left;">Teacher ID</th>
                <th style="padding:15px; text-align:left;">Name</th>
                <th style="padding:15px; text-align:left;">Subject</th>
                <th style="padding:15px; text-align:left;">Qualification</th>
                <th style="padding:15px; text-align:left;">Phone</th>
                <th style="padding:15px; text-align:left;">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($teachers as $teacher)

                <tr style="border-top:1px solid #f1f5f9;">

                    <td style="padding:15px;">
                        {{ $teachers->firstItem() + $loop->index }}
                    </td>

                    <td style="padding:15px;">
                        {{ $teacher->teacher_id }}
                    </td>

                    <td style="padding:15px;">
                        <strong>{{ $teacher->name }}</strong>
                    </td>

                    <td style="padding:15px;">
                        {{ $teacher->subject ?? '-' }}
                    </td>

                    <td style="padding:15px;">
                        {{ $teacher->qualification ?? '-' }}
                    </td>

                    <td style="padding:15px;">
                        {{ $teacher->phone ?? '-' }}
                    </td>

                    <td style="padding:15px;">

                        <div style="display:flex; gap:7px;">

                            <a
                                href="{{ route('teachers.show', $teacher) }}"
                                class="btn btn-info"
                                style="padding:7px 11px; font-size:13px;"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('teachers.edit', $teacher) }}"
                                class="btn btn-warning"
                                style="padding:7px 11px; font-size:13px;"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('teachers.destroy', $teacher) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this teacher?');"
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

                    <td colspan="7"
                        style="text-align:center; padding:40px;">

                        @if(request('search'))

                            No teachers found for
                            "<strong>{{ request('search') }}</strong>"

                        @else

                            No teachers found.

                        @endif

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- Pagination --}}
    @if($teachers->hasPages())

        <div style="padding:20px;">
            {{ $teachers->links() }}
        </div>

    @endif

</div>


@endsection
