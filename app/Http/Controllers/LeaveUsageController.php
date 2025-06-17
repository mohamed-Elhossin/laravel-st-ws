<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\LeaveUsage;
use Illuminate\Http\Request;

class LeaveUsageController extends Controller
{
    public function index()
    {
        $usages = LeaveUsage::with('employee')->get();

        $usages = $usages->map(function ($usage) {
            $period = CarbonPeriod::create($usage->start_date, $usage->end_date);
            $days = [];
            foreach ($period as $date) {
                $days[] = $date->format('Y-m-d');
            }
            $usage->days = $days;
            return $usage;
        });

        return response()->json($usages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();


        return view('leave-usages.create', compact('employee'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:regular,casual',
            'employee_id' => 'required|exists:employees,id',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $daysCount = $startDate->diffInDays($endDate) + 1;

        $leave = Leave::where('employee_id', $request->employee_id)->firstOrFail();

        if ($request->type === 'regular') {
            if ($daysCount > $leave->normal_days) {
                return redirect()->back()->with('message', 'Not enough normal leave days.');
            }
        } elseif ($request->type === 'casual') {
            if ($daysCount > $leave->urgent_days) {
                return redirect()->back()->with('message', 'Not enough urgent leave days.');
            }
        }

        // لو عدّى التحقق: انشئ السجل و اخصم
        $usage = LeaveUsage::create($request->all());

        if ($usage->type === 'regular') {
            $leave->normal_days -= $daysCount;
        } elseif ($usage->type === 'casual') {
            $leave->urgent_days -= $daysCount;
        }

        $leave->total -= $daysCount;
        $leave->save();

        return  redirect()->route('employees.show', $request->employee_id)
            ->with('success', "Leave usage created successfully.
            Total days deducted: $daysCount from {$usage->start_date} to {$usage->end_date}.
            ");
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usage = LeaveUsage::findOrFail($id);
        $period = CarbonPeriod::create($usage->start_date, $usage->end_date);

        $days = [];
        foreach ($period as $date) {
            $days[] = $date->format('Y-m-d');
        }

        $usage->days = $days;

        return response()->json($usage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveUsage $leaveUsage)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $usage = LeaveUsage::findOrFail($id);

        $request->validate([
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'type'        => 'required|in:regular,casual',
        ]);

        $leave = Leave::where('employee_id', $usage->employee_id)->firstOrFail();

        // 1️⃣ رجع الأيام القديمة
        $oldDays = Carbon::parse($usage->start_date)->diffInDays(Carbon::parse($usage->end_date)) + 1;

        if ($usage->type === 'regular') {
            $leave->normal_days += $oldDays;
        } elseif ($usage->type === 'casual') {
            $leave->urgent_days += $oldDays;
        }
        $leave->total += $oldDays;

        // 2️⃣ حدث السجل
        $usage->update($request->all());

        // 3️⃣ خصم الأيام الجديدة
        $newDays = Carbon::parse($usage->start_date)->diffInDays(Carbon::parse($usage->end_date)) + 1;

        if ($usage->type === 'regular') {
            $leave->normal_days -= $newDays;
        } elseif ($usage->type === 'casual') {
            $leave->urgent_days -= $newDays;
        }
        $leave->total -= $newDays;

        $leave->save();

        return response()->json($usage);
    }


    // حذف سجل + إعادة الأيام للرخصة
    public function destroy($id)
    {
        $usage = LeaveUsage::findOrFail($id);
        $leave = Leave::where('employee_id', $usage->employee_id)->firstOrFail();

        $daysCount = Carbon::parse($usage->start_date)->diffInDays(Carbon::parse($usage->end_date)) + 1;

        if ($usage->type === 'regular') {
            $leave->normal_days += $daysCount;
        } elseif ($usage->type === 'casual') {
            $leave->urgent_days += $daysCount;
        }

        $leave->total += $daysCount;
        $leave->save();

        $usage->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
