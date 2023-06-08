<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SchoolFeeController extends Controller
{
    public function index(): \Inertia\Response
    {
        $payments = Payment::with(['student', 'term', 'paymentPlan'])->get();
        $plans = PaymentPlan::all();
        return Inertia::render('Admin/SchoolFees/SchoolFees', ['plans' => $plans, 'payments' => $payments]);
    }

    public function create()
    {
        return Inertia::render('Admin/SchoolFees/CreatePlan');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'amount' => ['required'],
        ])->validate();

        PaymentPlan::create($request->all());
        return redirect()->route('plan.index')->with('success','Plan created successfully');
    }

    public function edit(PaymentPlan $paymentPlan)
    {
        return Inertia::render('Admin/SchoolFees/EditPlan', ['paymentPlan' => $paymentPlan]);
    }

    public function update(Request $request, PaymentPlan $paymentPlan)
    {
//        return $request->all();
        Validator::make($request->all(), [
            'name' => ['required'],
            'amount' => ['required'],
        ])->validate();

        $paymentPlan->update($request->all());
        return redirect()->route('plan.index')->with('success','Plan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentPlan $paymentPlan)
    {
        $paymentPlan->delete();
        return redirect()->route('plan.index')->with('success','Plan deleted successfully');
    }
}
