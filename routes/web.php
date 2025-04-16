<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


// 預設導到登入頁
Route::get('/', function () {
    return view('auth.login');
});

// 登入頁面（Jetstream 使用）
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 留言功能 - 需要登入才可操作
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/messages', [MessageController::class, 'indexPage'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // 個人頁面：使用 ProfileController
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// HomeController 相關頁面
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/create', [HomeController::class, 'create']);
Route::post('/home', [HomeController::class, 'store']);
