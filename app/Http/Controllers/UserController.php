<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\Applicant;
use App\Models\LeaveUsage;
use Illuminate\Support\Str;
use App\Mail\AddNewUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{


    public function profile_info()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();

        // احضر كل الاستخدامات لهذا الموظف
        $usages = LeaveUsage::where('employee_id', $employee->id)->get();

        $leaveUsages = [];

        foreach ($usages as $usage) {
            // أنشئ فترة زمنية لكل سجل من start_date إلى end_date
            $period = CarbonPeriod::create($usage->start_date, $usage->end_date);

            // ضع كل التواريخ داخل Array
            $dates = [];
            foreach ($period as $date) {
                $dates[] = $date->toDateString();
            }

            $leaveUsages[] = [
                'id' => $usage->id,
                'type' => $usage->type,
                'reason' => $usage->reason,
                'start_date' => $usage->start_date,
                'end_date' => $usage->end_date,
                'days' => $dates,
                'days_count' => count($dates),
            ];
        }

        return view("profile.profile_info", compact("user", "employee", "leaveUsages"));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.pages.users.index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password =  Str::random(10);
        $fixedPassword = Hash::make($password);

        $user = new User();
        $user->name = $request->name;
        $user->password = $fixedPassword;
        $user->email =  $request->email;
        $user->type = 'admin';
        $user->save();
        Mail::to($user->email)->send(new AddNewUserMail($user, $password));


        return redirect()->route("user.index")->with("done", "Create User Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route("user.index")->with("done", "Delete User Successfully");
    }
}
