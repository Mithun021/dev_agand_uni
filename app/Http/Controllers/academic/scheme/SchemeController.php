<?php

namespace App\Http\Controllers\academic\scheme;

use App\Http\Controllers\Controller;
use App\Models\academic\institute\Institute;
use App\Models\academic\scheme\Scheme;
use Illuminate\Http\Request;


class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $schemes = Scheme::all();
        return view('backend.academic.scheme.index', compact('schemes'));
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
        'name'        => 'required|string|max:191|unique:course_schemes,name',
        
        
    ]);

    Scheme::create($data);

    return redirect()
        ->route('schemes.index')
        ->with('success', 'Scheme created successfully.');
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
          $scheme = Scheme::findOrFail($id);
        return view('backend.academic.scheme.edit', compact('scheme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $scheme = Scheme::findOrFail($id);
        $data = $request->validate([
            'name'        => 'required|string|max:191|unique:course_schemes,name,'.$scheme->id,
            
        ]);

        $scheme->update($data);
        return redirect()
            ->route('schemes.index')
            ->with('success', 'Scheme updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $scheme = Scheme::findOrFail($id);
        $scheme->delete();

        return redirect()
            ->route('schemes.index')
            ->with('success', 'Scheme deleted successfully.');
    }
}
