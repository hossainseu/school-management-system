<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $results = Result::with(['student', 'subject'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('exam_name', 'like', "%{$search}%")
                        ->orWhere('grade', 'like', "%{$search}%")
                        ->orWhereHas('student', function ($studentQuery) use ($search) {
                            $studentQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('student_id', 'like', "%{$search}%");
                        })
                        ->orWhereHas('subject', function ($subjectQuery) use ($search) {
                            $subjectQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('subject_code', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('results.index', compact('results'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view('results.create', compact(
            'students',
            'subjects'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_name' => 'required|string|max:255',
            'marks' => 'required|numeric|min:0|max:100',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $validated['grade'] = $this->calculateGrade($validated['marks']);
        $validated['gpa'] = $this->calculateGpa($validated['marks']);

        Result::create($validated);

        return redirect()
            ->route('results.index')
            ->with('success', 'Result added successfully!');
    }

    public function show(Result $result)
    {
        $result->load(['student', 'subject']);

        return view('results.show', compact('result'));
    }

    public function edit(Result $result)
    {
        $students = Student::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view('results.edit', compact(
            'result',
            'students',
            'subjects'
        ));
    }

    public function update(Request $request, Result $result)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_name' => 'required|string|max:255',
            'marks' => 'required|numeric|min:0|max:100',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $validated['grade'] = $this->calculateGrade($validated['marks']);
        $validated['gpa'] = $this->calculateGpa($validated['marks']);

        $result->update($validated);

        return redirect()
            ->route('results.index')
            ->with('success', 'Result updated successfully!');
    }

    public function destroy(Result $result)
    {
        $result->delete();

        return redirect()
            ->route('results.index')
            ->with('success', 'Result deleted successfully!');
    }

    private function calculateGrade(float|int $marks): string
    {
        if ($marks >= 80) {
            return 'A+';
        }

        if ($marks >= 70) {
            return 'A';
        }

        if ($marks >= 60) {
            return 'A-';
        }

        if ($marks >= 50) {
            return 'B';
        }

        if ($marks >= 40) {
            return 'C';
        }

        if ($marks >= 33) {
            return 'D';
        }

        return 'F';
    }

    private function calculateGpa(float|int $marks): float
    {
        if ($marks >= 80) {
            return 5.00;
        }

        if ($marks >= 70) {
            return 4.00;
        }

        if ($marks >= 60) {
            return 3.50;
        }

        if ($marks >= 50) {
            return 3.00;
        }

        if ($marks >= 40) {
            return 2.00;
        }

        if ($marks >= 33) {
            return 1.00;
        }

        return 0.00;
    }
}