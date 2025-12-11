<?php

namespace App\Http\Controllers\academic\course;

use App\Http\Controllers\Controller;
use App\Models\academic\annual\Annual;
use App\Models\academic\branch\Branch;
use App\Models\academic\course\Course;
use App\Models\academic\semester\Semester;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        $branches = Branch::all();
        $semesters = Semester::all();
        $annuals = Annual::all();
        return view('backend.academic.course.index', compact('courses', 'branches','semesters', 'annuals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //return view('backend.academic.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
         $data = $request->validate([
        'course'        => 'required|string|max:191',
        'course_type'   => 'required|string|in:Semester,Annual',
        'semester_id'   => 'nullable|required_if:course_type,Semester|exists:course_semesters,id',
        'annual_id'     => 'nullable|required_if:course_type,Annual|exists:course_annuals,id',
        'branch_id'     => 'nullable|exists:course_branches,id',
        'is_active'     => 'required|boolean',
        
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
