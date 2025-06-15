<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'department' ])->get();

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
            'join_date' => 'required|date',
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
                'salary' => $request->salary,
                'join_date' => $request->join_date,
                'end_date' => $request->end_date
            ]);

            DB::commit();

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
                'end_date' => $request->end_date
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
     $employee = Employee::with(['user', 'department', 'leaves'])->findOrFail($employee->id);
        return view('employees.show', compact('employee'));
    }
}
