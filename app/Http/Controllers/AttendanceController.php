<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['students', 'class'])->get();
        return Inertia::render('Admin/Attendance/Attendance', ['attendances' => $attendances]);
    }

    public function create(Request $request)
    {
        $students = Student::where('status', 1)->get();
        if ($request->class) {
            $students = Student::where(['status' => 1, 'class_id' => $request->class])->get();
        }

        $session = Session::with('terms')->where('status', 1)->first();
        $classes = Classes::all();
        return Inertia::render('Admin/Attendance/CreateAttendance',
            ['students' => $students, 'session' => $session, 'classes' => $classes]
        );
    }

    public function store(Request $request)
    {
        // return $request->all();
        Validator::make($request->all(), [
            'date' => ['required'],
            'term_id' => ['required'],
            'class_id' => ['required']
        ])->validate();

        $attendance = Attendance::create($request->all());

        $selected_students_id = [];
        foreach ($request->selected_students as $student_id) {
            $selected_students_id[] = (int)$student_id;
        }

        $attendance->students()->attach($selected_students_id);
        return redirect()->route('attendance.index')->with('success','Attendance created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success','Attendance deleted successfully');
    }
}
