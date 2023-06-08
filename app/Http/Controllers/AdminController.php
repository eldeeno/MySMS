<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Parents;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $total_number_of_students = Student::count();
        $total_number_of_parents = Parents::count();
        $total_number_of_classes = Classes::count();
        $current_session = Session::with(['terms' => function ($q) {
            $q->where('terms.status', 1);
        }])->where('status', 1)->first();

        return Inertia::render('Dashboard', [
            'total_number_of_students' => $total_number_of_students,
            'total_number_of_parents' => $total_number_of_parents,
            'total_number_of_classes' => $total_number_of_classes,
            'current_session' => $current_session,
        ]);
    }
}
