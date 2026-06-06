<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::prefix('todos')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::post('/', [TodoController::class, 'store']);
    Route::get('/{todo}', [TodoController::class, 'show']);
    Route::match(['put', 'patch'], '/{todo}', [TodoController::class, 'update']);
    Route::patch('/{todo}/status', [TodoController::class, 'updateStatus']);
    Route::delete('/{todo}', [TodoController::class, 'destroy']);
});
