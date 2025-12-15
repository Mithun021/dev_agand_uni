<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Branch;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Branch/index',[
            'courses' => Course::select('id', 'name')->get(),
            'branches' => Branch::with('course:id,name')->get(),
        ]);
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
        $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('branches')->where(function ($query) use ($request) {
                    return $query->where('course_id', $request->course_id);
                }),
            ],
        ]);

        try {
            $branch = Branch::create([
                'name'     => $request->name,
                'course_id' => $request->course_id
            ]);

            return to_route('branches.index')->with('success', 'Branch created successfully!');
        } catch (QueryException $e) {
            // Handle database-related errors
            return back()->withInput()->with('error', 'Database error: '.$e->getMessage());
        } catch (Exception $e) {
            // Handle general errors
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
        return Inertia::render('Branch/edit',[
            'courses' => Course::select('id', 'name')->get(),
            'branches' => Branch::with('course:id,name')->get(),
            'branch' => Branch::with('course')->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('branches')->where(function ($query) use ($request) {
                    return $query->where('course_id', $request->course_id);
                })->ignore($id), // 👈 ignore current branch id
            ],
        ]);

        try {
            $branch = Branch::findOrFail($id);

            $branch->name  = $request->name;
            $branch->course_id  = $request->course_id;

            $branch->save();

            return to_route('branches.index')->with('success', 'Branch Update successfully!');
        } catch (QueryException $e) {
            // Handle database errors
            return back()->withInput()->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            // Handle general errors
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            if ($branch) {
                Branch::destroy($id);
                return to_route('branches.index')->with('success', 'Branch Delete successfully!');
            }else{
                return to_route('branches.index')->with('eroor', 'Branch not found!');
            }
        } catch (QueryException $e) {
            // Handle database errors
            return back()->withInput()->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            // Handle general errors
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }





    // Dynamic Data Fetch------------------------------------
    public function getByCourse($course_id)
    {
        $branches = Branch::where('course_id', $course_id)->select('id', 'name')->get();
        return response()->json($branches);
    }



}
