<?php

use Illuminate\Support\Facades\Route;

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
