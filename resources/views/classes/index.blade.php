@extends('layouts.school')

@section('content')

<div class="page-header">
    <div>
        <h1>Classes</h1>
        <p>Manage your school classes.</p>
    </div>

    <a href="{{ route('classes.create') }}" class="btn btn-primary">
        + Add Class
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
      action="{{ route('classes.index') }}"
      class="classes-filter-form"
      style="
          display:grid;
          grid-template-columns:2fr 1fr auto auto;
          gap:10px;
          align-items:center;
      ">

    <input
        type="text"
        name="search"
        value="{{ $search ?? request('search') }}"
        placeholder="Search class, code or section..."
    >

    <select name="section">
        <option value="">All Sections</option>

        @foreach($sections as $item)
            <option value="{{ $item }}"
                {{ ($section ?? request('section')) === $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">
        🔍 Search
    </button>

    @if(request('search') || request('section'))
        <a href="{{ route('classes.index') }}"
           class="btn btn-secondary">
            Clear
        </a>
    @endif

</form>


</div>

{{-- Classes Table --}}
<div class="card" style="padding:0; overflow-x:auto;">

    <table style="width:100%; border-collapse:collapse; min-width:800px;">

        <thead>
            <tr style="background:#f8fafc;">

                <th style="padding:15px; text-align:left;">
                    #
                </th>

                <th style="padding:15px; text-align:left;">
                    Class Name
                </th>

                <th style="padding:15px; text-align:left;">
                    Class Code
                </th>

                <th style="padding:15px; text-align:left;">
                    Section
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

            @forelse($classes as $class)

                <tr style="border-top:1px solid #f1f5f9;">

                    <td style="padding:15px;">
                        {{ $classes->firstItem() + $loop->index }}
                    </td>

                    <td style="padding:15px;">
                        <strong>{{ $class->name }}</strong>
                    </td>

                    <td style="padding:15px;">
                        {{ $class->class_code }}
                    </td>

                    <td style="padding:15px;">
                        {{ $class->section ?? '-' }}
                    </td>

                    <td style="padding:15px;">
                        {{ $class->description ?? '-' }}
                    </td>

                    <td style="padding:15px;">

                        <div style="display:flex; gap:7px;">

                            {{-- View --}}
                            <a
                                href="{{ route('classes.show', $class) }}"
                                class="btn btn-info"
                                style="padding:7px 11px; font-size:13px;"
                            >
                                View
                            </a>

                            {{-- Edit --}}
                            <a
                                href="{{ route('classes.edit', $class) }}"
                                class="btn btn-warning"
                                style="padding:7px 11px; font-size:13px;"
                            >
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form
                                action="{{ route('classes.destroy', $class) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this class?');"
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

                            No classes found for
                            "<strong>{{ request('search') }}</strong>"

                        @else

                            No classes found.

                        @endif

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- Pagination --}}
    @if($classes->hasPages())

        <div style="padding:20px;">
            {{ $classes->links() }}
        </div>

    @endif

</div>

@endsection

@push('styles')
<style>
    @media (max-width: 768px) {

        .classes-filter-form {
            grid-template-columns: 1fr !important;
        }

        .classes-filter-form input,
        .classes-filter-form select,
        .classes-filter-form button,
        .classes-filter-form a {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>
@endpush


