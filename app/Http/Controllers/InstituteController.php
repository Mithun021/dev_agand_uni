<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Institute/index',[
            'institutes' => Institute::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Institute/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'sort_name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'phone' => ['nullable', 'regex:/^[6-9]\d{9}$/'],
            'password' => 'required|string|min:6',
        ]);

        try {
            $user = Institute::create([
                'name'     => $request->name,
                'sort_name'     => $request->sort_name,
                'email'    => $request->email,
                'phone'     => $request->phone,
                'password' => Hash::make($request->password), // hash the password
            ]);

            return to_route('institutes.index')->with('success', 'Institute created successfully!');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Institute/edit',[
            'institute' => Institute::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'     => 'required',
            'sort_name' => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'phone' => ['nullable', 'regex:/^[6-9]\d{9}$/'],
            'password' => 'nullable|string|min:6',
        ]);

        try {
            $institute = Institute::findOrFail($id);

            $institute->name  = $request->name;
            $institute->sort_name  = $request->sort_name;
            $institute->email = $request->email;
            $institute->phone  = $request->phone;

            if ($request->filled('password')) {
                $institute->password = Hash::make($request->password);
            }

            $institute->save();

            return to_route('institutes.index')->with('success', 'Institute updated successfully!');
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
    public function destroy(string $id)
    {
        try {
            $institute = Institute::findOrFail($id);
            if ($institute) {
                Institute::destroy($id);
                return to_route('institutes.index')->with('success', 'Institute Delete successfully!');
            }else{
                return to_route('institutes.index')->with('eroor', 'Institute not found!');
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
