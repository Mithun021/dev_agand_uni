<?php

namespace App\Http\Controllers\academic\session;

use App\Http\Controllers\Controller;
use App\Models\academic\session\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::all();
        return view('backend.academic.session.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // return view('backend.academic.session.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
        'session'        => 'required|string|max:191|unique:course_sessions,session',
        'is_active'      => 'required|boolean',
        
    ]);

    Session::create($data);

    return redirect()
        ->route('sessions.index')
        ->with('success', 'Session created successfully.');
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
          $session = Session::findOrFail($id);
        return view('backend.academic.session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $session = Session::findOrFail($id);
        $data = $request->validate([
            'session'        => 'required|string|max:191|unique:course_sessions,session,'.$session->id,
            'is_active'      => 'required|boolean',
        ]);

        $session->update($data);
        return redirect()
            ->route('sessions.index')
            ->with('success', 'Session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $session = Session::findOrFail($id);
        $session->delete();

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Sesssion deleted successfully.');
    }
}
