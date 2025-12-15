<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Database\QueryException;
use App\Models\Course;
use App\Models\Scheme;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with(['course', 'branch', 'semester', 'scheme'])
        ->orderBy('course_id', 'asc')
        ->orderBy('branch_id', 'asc')
        ->orderBy('scheme_id', 'asc')
        ->orderBy('semester_id', 'asc')
        ->get();

        return Inertia::render('Subject/index',[
            'subjects' => $subjects,
            'courses' => Course::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Subject/create',[
            'courses' => Course::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'course_id' => 'required',
            'branch_id' => 'required',
            'semester_id' => 'required',
            'scheme_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'subject_code' => 'required',
            'credits' => 'required',
            'internal_marks' => 'required',
            'external_marks' => 'required',
            'total' => 'required',
        ]);

        try {
            Subject::create([
                'course_id' => $request->course_id,
                'branch_id' => $request->branch_id,
                'semester_id' => $request->semester_id,
                'scheme_id' => $request->scheme_id,
                'name' => trim($request->name),
                'type' => trim($request->type),
                'subject_code' => trim($request->subject_code),
                'credits' => $request->credits,
                'internal_marks' => $request->internal_marks,
                'external_marks' => $request->external_marks,
                'total' => $request->total,
            ]);

            return to_route('subjects.index')->with('success', 'Subject created successfully!');
        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Database error: '.$e->getMessage());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong: '.$e->getMessage());
        }

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
        $subject = Subject::with(['course', 'branch', 'semester', 'scheme'])->findOrFail($id);
        return Inertia::render('Subject/edit',[
            'courses' => Course::all(),
            'subject' => $subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'course_id' => 'required',
            'branch_id' => 'required',
            'semester_id' => 'required',
            'scheme_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'subject_code' => 'required',
            'credits' => 'required',
            'internal_marks' => 'required',
            'external_marks' => 'required',
            'total' => 'required',
        ]);

        try {
            $subject = Subject::findOrFail($id);

            $subject->course_id = $request->course_id;
            $subject->branch_id = $request->branch_id;
            $subject->semester_id = $request->semester_id;
            $subject->scheme_id = $request->scheme_id;
            $subject->name = $request->name;
            $subject->type = $request->type;
            $subject->subject_code = $request->subject_code;
            $subject->credits = $request->credits;
            $subject->internal_marks = $request->internal_marks;
            $subject->external_marks = $request->external_marks;
            $subject->total = $request->total;

            $subject->save();

            return to_route('subjects.index')->with('success', 'Subject updated successfully!');
        } catch (QueryException $e) {
            return back()->withInput()->with('error', 'Database error: '.$e->getMessage());
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $subject = Subject::findOrFail($id);
            if ($subject) {
                Subject::destroy($id);
                return to_route('subjects.index')->with('success', 'Subject Delete successfully!');
            }else{
                return to_route('subjects.index')->with('eroor', 'Semester not found!');
            }
        } catch (QueryException $e) {
            // Handle database errors
            return back()->withInput()->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            // Handle general errors
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function importSubject(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        try {
            $path = $request->file('file')->getRealPath();

            // Read CSV lines safely
            $rawData = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if (!$rawData || count($rawData) <= 1) {
                return back()->with('error', 'CSV file is empty or invalid.');
            }

            // Convert CSV to array
            $data = array_map('str_getcsv', $rawData);

            // Normalize and extract headers
            $header = array_map(fn($h) => strtolower(trim($h)), array_shift($data));

            $insertCount = 0;

            DB::beginTransaction();

            foreach ($data as $row) {

                if (count(array_filter($row)) === 0) continue;

                $row = array_combine($header, $row);
                if (!$row) continue;

                $course   = Course::where('name', trim($row['course_id'] ?? ''))->first();
                // $branch   = Branch::where('name', trim($row['branch_id'] ?? ''))->first();
                if ($course) {
                    $branch = Branch::where('course_id', $course->id)
                                    ->where('name', trim($row['branch_id'] ?? ''))
                                    ->first();
                } else {
                    $branch = null;
                }
                $semester = Semester::where('name', trim($row['semester_id'] ?? ''))->first();
                $scheme   = Scheme::where('name', trim($row['scheme_id'] ?? ''))->first();


                $exists = Subject::where('name', trim($row['name'] ?? ''))
                    ->where('course_id', $course?->id)
                    ->where('semester_id', $semester?->id)
                    ->exists();

                if ($exists) {
                    continue; // skip duplicate entries
                }

                // Create new subject
                Subject::create([
                    'course_id'      => $course?->id,
                    'branch_id'      => $branch?->id,
                    'semester_id'    => $semester?->id,
                    'scheme_id'      => $scheme?->id,
                    'name'           => trim($row['name'] ?? ''),
                    'type'           => strtolower(trim($row['type'] ?? 'theory')),
                    'subject_code'   => trim($row['subject_code'] ?? ''),
                    'credits'        => trim($row['credits'] ?? ''),
                    'internal_marks' => trim($row['internal_marks'] ?? ''),
                    'external_marks' => trim($row['external_marks'] ?? ''),
                    'total'          => trim($row['total'] ?? ''),
                ]);

                $insertCount++;
            }

            DB::commit();

            return back()->with('success', "Successfully imported {$insertCount} subjects!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }


    public function fetchSubjects(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'course_id' => 'required|integer',
            'branch_id' => 'required|integer',
            'scheme_id' => 'required|integer',
            'semester_id' => 'required|integer',
        ]);

        $subjects = Subject::where('course_id', $request->course_id)
            ->where('branch_id', $request->branch_id)
            ->where('scheme_id', $request->scheme_id)
            ->where('semester_id', $request->semester_id)
            ->select('id', 'name', 'type', 'subject_code')
            ->get();

        return response()->json($subjects);
    }



}
