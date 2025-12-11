<?php

namespace App\Http\Controllers\academic\branch;

use App\Http\Controllers\Controller;
use App\Models\academic\branch\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $branches = Branch::all();
        return view('backend.academic.branch.index', compact('branches'));
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
        'branch_name'        => 'required|string|max:191|unique:course_branches,branch_name',
        
        
    ]);

    Branch::create($data);

    return redirect()
        ->route('branches.index')
        ->with('success', 'Branch created successfully.');
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
            $branch = Branch::findOrFail($id);
        return view('backend.academic.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $branch = Branch::findOrFail($id);
        $data = $request->validate([
            'branch_name'        => 'required|string|max:191|unique:course_branches,branch_name,'.$branch->id,
            
        ]);

        $branch->update($data);
        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                  $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
