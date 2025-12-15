<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Semester/index',[
            'semesters' => Semester::all()
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
            'name' => 'required'
        ]);

        try {
            $permission = Semester::create([
                'name'     => $request->name
            ]);

            return to_route('semesters.index')->with('success', 'Semester created successfully!');
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
        return Inertia::render('Semester/edit',[
            'semesters' => Semester::all(),
            'semester' => Semester::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('semesters')->ignore($id),
            ],
        ]);

        try {
            $semester = Semester::findOrFail($id);

            $semester->name  = $request->name;

            $semester->save();

            return to_route('semesters.index')->with('success', 'Semester updated successfully!');
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
            $semester = Semester::findOrFail($id);
            if ($semester) {
                Semester::destroy($id);
                return to_route('semesters.index')->with('success', 'Semester Delete successfully!');
            }else{
                return to_route('semesters.index')->with('eroor', 'Semester not found!');
            }
        } catch (QueryException $e) {
            // Handle database errors
            return back()->withInput()->with('error', 'Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            // Handle general errors
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
