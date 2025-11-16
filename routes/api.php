<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);


Route::middleware(['auth:sanctum', 'CheckUser'])->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::post('profiles',[ProfileController::class,'store']);
    Route::get('profiles/{id}',[ProfileController::class,'show']);
});

// route::get('tasks',[TaskController::class,'index']);
// route::post('tasks',[TaskController::class,'store']);
// route::put('tasks/{id}',[TaskController::class,'update']);
// route::get('tasks/{id}',[TaskController::class,'show']);
// route::delete('tasks/{id}',[TaskController::class,'destroy']);

