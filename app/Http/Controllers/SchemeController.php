<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Batch;
use App\Models\Scheme;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Scheme/index',[
            'schemes' => Scheme::all()
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
            $scheme = Scheme::create([
                'name'     => $request->name
            ]);

            return to_route('schemes.index')->with('success', 'scheme created successfully!');
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
        return Inertia::render('Scheme/edit',[
            'schemes' => Scheme::all(),
            'scheme' => Scheme::findOrFail($id)
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
                Rule::unique('schemes')->ignore($id),
            ],
        ]);

        try {
            $scheme = Scheme::findOrFail($id);

            $scheme->name  = $request->name;

            $scheme->save();

            return to_route('schemes.index')->with('success', 'Scheme update successfully!');
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
        //
    }
}
