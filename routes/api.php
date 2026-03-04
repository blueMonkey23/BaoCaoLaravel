<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\TaskController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/progress', [ProgressController::class, 'index']);
Route::post('/progress', [ProgressController::class, 'store']);
Route::apiResource('tasks', TaskController::class);
