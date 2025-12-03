<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validation (email format, required, etc.)
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Account not found.',
            ])->withInput();
        }

        // Check password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput();
        }

        // Regenerate session and redirect
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
