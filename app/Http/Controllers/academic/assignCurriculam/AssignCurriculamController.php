<?php

namespace App\Http\Controllers\academic\assignCurriculam;

use App\Http\Controllers\Controller;
use App\Models\academic\annual\Annual;
use App\Models\academic\assignCurriculam\AssignCurriculam;
use App\Models\academic\branch\Branch;
use App\Models\academic\course\Course;
use App\Models\academic\institute\Institute;
use App\Models\academic\scheme\Scheme;
use App\Models\academic\semester\Semester;
use App\Models\academic\session\Session;
use Illuminate\Http\Request;

class AssignCurriculamController extends Controller
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
        $sessions = Session::all();
        $schemes = Scheme::all();
        $institutes = Institute::all();

        $assignCurriculams = AssignCurriculam::with(['course', 'branch'])->get();

        return view(
            'backend.academic.assignCurriculam.index',
            compact(
                'courses',
                'branches',
                'semesters',
                'annuals',
                'sessions',
                'schemes',
                'institutes',
                'assignCurriculams'
            )
        );
    }

    public function getBranches($course_id)
    {
        $branches = Branch::where('course_id', $course_id)->get();

        return response()->json($branches);
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

        // dd($request->all());
        $data = $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'branch_id'        => 'required|exists:course_branches,id',
            'course_type'      => 'required|in:semester,annual',
            'session_id'       => 'required|exists:course_sessions,id',
            'scheme_id'        => 'required|exists:course_schemes,id',
            'institute_id'     => 'required|exists:course_institutes,id',
            'semester_id'      => 'required_if:course_type,course_semester|array',
            'semester_id.*'    => 'exists:course_semesters,id',
            'annual_id'        => 'required_if:course_type,annual|exists:course_annuals,id',
        ]);

        // Prepare data for insertion
        $insertData = [
            'course_id' => $data['course_id'],
            'branch_id' => $data['branch_id'],
            'course_type' => $data['course_type'],
            'session_id' => json_encode($data['session_id']),
            'scheme_id' => json_encode($data['scheme_id']),
            'institute_id' => json_encode($data['institute_id']),
            'semester_id' => $data['course_type'] === 'semester' ? json_encode($request->semester_id) : null,
            'annual_id' => $data['course_type'] === 'annual' ? json_encode($request->annual_id) : null,
        ];

        // Insert into database
        AssignCurriculam::create($insertData);

        return redirect()
            ->route('assign-curriculams.index')
            ->with('success', 'Curriculum created successfully.');

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
    $assignCurriculam = AssignCurriculam::findOrFail($id);

    $courses    = Course::all();
    $branches   = Branch::where('course_id', $assignCurriculam->course_id)->get();
    $semesters  = Semester::all();
    $annuals    = Annual::all();
    $sessions   = Session::all();
    $schemes    = Scheme::all();
    $institutes = Institute::all();

    return view(
        'backend.academic.assignCurriculam.edit',
        compact(
            'assignCurriculam',
            'courses',
            'branches',
            'semesters',
            'annuals',
            'sessions',
            'schemes',
            'institutes'
        )
    );
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $assignCurriculam = AssignCurriculam::findOrFail($id);

    $data = $request->validate([
        'course_id'     => 'required|exists:courses,id',
        'branch_id'     => 'required|exists:course_branches,id',
        'course_type'   => 'required|in:semester,annual',
        'session_id'    => 'required|array',
        'session_id.*'  => 'exists:course_sessions,id',
        'scheme_id'     => 'required|array',
        'scheme_id.*'   => 'exists:course_schemes,id',
        'institute_id'  => 'required|array',
        'institute_id.*'=> 'exists:course_institutes,id',
        'semester_id'   => 'nullable|array',
        'semester_id.*' => 'exists:course_semesters,id',
        'annual_id'     => 'nullable|array',
        'annual_id.*'   => 'exists:course_annuals,id',
    ]);

    $assignCurriculam->update([
        'course_id'    => $data['course_id'],
        'branch_id'    => $data['branch_id'],
        'course_type'  => $data['course_type'],
        'session_id'   => $data['session_id'],
        'scheme_id'    => $data['scheme_id'],
        'institute_id' => $data['institute_id'],
        'semester_id'  => $data['course_type'] === 'semester' ? $data['semester_id'] ?? [] : null,
        'annual_id'    => $data['course_type'] === 'annual' ? $data['annual_id'] ?? [] : null,
    ]);

    return redirect()
        ->route('assign-curriculams.index')
        ->with('success', 'Curriculum updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
{
    $assignCurriculam = AssignCurriculam::findOrFail($id);
    $assignCurriculam->delete();

    return redirect()
        ->route('assign-curriculams.index')
        ->with('success', 'Curriculum deleted successfully.');
}

}
