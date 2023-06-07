<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ParentController extends Controller
{
    public function index()
    {
        $parents = Parents::with(['user', 'children'])->get();
        return Inertia::render('Admin/parent/Parent', ['parents' => $parents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where('status', 1)->get();
        return Inertia::render('Admin/parent/CreateParent', ['students' =>  $students]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'emergency_number' => ['required'],
            'address' => ['required'],
        ])->validate();

        $parent = Parents::create([
            'phone_number' => $request->phone_number,
            'emergency_number' => $request->emergency_number,
            'address' => $request->address
        ]);

        $password = Hash::make('password');

        $parent->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        $children_id = [];
        foreach ($request->selected_children as $child) {
            $children_id[] = (int)$child['id'];
        }

        $parent->children()->attach($children_id);
        return redirect()->route('parents.index')->with('success','Parent created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parents $parent)
    {
        $students = Student::with('students')->where('status', 1)->get();
        $parent = $parent->load('user');
        $parent = $parent->load('children');

        return Inertia::render('Admin/parent/EditParent', [ 'parent' => $parent, 'students' => $students ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parents $parent)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'emergency_number' => ['required'],
            'address' => ['required'],
        ])->validate();

        $parent->update([
            'phone_number' => $request->phone_number,
            'emergency_number' => $request->emergency_number,
            'address' => $request->address
        ]);

        $parent->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $parent->children()->detach();

        $children_id = [];
        foreach ($request->selected_children as $child) {
            $children_id[] = (int)$child['id'];
        }

        $parent->children()->attach($children_id);
        return redirect()->route('parents.index')->with('success','Parent updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parents $parent)
    {
        $parent->delete();
        return redirect()->route('parents.index')->with('success','Parent deleted successfully');
    }
}
