<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $fees = Fee::with('student')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {

                    $q->where('fee_type', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('receipt_number', 'like', "%{$search}%")
                        ->orWhereHas('student', function ($studentQuery) use ($search) {
                            $studentQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('student_id', 'like', "%{$search}%");
                        });

                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();

        return view('fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
            'paid_date' => 'nullable|date',
            'status' => 'required|in:unpaid,partial,paid',
            'payment_method' => 'nullable|string|max:100',
            'receipt_number' => 'nullable|string|max:255|unique:fees,receipt_number',
            'remarks' => 'nullable|string|max:1000',
        ]);

        Fee::create($validated);

        return redirect()
            ->route('fees.index')
            ->with('success', 'Fee added successfully!');
    }

    public function show(Fee $fee)
    {
        $fee->load('student');

        return view('fees.show', compact('fee'));
    }

    public function edit(Fee $fee)
    {
        $students = Student::orderBy('name')->get();

        return view('fees.edit', compact('fee', 'students'));
    }

    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
            'paid_date' => 'nullable|date',
            'status' => 'required|in:unpaid,partial,paid',
            'payment_method' => 'nullable|string|max:100',
            'receipt_number' => 'nullable|string|max:255|unique:fees,receipt_number,' . $fee->id,
            'remarks' => 'nullable|string|max:1000',
        ]);

        $fee->update($validated);

        return redirect()
            ->route('fees.index')
            ->with('success', 'Fee updated successfully!');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()
            ->route('fees.index')
            ->with('success', 'Fee deleted successfully!');
    }
}