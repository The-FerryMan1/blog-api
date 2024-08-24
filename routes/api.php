<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', Logs::class ])->group(function () {
   Route::get('/user', function(Request $request){
        return $request->user()->load(['role', 'logs']);
   });

   Route::put('/user', [UserController::class, 'updateUser']);
   Route::put('/user/password', [UserController::class, 'updateUserPassword']);
});

Route::middleware([Logs::class, AdminOnly::class])->group(function(){
   Route::apiResource('post', PostController::class);
   Route::apiResource('admin',AdminController::class);
});



Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/logout', [AuthController::class, 'Logout'])->middleware('auth:sanctum');
