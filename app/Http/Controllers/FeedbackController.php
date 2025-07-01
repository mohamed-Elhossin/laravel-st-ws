<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('employee')->latest()->get();
        return view('feedback.index', compact('feedbacks'));
    }
    public function ontherFeedback()
    {
        $feedbacks = Feedback::with('employee')->latest()->get();
        return view('feedback.ontherFeedback', compact('feedbacks'));
    }
    public function create()
    {
        $employees = Employee::all();
        return view('feedback.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Feedback::create($request->all());

        return redirect()->route('feedback.index')->with('success', 'Feedback created successfully.');
    }

    public function show(Feedback $feedback)
    {
        $feedback->load('employee');
        return view('feedback.show', compact('feedback'));
    }
    public function edit(Feedback $feedback)
    {
        $employees = Employee::all();
        return view('feedback.edit', compact('feedback', 'employees'));
    }
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $feedback->update($request->all());

        return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
    }
}
