<?php

namespace App\Http\Controllers\academic\subject;

use App\Http\Controllers\Controller;
use App\Models\academic\annual\Annual;
use App\Models\academic\assignCurriculam\AssignCurriculam;
use App\Models\academic\branch\Branch;
use App\Models\academic\course\Course;
use App\Models\academic\institute\Institute;
use App\Models\academic\scheme\Scheme;
use App\Models\academic\semester\Semester;
use App\Models\academic\session\Session;
use App\Models\academic\subject\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses     = Course::all();
    $branches    = Branch::all();
    $semesters   = Semester::all();
    $annuals     = Annual::all();
    $sessions    = Session::all();
    $schemes     = Scheme::all();
    $institutes  = Institute::all();

    $subjects = Subject::with([
        'course',
        'branch',
        'session',
        'scheme',
        'semester',
        'annual'
    ])->latest()->get();

    return view(
        'backend.academic.subject.index',
        compact(
            'courses',
            'branches',
            'semesters',
            'annuals',
            'sessions',
            'schemes',
            'institutes',
            'subjects'
        )
    );
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
        //dd($request->all());
        //
       $data = $request->validate([
        'course_id'      => 'required|exists:courses,id',
        'branch_id'      => 'nullable|exists:course_branches,id',
        'course_type'    => 'required|in:semester,annual',
        'session_id'     => 'required|exists:course_sessions,id',
        'scheme_id'      => 'required|exists:course_schemes,id',
       

        'semester_id'    => 'required_if:course_type,semester|nullable|exists:course_semesters,id',
        'annual_id'      => 'required_if:course_type,annual|nullable|exists:course_annuals,id',

        'subject_name'   => 'required|string|max:191',
        'subject_type'   => 'required|in:theory,practical',
        'subject_code'   => 'required|string|max:191',
        'credit'         => 'required|numeric',
        'internal_marks' => 'required|numeric',
        'external_marks' => 'required|numeric',
        'total'          => 'required|numeric',
    ]);

    Subject::create([
        'course_id'      => $data['course_id'],
        'branch_id'      => $data['branch_id'] ?? null,
        'course_type'    => $data['course_type'],
        'session_id'     => $data['session_id'],
        'scheme_id'      => $data['scheme_id'],
        'semester_id'    => $data['course_type'] === 'semester' ? $data['semester_id'] : null,
        'annual_id'      => $data['course_type'] === 'annual' ? $data['annual_id'] : null,
        'subject_name'   => $data['subject_name'],
        'subject_type'   => $data['subject_type'],
        'subject_code'   => $data['subject_code'],
        'credit'         => $data['credit'],
        'internal_marks' => $data['internal_marks'],
        'external_marks' => $data['external_marks'],
        'total'          => $data['total'],
    ]);

    return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
        
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
    $subject = Subject::findOrFail($id);

    $courses     = Course::all();
    $branches    = Branch::all();
    $semesters   = Semester::all();
    $annuals     = Annual::all();
    $sessions    = Session::all();
    $schemes     = Scheme::all();
    $institutes  = Institute::all();

    return view(
        'backend.academic.subject.edit',
        compact(
            'subject',
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
    $subject = Subject::findOrFail($id);

    $data = $request->validate([
        'course_id'      => 'required|exists:courses,id',
        'branch_id'      => 'nullable|exists:course_branches,id',
        'course_type'    => 'required|in:semester,annual',
        'session_id'     => 'required|exists:course_sessions,id',
        'scheme_id'      => 'required|exists:course_schemes,id',

        'semester_id'    => 'required_if:course_type,semester|nullable|exists:course_semesters,id',
        'annual_id'      => 'required_if:course_type,annual|nullable|exists:course_annuals,id',

        'subject_name'   => 'required|string|max:191',
        'subject_type'   => 'required|in:theory,practical',
        'subject_code'   => 'required|string|max:191',
        'credit'         => 'required|numeric',
        'internal_marks' => 'required|numeric',
        'external_marks' => 'required|numeric',
        'total'          => 'required|numeric',
    ]);

    $subject->update([
        'course_id'      => $data['course_id'],
        'branch_id'      => $data['branch_id'] ?? null,
        'course_type'    => $data['course_type'],
        'session_id'     => $data['session_id'],
        'scheme_id'      => $data['scheme_id'],
        'semester_id'    => $data['course_type'] === 'semester' ? $data['semester_id'] : null,
        'annual_id'      => $data['course_type'] === 'annual' ? $data['annual_id'] : null,
        'subject_name'   => $data['subject_name'],
        'subject_type'   => $data['subject_type'],
        'subject_code'   => $data['subject_code'],
        'credit'         => $data['credit'],
        'internal_marks' => $data['internal_marks'],
        'external_marks' => $data['external_marks'],
        'total'          => $data['total'],
    ]);

    return redirect()
        ->route('subjects.index')
        ->with('success', 'Subject updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
{
    $subject = Subject::findOrFail($id);
    $subject->delete();

    return redirect()
        ->route('subjects.index')
        ->with('success', 'Subject deleted successfully.');
}

}
