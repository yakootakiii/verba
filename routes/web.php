<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/feed', function () {
    return view('feed');
})->name('feed');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/reading', function () {
    return view('reading');
})->name('reading');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/profile', [ProfileController::class, 'index'])
        ->middleware('auth')
        ->name('profile');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::get('/feed', [WorkController::class, 'feed'])->name('feed');

Route::get('/reading', function () {
    return view('reading');
})->name('reading.empty');
Route::get('/reading/{slug}', [WorkController::class, 'reading'])->name('reading');
Route::redirect('/reading', '/feed');
