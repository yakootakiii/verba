<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    // Display all works in the feed
    public function feed()
    {
        $works = Work::with('author')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('feed', compact('works'));
    }

    // Display a single work for reading
    public function reading($slug)
    {
        $work = Work::where('slug', $slug)
            ->with(['author', 'comments.user'])
            ->firstOrFail();

        return view('reading', compact('work'));
    }

    // Show the form to create a new work
    public function create()
    {
        return view('works.create');
    }

    // Store a new work in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Work::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->id(),
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'published_at' => now(), // ← FIXED
        ]);

        return redirect()->route('profile', auth()->user()->id)
                        ->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $work = Work::findOrFail($id);

        if ($work->author_id !== auth()->id()) {
            abort(403);
        }

        return view('works.edit', compact('work'));
    }

    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);

        if ($work->author_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $work->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('profile', auth()->id())->with('success', 'Post updated!');
    }

    public function destroy($id)
    {
        $work = Work::findOrFail($id);

        if ($work->author_id !== auth()->id()) {
            abort(403);
        }

        $work->delete();

        return redirect()->route('profile', auth()->id())->with('success', 'Post deleted.');
    }


}
