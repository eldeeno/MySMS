<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ClassesController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Class/Classes', ['classes' => Classes::with('students')->get()]);
    }

    public function create()
    {
        $classes = Classes::all();
        return Inertia::render('Admin/Class/CreateClass', ['classes' => $classes]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'section' => ['required'],
        ])->validate();

        Classes::create([
            'name' => $request->name,
            'section' => $request->section
        ]);

        return redirect()->route('classes.index')->with('success','Class created successfully');
    }

    public function edit(Classes $class)
    {
        return Inertia::render('Admin/Class/EditClass', [ 'class' => $class ]);
    }

    public function update(Request $request, Classes $class)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'section' => ['required'],
        ])->validate();

        $class->update([
            'name' => $request->name,
            'section' => $request->section
        ]);

        return redirect()->route('classes.index')->with('success','Class updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        $classes->delete();
        return redirect()->route('classes.index')->with('success','Class deleted successfully');
    }
}
