<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login.ui');

Route::get('/profile', function () {
    $messages = App\Models\Message::where('author', 'Shan-Yu')->get();
    return view('users.profile', compact('messages'));
})->name('profile');