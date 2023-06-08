<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class ParentController extends Controller
{
    public function index()
    {
        $parent_id = Auth::user()->userable->id;
        $parent = Parents::with('children')->find($parent_id);
        $total_number_of_students = $parent->children()->count();
        $current_session = Session::with(['terms' => function ($q) {
            $q->where('terms.status', 1);
        }])->where('status', 1)->first();

        return Inertia::render('Parent/Dashboard', [
            'total_number_of_students' => $total_number_of_students,
            'current_session' => $current_session,
        ]);
    }



}
