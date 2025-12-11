<?php

namespace App\Http\Controllers\academic\annual;

use App\Http\Controllers\Controller;
use App\Models\academic\annual\Annual;
use Illuminate\Http\Request;

class AnnualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $annuals = Annual::all();
        return view('backend.academic.annual.index', compact('annuals'));
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
        'year'        => 'required|string|max:191|unique:course_annuals,year',
         ]);

    Annual::create($data);

    return redirect()
        ->route('annuals.index')
        ->with('success', 'Annual year created successfully.');
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
           $annual = Annual::findOrFail($id);
        return view('backend.academic.annual.edit', compact('annual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $annual = Annual::findOrFail($id);
        $data = $request->validate([
            'year'        => 'required|string|max:191|unique:course_annuals,year,'.$annual->id,
            
        ]);

        $annual->update($data);
        return redirect()
            ->route('annuals.index')
            ->with('success', 'Annual year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $annual = Annual::findOrFail($id);
        $annual->delete();

        return redirect()
            ->route('annuals.index')
            ->with('success', 'Annual year deleted successfully.');
    }
}
