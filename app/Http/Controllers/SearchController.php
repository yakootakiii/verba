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

        // FULL-TEXT SEARCH
        if ($request->q) {
            // Convert query to tsquery (AND search + prefix search)
            $tsquery = implode(' & ', explode(' ', $request->q)) . ':*';

            $query->selectRaw("works.*, ts_rank(fts, to_tsquery('english', ?)) AS rank", [$tsquery])
                ->whereRaw("fts @@ to_tsquery('english', ?)", [$tsquery])
                ->orderByDesc('rank');
        } else {
            // Fallback sorting if no search query
            if ($request->sort === 'oldest') {
                $query->orderBy('published_at', 'asc');
            } else {
                $query->orderBy('published_at', 'desc');
            }
        }

        // Category filter (optional)
        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        return view('search', [
            'results' => $query->get(),
        ]);
    }
}
