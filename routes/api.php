<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/messages/load', [MessageController::class, 'loadMore']);

Route::resource("messages", MessageController::class)
        ->only(['index', 'show']);


Route::middleware('auth:sanctum')->group(function () {
        Route::resource('messages', MessageController::class)
                ->only(['store', 'update', 'destroy']);
});
Route::get('/api/messages', [MessageController::class, 'index']);

Route::middleware('auth:sanctum')->get('/apitest', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'auth_id' => Auth::id(),
            'session' => session()->all(),
        ]);
    });
    