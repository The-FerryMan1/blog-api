<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/user', function(Request $request){
        return $request->user();
   });

   Route::put('/user', [UserController::class, 'updateUser']);
   Route::put('/user/password', [UserController::class, 'updateUserPassword']);
});


Route::apiResource('post', PostController::class);


Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/logout', [AuthController::class, 'Logout'])->middleware('auth:sanctum');
