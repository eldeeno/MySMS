<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Payment;
use App\Models\PaymentPlan;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SchoolFeesController extends Controller
{
    public function index()
    {
        $payments = Payment::where('parent_id', Auth::user()->userable->id)
            ->with(['student', 'term', 'paymentPlan'])->get();
        return Inertia::render('Parent/SchoolFees', ['payments' => $payments]);
    }

    public function makePayment()
    {
        $parent_id = Auth::user()->userable->id;
        $parent = Parents::with('children')->find($parent_id);
        $children = $parent->children;
        $payment_plans = PaymentPlan::all();
        $session = Session::with(['terms'])->where('status', 1)->first();
        return Inertia::render('Parent/MakePayment', [
            'children' => $children,
            'payment_plans' => $payment_plans,
            'session' => $session
        ]);
    }

    public function paymentStore(Request $request)
    {
//         return $request->all();

        Validator::make($request->all(), [
            'child_id' => ['required'],
            'fee_plan_id' => ['required'],
            'term_id' => ['required'],
            'amount' => ['required'],
        ])->validate();

        Payment::create([
            'student_id' => $request->child_id,
            'fee_plan_id' => $request->fee_plan_id,
            'term_id' => $request->term_id,
            'amount' => $request->amount,
            'parent_id' => Auth::user()->userable->id
        ]);
        return redirect()->route('fee.index')->with('success','Payment Successful created successfully');
    }
}
