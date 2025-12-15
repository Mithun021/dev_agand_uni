<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Session/index',[
            'sessions' => Batch::all()
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
            $session = Batch::create([
                'name'     => $request->name
            ]);

            return to_route('sessions.index')->with('success', 'Session created successfully!');
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
        return Inertia::render('Session/edit',[
            'sessions' => Batch::all(),
            'session' => Batch::findOrFail($id)
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
                Rule::unique('batches')->ignore($id),
            ],
        ]);

        try {
            $session = Batch::findOrFail($id);

            $session->name  = $request->name;

            $session->save();

            return to_route('sessions.index')->with('success', 'Batch Update successfully!');
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
            $session = Batch::findOrFail($id);
            if ($session) {
                Batch::destroy($id);
                return to_route('sessions.index')->with('success', 'Session Delete successfully!');
            }else{
                return to_route('sessions.index')->with('eroor', 'Session not found!');
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
