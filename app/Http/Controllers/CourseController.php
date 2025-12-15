<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Institute;
use App\Models\Scheme;
use App\Models\Semester;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.courses.index',[
            'courses' => Course::with(['institutes', 'schemes', 'semesters','batches'])
                        ->orderBy('name', 'ASC')
                        ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.courses.create',[
            'institutes' => Institute::all(),
            'semesters' => Semester::all(),
            'schemes' => Scheme::all(),
            'batches' => Batch::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'semester' => 'array|nullable',
            'scheme' => 'array|nullable',
            'institute' => 'array|nullable',
            'batch' => 'array|nullable',
        ]);

        $course = Course::create([
            'name' => $validated['name'],
        ]);

        if (!empty($validated['semester'])) {
            $course->semesters()->sync($validated['semester']);
        }

        if (!empty($validated['scheme'])) {
            $course->schemes()->sync($validated['scheme']);
        }

        if (!empty($validated['institute'])) {
            $course->institutes()->sync($validated['institute']);
        }

        if (!empty($validated['batch'])) {
            $course->batches()->sync($validated['batch']);
        }

        return to_route('courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $course = Course::with(['institutes', 'schemes', 'semesters','batches'])->findOrFail($id);

        return view('Courses/edit', [
            'course' => $course,
            'institutes' => Institute::all(),
            'semesters' => Semester::all(),
            'schemes' => Scheme::all(),
            'batches' => Batch::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $course = Course::findOrFail($id);
        $course->update(['name' => $request->name]);

        // Sync Pivot Relations
        $course->semesters()->sync($request->semester ?? []);
        $course->schemes()->sync($request->scheme ?? []);
        $course->institutes()->sync($request->institute ?? []);
        $course->batches()->sync($request->batch ?? []);

        return to_route('courses.index')->with('success', 'Course update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $course = Course::findOrFail($id);

        // Detach all mapped relations
        $course->semesters()->detach();
        $course->schemes()->detach();
        $course->institutes()->detach();

        // Delete the course
        $course->delete();
        return to_route('courses.index')->with('success', 'Course update successfully!');
    }


    // Dynamic Data fetch------------------------------------------------
    public function getByCourse($id)
    {
        $course = Course::with([
            'semesters:id,name',
            'schemes:id,name',
            'institutes:id,name',
            'batches:id,name'
        ])->findOrFail($id);

        return response()->json([
            'semesters' => $course->semesters,
            'schemes'   => $course->schemes,
            'institutes'   => $course->institutes,
            'batches'   => $course->batches
        ]);
    }
}
