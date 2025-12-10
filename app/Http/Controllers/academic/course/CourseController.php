<?php

namespace App\Http\Controllers\academic\course;

use App\Http\Controllers\Controller;
use App\Models\academic\course\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('backend.academic.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('backend.academic.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
        'course'        => 'required|string|max:191|unique:courses,course',
        'is_active'      => 'required|boolean',
        
    ]);

    Course::create($data);

    return redirect()
        ->route('courses.index')
        ->with('success', 'Course created successfully.');
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
        $course = Course::findOrFail($id);
        return view('backend.academic.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $data = $request->validate([
            'course'        => 'required|string|max:191|unique:courses,course,'.$course->id,
            'is_active'      => 'required|boolean',
        ]);

        $course->update($data);
        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
