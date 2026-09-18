<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $section = $request->input('section');

        $classes = SchoolClass::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('class_code', 'like', "%{$search}%")
                        ->orWhere('section', 'like', "%{$search}%");
                });
            })
            ->when($section, function ($query, $section) {
                $query->where('section', $section);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $sections = SchoolClass::query()
            ->whereNotNull('section')
            ->where('section', '!=', '')
            ->select('section')
            ->distinct()
            ->orderBy('section')
            ->pluck('section');

        return view('classes.index', compact(
            'classes',
            'sections',
            'search',
            'section'
        ));
    }



    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_code' => 'required|string|max:100|unique:school_classes,class_code',
            'section' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        SchoolClass::create($validated);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class added successfully!');
    }

    public function show(SchoolClass $class)
    {
        return view('classes.show', compact('class'));
        
    }

    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_code' => 'required|string|max:100|unique:school_classes,class_code,' . $class->id,
            'section' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $class->update($validated);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class updated successfully!');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class deleted successfully!');
    }
}