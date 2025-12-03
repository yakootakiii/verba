<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    // FEED PAGE
    public function feed()
    {
        $works = Work::with('author')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('feed', compact('works'));
    }

    // READING PAGE
    public function reading($slug)
    {
        $work = Work::where('slug', $slug)
            ->with(['author', 'comments.user'])
            ->firstOrFail();

        return view('reading', compact('work'));
    }
}
