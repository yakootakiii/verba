<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Work;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load this user's works (newest first)
        $works = Work::where('author_id', $user->id)
                    ->orderBy('published_at', 'desc')
                    ->get();

        return view('profile.index', compact('user', 'works'));
    }
}
