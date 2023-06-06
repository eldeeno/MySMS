<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Attendance/Attendance');
    }

    public function create()
    {
        $students = Student::where('status', 1)->get();
        $session = Session::with('terms')->where('status', 1)->first();
        $classes = Classes::all();
        return Inertia::render('Admin/Attendance/CreateAttendance',
            ['students' => $students, 'session' => $session, 'classes' => $classes]
        );
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
