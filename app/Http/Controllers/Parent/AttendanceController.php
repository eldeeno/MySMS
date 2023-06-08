<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Parents;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $parent_id = Auth::user()->userable->id;
        $parent = Parents::with('children')->find($parent_id);
        $children = $parent->children;
        $children_ids = $parent->children->pluck('id');
        $children_attendances = Student::with('attendances')->whereIn('id', $children_ids)->get();
        if ($request->child_id) {
            $children_ids = $request->child_id;
            $children_attendances = Student::with(['attendances'])->where('id', $children_ids)->get();
        }
        if ($request->child_id && $request->date) {
            $children_ids = $request->child_id;
            $children_attendances = Student::with(['attendances' => function($query) use ($request) {
                $query->where('date', $request->date);
            }])->where('id', $children_ids)->get();
        }
        return Inertia::render('Parent/Attendance', [
            'children' => $children,
            'children_attendances' => $children_attendances
        ]);
    }
}
