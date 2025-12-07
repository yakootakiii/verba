<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Work::query();

        // Keyword search
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('body', 'like', '%' . $request->q . '%');
            });
        }

        // Category filter
        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Sorting
        if ($request->sort === 'oldest') {
            $query->orderBy('published_at', 'asc');
        } else {
            $query->orderBy('published_at', 'desc');
        }

        return view('search.index', [
            'categories' => Category::all(),
            'results' => $query->get(),
        ]);
    }
}
