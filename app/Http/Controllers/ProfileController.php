<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;       
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;                
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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate fields
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'password' => 'required|string',
        ]);

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        // Update name and bio
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
