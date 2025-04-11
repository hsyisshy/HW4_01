<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MessageController;
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');


Route::get('/login', function () {
    return view('auth.login');
})->name('login.ui');

Route::get('/profile', function () {
    $messages = App\Models\Message::where('author', 'Shan-Yu')->get();
    return view('users.profile', compact('messages'));
})->name('profile');


