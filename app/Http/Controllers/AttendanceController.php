<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        $students = Student::orderBy('name')->get();

        $attendances = Attendance::where('date', $date)
            ->pluck('status', 'student_id');

        return view('attendances.index', compact(
            'students',
            'attendances',
            'date'
        ));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();

        return view('attendances.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent,late',
            'remarks' => 'nullable|array',
            'remarks.*' => 'nullable|string|max:500',
        ]);

        foreach ($validated['attendance'] as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $validated['date'],
                ],
                [
                    'status' => $status,
                    'remarks' => $validated['remarks'][$studentId] ?? null,
                ]
            );
        }

        return redirect()
            ->route('attendances.index', [
                'date' => $validated['date'],
            ])
            ->with('success', 'Attendance saved successfully!');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

  public function update(Request $request, Attendance $attendance)
{
    $validated = $request->validate([
        'status' => 'required|in:present,absent,late',
        'remarks' => 'nullable|string|max:500',
    ]);

    $attendance->update($validated);

    return redirect()
        ->route('attendances.index', [
            'date' => $attendance->date->toDateString(),
        ])
        ->with('success', 'Attendance updated successfully!');
}
    public function destroy(Attendance $attendance)
    {
        $date = $attendance->date->toDateString();

        $attendance->delete();

        return redirect()
            ->route('attendances.index', [
                'date' => $date,
            ])
            ->with('success', 'Attendance deleted successfully!');
    }
}