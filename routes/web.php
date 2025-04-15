<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login.ui');

Route::get('/profile', function () {
    $messages = App\Models\Message::where('author', 'Shan-Yu')->get();
    return view('users.profile', compact('messages'));
})->name('profile');


Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
