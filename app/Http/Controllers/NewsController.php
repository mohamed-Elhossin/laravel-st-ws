<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\NewsCreatedMail;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{


    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $news =   News::create($request->all());

        // Get all employees with user relation
        $employees = Employee::with('user')->get();

        foreach ($employees as $employee) {
            if ($employee->user && $employee->user->email) {
                Mail::to($employee->user->email)->send(new NewsCreatedMail($news));
            }
        }

        return redirect()->route('news.index')
            ->with('success', 'News created successfully.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $news->update($request->all());

        return redirect()->route('news.index')
            ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'News deleted successfully.');
    }
}
