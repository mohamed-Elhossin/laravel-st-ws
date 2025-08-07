<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
   public function index()
    {
        // Eager load the company relationship to avoid N+1 issues
        $departments = Department::with('company')->latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }


   public function create()
    {
        // Get all companies to display in the dropdown
        $companies = Company::all();
        return view('departments.create', compact('companies'));
    }

  public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', // Validate company
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        // Get all companies for the dropdown
        $companies = Company::all();
        return view('departments.edit', compact('department', 'companies'));
    }

   public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', // Validate company
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
