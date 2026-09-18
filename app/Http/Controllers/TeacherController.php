<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $teachers = Teacher::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('teacher_id', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|string|max:100|unique:teachers,teacher_id',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        Teacher::create($validated);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher added successfully!');
    }


public function show(Teacher $teacher)
{
    $students = \App\Models\Student::whereHas('results', function ($query) use ($teacher) {
        $query->whereHas('subject', function ($subjectQuery) use ($teacher) {
            $subjectQuery->where('name', $teacher->subject);
        });
    })
    ->orderBy('name')
    ->get();

    $totalStudents = $students->count();

    return view('teachers.show', compact(
        'teacher',
        'students',
        'totalStudents'
    ));
}



    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|string|max:100|unique:teachers,teacher_id,' . $teacher->id,
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:100',
            'qualification' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        $teacher->update($validated);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}