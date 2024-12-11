<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $inter_id)
    {
        $interview = new Interview();
        $interview->cv_review_id = $inter_id;
        $interview->status = $request->status;
        $interview->interview_date = $request->interview_date;
        $interview->save();
        return redirect()->back()->with("done", "تمت تحديد الانترفيو بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }
}
