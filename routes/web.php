<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// 預設導向登入頁面
Route::get('/', function () {
    return redirect()->route('login.form');
});

// 登入/註冊頁面 & 登入邏輯（由 LoginController 處理）
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');


// 需要登入才能使用的功能區域
Route::middleware(['auth', 'verified'])->group(function () {

    // 留言功能
    Route::get('/messages', [MessageController::class, 'indexPage'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // 個人資料頁
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
});
