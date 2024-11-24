<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('message')->group(function () {
    Route::get('index', [MessageController::class, 'index']);
    Route::get('getById', [MessageController::class, 'getById']);
    Route::get('getByMessageId', [MessageController::class, 'getByMessageId']);
});
