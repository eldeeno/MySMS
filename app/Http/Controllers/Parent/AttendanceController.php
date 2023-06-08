<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index()
    {
        $parent_id = Auth::user()->userable->id;
        $parent = Parents::with('children')->find($parent_id);
        $children_ids = $parent->children->pluck('id');

        $student = Student::with('attendances')->whereIn('id', $children_ids)->get();

//        $attendances = Attendance::with(['students', 'class'])->get();
//        $attendance = $attendances->students();

        return Inertia::render('Parent/Attendance', ['students' => $student]);
    }
}
