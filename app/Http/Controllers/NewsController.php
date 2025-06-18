<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

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

        News::create($request->all());

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
