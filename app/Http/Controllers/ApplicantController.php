<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDO;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applicants = Applicant::with("user")->get();

        return view('admin.pages.applicants.index', compact("applicants"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.applicants.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fixedPassword = Hash::make("12345678");

        $user = new User();
        $user->name = $request->name;
        $user->password = $fixedPassword;
        $user->email =  $request->email;
        $user->type = "applicant";
        $user->save();


        $applicant = new Applicant();
        $applicant->position = $request->position;
        $applicant->exp_years = $request->exp_years;
        $applicant->address = $request->address;
        $applicant->phone = $request->phone;
        $applicant->education = $request->education;
        $applicant->linkedIn = $request->linkedIn;
        $applicant->user_id =  $user->id;
        $CV_data = $request->file("cv");
        $cv_name = time() . $CV_data->getClientOriginalName();
        $location = public_path("upload/");
        $CV_data->move($location, $cv_name);
        $applicant->cv = $cv_name;
        $applicant->save();


        return redirect()->route("applicant.index")->with("done", "Create applicant Successfully");
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $applicant = Applicant::where('id', $id)->with("user")->first();

        return view("admin.pages.applicants.show", compact("applicant"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        //
    }

    public function download($id)
    {
        $downloadFile = Applicant::where("id", $id)->firstOrFail();
        $file_name = $downloadFile->cv;
        $file_path = public_path("upload/$file_name");

        return response()->download($file_path);
    }
}
