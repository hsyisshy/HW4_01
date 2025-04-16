<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});


// 留言功能 - MessageController
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// 登入頁（Jetstream用）
Route::get('/login', function () {
    return view('auth.login');
})->name('login.ui');

// 使用 HomeController 的 home 頁面（如果之後需要）
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/create', [HomeController::class, 'create']);
Route::post('/home', [HomeController::class, 'store']);

// 個人頁面
Route::get('/profile', function () {
    $messages = App\Models\Message::where('author', 'Shan-Yu')->get();
    return view('users.profile', compact('messages'));
})->name('profile');

// Jetstream 用的 middleware 群組
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
