<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function index(Request $request)
{
    $search = $request->input('search');
    $class = $request->input('class');
    $section = $request->input('section');

    $students = Student::query()
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('student_id', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('class', 'like', "%{$search}%")
                    ->orWhere('section', 'like', "%{$search}%");
            });
        })
        ->when($class, function ($query, $class) {
            $query->where('class', $class);
        })
        ->when($section, function ($query, $section) {
            $query->where('section', $section);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $classes = Student::query()
        ->whereNotNull('class')
        ->where('class', '!=', '')
        ->select('class')
        ->distinct()
        ->orderBy('class')
        ->pluck('class');

    $sections = Student::query()
        ->whereNotNull('section')
        ->where('section', '!=', '')
        ->select('section')
        ->distinct()
        ->orderBy('section')
        ->pluck('section');

    return view('students.index', compact(
        'students',
        'classes',
        'sections',
        'search',
        'class',
        'section'
    ));
}

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:100|unique:students,student_id',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'class' => 'nullable|string|max:100',
            'section' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
{
    $results = \App\Models\Result::with('subject')
        ->where('student_id', $student->id)
        ->latest()
        ->get();

    $totalSubjects = $results->count();

    $averageMarks = $totalSubjects > 0
        ? round($results->avg('marks'), 2)
        : 0;

    $totalGpa = $totalSubjects > 0
        ? round($results->avg('gpa'), 2)
        : 0;

    $attendanceTotal = \App\Models\Attendance::where('student_id', $student->id)
        ->count();

    $attendancePresent = \App\Models\Attendance::where('student_id', $student->id)
        ->where('status', 'present')
        ->count();
    $attendances = \App\Models\Attendance::where('student_id', $student->id)
    ->latest('date')
    ->get();
    

    $attendancePercentage = $attendanceTotal > 0
        ? round(($attendancePresent / $attendanceTotal) * 100, 2)
        : 0;

    return view('students.show', compact(
        'student',
        'results',
        'totalSubjects',
        'averageMarks',
        'totalGpa',
        'attendanceTotal',
        'attendancePresent',
        'attendancePercentage',
        'attendances'
    ));
}
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:100|unique:students,student_id,' . $student->id,
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'class' => 'nullable|string|max:100',
            'section' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}