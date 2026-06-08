<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

// API dari ESP / Hardware
Route::post('/send-data', [SensorController::class, 'store']);

// API untuk realtime website
Route::get('/latest-sensor', [SensorController::class, 'latestSensor']);