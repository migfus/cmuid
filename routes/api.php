<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
  return response()->json(['test' => 'test']);
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'Login']);

Route::post('/user-register', [\App\Http\Controllers\UserRegisterController::class, 'store']);
Route::apiResource('/status',  \App\Http\Controllers\RegisterStatusController::class)->only(['show']);
Route::apiResource('/verify',  \App\Http\Controllers\VerifyController::class)->only(['show']);
Route::apiResource('/device',  \App\Http\Controllers\DeviceController::class)->only(['show']);
Route::apiResource('/text-message',  \App\Http\Controllers\TextMessageController::class)->only(['index', 'update']);
Route::apiResource('/device', \App\Http\Controllers\DeviceController::class)->only(['store', 'destroy']);

// SECTION AUTH
Route::middleware('auth:sanctum')->group(function () {
  Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

  Route::apiResource('/request',  \App\Http\Controllers\RequestController::class)
    ->only(['index', 'update']);
  Route::apiResource('/device',  \App\Http\Controllers\DeviceController::class)
    ->only(['index']);
  Route::apiResource('/file',  \App\Http\Controllers\FileController::class)
    ->only(['index', 'store', 'destroy']);
});
