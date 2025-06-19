<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\Department;
use App\Models\LeaveUsage;
use Illuminate\Support\Str;
use App\Mail\AddNewUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'department'])->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'birth_date' => 'required|date',
            'join_date' => 'required|date',
            'type' => 'required|in:employee,admin',
            'end_date' => 'nullable|date|after:join_date',
            'department_id' => 'required|exists:departments,id',
        ]);

        try {
            DB::beginTransaction();

            // Generate a random password
            $password = Str::random(12);

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'type' => 'employee'
            ]);

            // Create employee
            Employee::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'position' => $request->position,
                'birth_date' => $request->birth_date,
                'salary' => $request->salary,
                'join_date' => $request->join_date,
                'end_date' => $request->end_date,
                'type' => $request->type,
            ]);

            DB::commit();
            Mail::to($user->email)->send(new AddNewUserMail($user, $password));

            // Return with the generated password
            return redirect()->route('employees.index')
                ->with('success', 'Employee created successfully. The temporary password is: ' . $password);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating employee. Please try again.')
                ->withInput();
        }
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'join_date' => 'required|date',
            'end_date' => 'nullable|date|after:join_date',
             'department_id' => 'required|exists:departments,id',
        ]);

        try {
            DB::beginTransaction();

            // Update employee details
            $employee->update([
                'department_id' => $request->department_id,
                'position' => $request->position,
                'salary' => $request->salary,
                'join_date' => $request->join_date,
                'birth_date' => $request->birth_date,
                'end_date' => $request->end_date,
             ]);

            // Update user name if provided
            if ($request->has('name')) {
                $employee->user->update(['name' => $request->name]);
            }

            DB::commit();
            return redirect()->route('employees.index')
                ->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating employee. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            DB::beginTransaction();
            $employee->user->delete(); // This will cascade delete the employee record
            DB::commit();
            return redirect()->route('employees.index')
                ->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error deleting employee. Please try again.');
        }
    }

    public function show(Employee $employee)
    {
         $usages = LeaveUsage::where('employee_id', $employee->id)->get();

        $leaveUsages = [];

        foreach ($usages as $usage) {
             $period = CarbonPeriod::create($usage->start_date, $usage->end_date);

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
             $leave = Leave::where('employee_id', $employee->id)->firstOrFail();

             $usages = LeaveUsage::where('employee_id', $employee->id)->get();

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

             $remaining = [
                'normal' => $leave->normal_days,
                'urgent' => $leave->urgent_days,
                'sick'   => $leave->sick_days,
            ];

             $totalUsed = array_sum($used);
            $totalRemaining = array_sum($remaining);

             $all = [
                'normal' => $used['normal'] + $remaining['normal'],
                'urgent' => $used['urgent'] + $remaining['urgent'],
                'sick'   => $used['sick'] + $remaining['sick'],
                'total'  => $totalUsed + $totalRemaining,
            ];

             $allDayData = [
                'used' => $used,
                'remaining' => $remaining,
                'total_used' => $totalUsed,
                'total_remaining' => $totalRemaining,
                'all' => $all,
            ];
        }


        $employee = Employee::with(['user', 'department', 'leaves'])->findOrFail($employee->id);
        return view('employees.show', compact('employee', 'leaveUsages', 'leave', 'allDayData'));
    }
}
