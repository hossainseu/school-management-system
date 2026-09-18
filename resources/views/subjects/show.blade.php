@extends('layouts.school')

@section('content')

<div class="page-header">

    <div>
        <h1>Subject Details</h1>
        <p>View complete subject information.</p>
    </div>

    <div class="header-actions">

        <a
            href="{{ route('subjects.edit', $subject) }}"
            class="btn btn-edit"
        >
            ✎ Edit Subject
        </a>

        <a
            href="{{ route('subjects.index') }}"
            class="btn btn-secondary"
        >
            ← Subjects
        </a>

    </div>

</div>


<div class="card subject-details-card">

    {{-- Subject Header --}}
    <div class="profile-header">

        <div class="subject-avatar">
            📚
        </div>

        <div>

            <h2>{{ $subject->name }}</h2>

            <p>
                Subject Code:
                <strong>{{ $subject->subject_code }}</strong>
            </p>

        </div>

    </div>


    {{-- Subject Information --}}
    <div class="info-grid">

        <div class="info-item">

            <span class="label">
                Subject Name
            </span>

            <span class="value">
                {{ $subject->name }}
            </span>

        </div>


        <div class="info-item">

            <span class="label">
                Subject Code
            </span>

            <span class="value">
                {{ $subject->subject_code }}
            </span>

        </div>


        <div class="info-item">

            <span class="label">
                Class
            </span>

            <span class="value">
                {{ $subject->class ?: 'N/A' }}
            </span>

        </div>


        <div class="info-item">

            <span class="label">
                Created Date
            </span>

            <span class="value">
                {{ $subject->created_at?->format('d M Y') ?? 'N/A' }}
            </span>

        </div>

    </div>


    {{-- Description --}}
    <div class="description-section">

        <span class="label">
            Description
        </span>

        <div class="description-box">

            {{ $subject->description ?: 'No description available.' }}

        </div>

    </div>


    {{-- Bottom Actions --}}
    <div class="bottom-actions">

        <a
            href="{{ route('subjects.edit', $subject) }}"
            class="btn btn-primary"
        >
            ✎ Edit Subject
        </a>

        <a
            href="{{ route('subjects.index') }}"
            class="btn btn-secondary"
        >
            Back to Subjects
        </a>

    </div>

</div>

@endsection

@push('styles')

<style>

    .subject-details-card {
        max-width: 900px;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 25px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .subject-avatar {
        width: 64px;
        height: 64px;
        border-radius: 14px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        flex-shrink: 0;
    }

    .profile-header h2 {
        margin: 0 0 5px;
        font-size: 24px;
        color: #111827;
    }

    .profile-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .info-item {
        background: #f9fafb;
        padding: 16px;
        border-radius: 9px;
        border: 1px solid #f3f4f6;
    }

    .label {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .value {
        display: block;
        color: #111827;
        font-size: 16px;
        font-weight: 600;
    }

    .description-section {
        margin-top: 22px;
    }

    .description-box {
        margin-top: 7px;
        padding: 16px;
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 9px;
        color: #374151;
        line-height: 1.7;
        min-height: 60px;
    }

    .bottom-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .btn-edit {
        background: #f59e0b;
        color: white;
    }

    .btn-edit:hover {
        background: #d97706;
    }

    @media (max-width: 768px) {

        .profile-header {
            align-items: flex-start;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .bottom-actions {
            flex-direction: column;
        }

        .bottom-actions .btn {
            width: 100%;
            text-align: center;
        }

        .header-actions {
            flex-wrap: wrap;
        }

    }

</style>

@endpush
