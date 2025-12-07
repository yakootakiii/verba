<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\WriterApplicationController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// STARTING PAGE → FEED
Route::get('/', [WorkController::class, 'feed'])->name('feed');

Route::get('/home', function () {
    return view('home');
})->name('home');


// AUTH PAGES
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('feed');
})->name('logout');


/*
|--------------------------------------------------------------------------
| WORKS
|--------------------------------------------------------------------------
*/

// reading page for a specific work
Route::get('/reading/{slug}', [WorkController::class, 'reading'])->name('reading');

// create work
Route::get('/works/create', [WorkController::class, 'create'])->name('works.create');
Route::post('/works', [WorkController::class, 'store'])->name('works.store');

// edit/update/delete
Route::get('/works/{id}/edit', [WorkController::class, 'edit'])->name('works.edit');
Route::put('/works/{id}', [WorkController::class, 'update'])->name('works.update');
Route::delete('/works/{id}', [WorkController::class, 'destroy'])->name('works.destroy');


/*
|--------------------------------------------------------------------------
| PROFILE (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'index'])->name('search.results');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('/admin/writer-applications', [WriterApplicationController::class, 'index'])->name('admin.writer.applications');

        Route::post('/admin/writer-applications/{id}/approve', [WriterApplicationController::class, 'approve'])->name('admin.writer.approve');

        Route::post('/admin/writer-applications/{id}/reject', [WriterApplicationController::class, 'reject'])->name('admin.writer.reject');
    });

});


Route::post('/writer/apply', [WriterApplicationController::class, 'store'])->name('writer.apply')->middleware('auth');
