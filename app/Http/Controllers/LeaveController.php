<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'urgent_days' => 'required|integer',
            'normal_days' => 'required|integer',
            'employee_id' => 'required|exists:employees,id',
            'sick_days' => 'required|integer',
        ]);

        Leave::create([
            'total' => $request->input('urgent_days') + $request->input('normal_days') + $request->input('sick_days'),
            'urgent_days' => $request->input('urgent_days'),
            'normal_days' => $request->input('normal_days'),
            'employee_id' => $request->input('employee_id'),
            'sick_days' => $request->input('sick_days'),
        ]);

        return redirect()->route("employees.show", $request->input('employee_id'))
            ->with('success', 'Leave created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Leave::destroy($id);
        return redirect()->back()->with('success', 'Leave deleted successfully.');
    }
}
