<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
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


        $leave = [];
        $allDayData = [];
        if ($employee->leaves != null) {
            // 1️⃣ هات بيانات الرخصة للموظف
            $leave = Leave::where('employee_id', $employee->id)->firstOrFail();

            // 2️⃣ هات الاستخدامات بتاعته
            $usages = LeaveUsage::where('employee_id', $employee->id)->get();

            // 3️⃣ اجمع الأيام المستخدمة لكل نوع
            $used = [
                'normal' => 0,
                'urgent' => 0,
                'sick'   => 0,
            ];

            foreach ($usages as $usage) {
                $daysCount = Carbon::parse($usage->start_date)->diffInDays(Carbon::parse($usage->end_date)) + 1;

                if ($usage->type === 'normal') {
                    $used['normal'] += $daysCount;
                } elseif ($usage->type === 'urgent') {
                    $used['urgent'] += $daysCount;
                } elseif ($usage->type === 'sick') {
                    $used['sick'] += $daysCount;
                }
            }

            // 4️⃣ المتبقي هو المسجل حاليًا في الجدول
            $remaining = [
                'normal' => $leave->normal_days,
                'urgent' => $leave->urgent_days,
                'sick'   => $leave->sick_days,
            ];

            // 5️⃣ احسب الإجمالي
            $totalUsed = array_sum($used);
            $totalRemaining = array_sum($remaining);

            // 6️⃣ اجمع الكل في هيكل all
            $all = [
                'normal' => $used['normal'] + $remaining['normal'],
                'urgent' => $used['urgent'] + $remaining['urgent'],
                'sick'   => $used['sick'] + $remaining['sick'],
                'total'  => $totalUsed + $totalRemaining,
            ];

            // 7️⃣ رجع النتيجة
            $allDayData = [
                'used' => $used,
                'remaining' => $remaining,
                'total_used' => $totalUsed,
                'total_remaining' => $totalRemaining,
                'all' => $all,
            ];
        }


        return view("profile.profile_info", compact("user", "employee", "leaveUsages", 'allDayData'));
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
