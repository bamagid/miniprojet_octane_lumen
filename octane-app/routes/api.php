<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('posts', PostController::class)->only(['index', 'show']);
Route::get('/logout',[AuthController::class,'logout'])->middleware('auth');
Route::middleware(['auth','refresh_token'])->group(function () {
    Route::get('/user',[AuthController::class,'me']);
    Route::apiResource('posts', PostController::class)->only(['store','update', 'destroy']);
    Route::put('/user/{user}',[AuthController::class,'update']);
});