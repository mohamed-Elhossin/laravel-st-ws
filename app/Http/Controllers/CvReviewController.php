<?php

namespace App\Http\Controllers;

use App\Models\CvReview;
use Illuminate\Http\Request;

class CvReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = CvReview::with('applicant.user')->get();
        return view('admin.pages.cv_reviews.index', compact('reviews'));
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
    public function store(Request $request, $applicant_id)
    {

        $applicant_idIsExists = CvReview::where('applicant_id', '=', $applicant_id)->exists();


        if ($applicant_idIsExists) {
            return redirect()->back()->with("done", "This Applicant Have A Review ");
        }
        $review = new CvReview();
        $review->applicant_id  = $applicant_id;
        $review->status  = $request->status;
        $review->notes  = $request->notes;
        $review->save();

        return redirect()->back()->with("done", "Send CV Review Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = CvReview::where("id", $id)->with('applicant.user')->first();

        return view('admin.pages.cv_reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CvReview $cvReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CvReview $cvReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CvReview $cvReview)
    {
        //
    }
}
