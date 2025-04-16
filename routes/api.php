<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::resource("messages", MessageController::class)
        ->only(['index', 'show']);


Route::middleware('auth:sanctum')->group(function () {
        Route::resource('messages', MessageController::class)
                ->only(['store', 'update', 'destroy']);
});

Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::get('apitest', [TestController::class, 'index']);
    });

Route::get('/api/messages', [MessageController::class, 'index']);
