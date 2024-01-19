<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// SECTION 🔘 PUBLIC
Route::group(['prefix' => 'public', 'as' => 'public.'], function () {
  // NOTE AUTH [Login]
  Route::post('/login', [\App\Http\Controllers\Public\AuthPublicController::class, 'Login']);

  // NOTE REQUEST [request csc id]
  Route::post('/requesting', [\App\Http\Controllers\Public\RequestingPublicController::class, 'store']);
  Route::apiResource('/claim-type', \App\Http\Controllers\Public\ClaimTypePublicController::class);

  // NOTE STATUS [list]
  Route::apiResource('/status',  \App\Http\Controllers\Public\RequestStatusPublicController::class)->only(['show']);
  Route::apiResource('/verify',  \App\Http\Controllers\VerifyPublicController::class)->only(['show']);

  // NOTE DOWNLOAD [download]
  Route::apiResource('/download', \App\Http\Controllers\DownloadPublicController::class)->only(['show']); // download file by file-id
});


// SECTION 📱 DEVICE
Route::group(['prefix' => 'device', 'as' => 'device.'], function () {
  // NOTE DEVICE [TOKEN]
  Route::apiResource('/device',  \App\Http\Controllers\DeviceDeviceController::class)
    ->only(['show', 'update']);

  // NOTE TEXTMESSAGE [List, Update]
  Route::apiResource('/text-message',  \App\Http\Controllers\TextMessageDeviceController::class)->only(['index', 'update']);
});


// SECTION 🔒 AUTH PROTECTED
Route::middleware('auth:sanctum')->group(function () {
  // NOTE AUTH
  Route::get('/logout', [\App\Http\Controllers\AuthPublicController::class, 'logout']);

  // SECTION DASHBOARD
  Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    // NOTE DASHBOARD [STATS, SUMMARY]
    Route::get('/requesting-statistics', [\App\Http\Controllers\Dashboard\StatisticDashboardController::class, 'RequestNumber']);

    // NOTE DEVICE [MANAGEMENT]
    Route::apiResource('/device', \App\Http\Controllers\DevicePublicController::class)
      ->only(['store', 'destroy', 'index']);

    // NOTE FILE [MANAGEMENT]
    Route::apiResource('/file',  \App\Http\Controllers\FilePublicController::class)
      ->only(['index', 'store', 'destroy']);

    // NOTE REQUEST [MANAGEMENT]
    Route::apiResource('/requesting',  \App\Http\Controllers\Dashboard\RequestingDashboardController::class)
      ->only(['index', 'update']);
  });
});
