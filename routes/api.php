<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
    
// });

Route::resource('messages', MessageController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);