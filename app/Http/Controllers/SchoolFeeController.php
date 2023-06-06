<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolFeeController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Admin/SchoolFees/SchoolFees');
    }
}
