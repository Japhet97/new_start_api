<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HealthController;

Route::get('/principles', [HealthController::class, 'principles']);
Route::get('/principles/{id}', [HealthController::class, 'show']);
