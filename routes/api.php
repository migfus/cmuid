<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
  return response()->json(['test' => 'test']);
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
  Route::post('/login', 'Login');
});

Route::post('/user-register', [\App\Http\Controllers\UserRegisterController::class, 'store']);
Route::apiResource('/status',  \App\Http\Controllers\RegisterStatusController::class)
        ->only(['show']);
Route::apiResource('/verify',  \App\Http\Controllers\VerifyController::class)
        ->only(['show']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

  Route::apiResource('/request',  \App\Http\Controllers\RequestController::class)
    ->only(['index', 'update']);

});
