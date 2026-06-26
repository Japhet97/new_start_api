<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HealthController;

Route::get('/principles', [HealthController::class, 'principles']);
Route::get('/principles/{id}', [HealthController::class, 'show']);
Route::post('/save-token', [HealthController::class, 'saveToken']);
Route::post('/send-push', [HealthController::class, 'sendPushNotification']); // For Admin use
