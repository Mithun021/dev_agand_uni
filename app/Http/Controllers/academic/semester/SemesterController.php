<?php

namespace App\Http\Controllers\academic\semester;

use App\Http\Controllers\Controller;
use App\Models\academic\semester\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();
        return view('backend.academic.semester.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'semester'        => 'required|string|max:191|unique:course_semesters,semester',
        
        
    ]);

    Semester::create($data);

    return redirect()
        ->route('semesters.index')
        ->with('success', 'Semester created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $semester = Semester::findOrFail($id);
        return view('backend.academic.semester.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $semester = Semester::findOrFail($id);
        $data = $request->validate([
            'semester'        => 'required|string|max:191|unique:course_semesters,semester,'.$semester->id,
            
        ]);

        $semester->update($data);
        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester deleted successfully.');
    }
}
