<?php

namespace App\Http\Controllers\academic\institute;

use App\Http\Controllers\Controller;
use App\Models\academic\institute\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $institutes = Institute::all();
        return view('backend.academic.institute.index', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('backend.academic.institute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
        'institute'        => 'required|string|max:191|unique:course_institutes,institute',
        'city'             => 'nullable|string|max:191',
        'state'            => 'nullable|string|max:191',
        'email'            => 'nullable|email|max:191',
        'phone'            => ['nullable', 'regex:/^[6-9]\d{9}$/'],
        'password'         => 'nullable|string|min:6',
        'is_active'        => 'required|boolean',
        
    ]);

    Institute::create($data);

    return redirect()
        ->route('institutes.index')
        ->with('success', 'Institute created successfully.');
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
       
        $institute = Institute::findOrFail($id);
        return view('backend.academic.institute.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
         $institute = Institute::findOrFail($id);
        $data = $request->validate([
            'institute'        => 'required|string|max:191|unique:course_institutes,institute,'.$institute->id,
            'city'             => 'nullable|string|max:191',
            'state'            => 'nullable|string|max:191',
            'email'            => 'nullable|email|max:191',
            'phone'            => 'nullable|string|max:20',
            'password'         => 'nullable|string|min:6',
            'is_active'      => 'required|boolean',
        ]);

        $institute->update($data);
        return redirect()
            ->route('institutes.index')
            ->with('success', 'Institute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $institute = Institute::findOrFail($id);
        $institute->delete();

        return redirect()
            ->route('institutes.index')
            ->with('success', 'Institute deleted successfully.');
    }
}
