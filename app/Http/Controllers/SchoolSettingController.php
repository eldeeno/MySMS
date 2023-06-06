<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SchoolSettingController extends Controller
{
    public function index()
    {
        $sessions = Session::with('terms')->get();
        return Inertia::render('Admin/Settings/SchoolSettings', ['sessions' => $sessions]);
    }

    public function createSettings()
    {
        return Inertia::render('Admin/Settings/CreateSession');
    }

    public function storeSettings(Request $request)
    {
        Validator::make($request->all(), [
            'from' => ['session']
        ])->validate();

        if ($request['session']['status'] == 1){
            Session::query()->update([
                'status' => 0
            ]);
        }

        $session = Session::create([
            'from' => $request['session']['from'],
            'to' => $request['session']['to'],
            'status' => $request['session']['status'],
        ]);

        foreach($request['session']['terms'] as $term) {
            Term::create([
                'name' => $term['name'],
                'status' => $term['status'],
                'session_id' => $session->id
            ]);
        }

        return redirect()->route('settings.index')->with('success','Session created successfully');
    }

    public function editSettings(Request $request, Session $session): \Inertia\Response
    {
        $session = $session->load('terms');
        return Inertia::render('Admin/Settings/EditSession', ['session' => $session]);
    }

    public function updateSettings(Request $request, Session $session)
    {
        Validator::make($request->all(), [
            'from' => ['session']
        ])->validate();

        if ($request['session']['status'] == 1){
            Session::query()->update([
                'status' => 0
            ]);
        }

        $session->update([
            'from' => $request['session']['from'],
            'to' => $request['session']['to'],
            'status' => $request['session']['status'],
        ]);

        $session->terms()->delete();
        foreach($request['session']['terms'] as $term) {
            $session->terms()->create([
                'name' => $term['name'],
                'status' => $term['status'],
                'session_id' => $session->id
            ]);
        }

        return redirect()->route('settings.index')->with('success','Session updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSettings(Session $session)
    {
        $session->delete();
        $session->terms()->delete();
        return redirect()->route('settings.index')->with('success','Session deleted successfully');
    }
}
