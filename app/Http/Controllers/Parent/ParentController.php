<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class ParentController extends Controller
{
    public function index()
    {
        return Inertia::render('Parent/Dashboard');
    }
}
