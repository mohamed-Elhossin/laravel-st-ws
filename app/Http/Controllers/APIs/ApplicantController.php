<?php

namespace App\Http\Controllers\APIs;

use App\Models\User;
use App\Models\Applicant;
use App\Mail\AddNewUserMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applicants = Applicant::with("user")->get();
        $reponse = [
            "status" => 200,
            "data" => $applicants,
            "message" => "All Applicant Data"
        ];
        return response($reponse, 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = rand(0, 8999) . rand(0, 8999) . rand(0, 8999);
        $fixedPassword = Hash::make($password);

        $user = new User();
        $user->name = $request->name;
        $user->password = $fixedPassword;
        $user->email =  $request->email;
        $user->type = "applicant";
        $user->save();

        $request->validate([
            "position" => "required"
        ]);
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

        Mail::to($user->email)->send(new AddNewUserMail($user, $password));

        $reponse = [
            "status" => 200,
            "data" => $applicant,
            "message" => "Create Applicant successfully"
        ];


        return response($reponse, 200);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $applicant = Applicant::where('id', $id)->with("user")->first();

        if ($applicant == null) {
            $reponse = [
                "status" => 404,
                "message" => " No Found Applicant "
            ];
        } else {
            $reponse = [
                "status" => 200,
                "data" => $applicant,
                "message" => "Get Applicant Data"
            ];
        }

        return response($reponse, 200);
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
