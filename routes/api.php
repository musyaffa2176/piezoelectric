<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

// Pastikan tidak ada typo di '/send-data'
Route::post('/send-data', [SensorController::class, 'store']);