<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('messages.index');
Route::get('/home/create', [HomeController::class, 'create'])->name('messages.create');
Route::post('/home', [HomeController::class, 'store'])->name('messages.store');

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