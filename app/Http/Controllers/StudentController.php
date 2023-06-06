<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::where('status', 1)->with('class')->get();
        return Inertia::render('Admin/Students/Students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::all();
        return Inertia::render('Admin/Students/CreateStudent', ['classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
        ])->validate();

//        if($request->hasFile('image')){
//            $path = $request->image->store('profile', 'public');
//        }

        $student = Student::create(
            $request->all()
        );

        return redirect()->route('students.index')->with('success','Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classes = Classes::all();
        return Inertia::render('Admin/Students/EditStudent', [ 'student' => $student, 'classes' => $classes ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        Validator::make($request->all(), [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
        ])->validate();

        $student->update($request->all());

        return redirect()->route('students.index')->with('success','Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully');
    }
}
