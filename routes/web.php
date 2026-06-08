<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Sensor;
use App\Models\Device;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FirebaseController;



Route::get('/login', function () {
    if (Session::has('admin')) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    if ($request->username === 'admin' && $request->password === 'admin123') {
        Session::put('admin', true);
        return redirect('/dashboard');
    }
    return back()->with('error', 'Username atau password salah');
});

Route::post('/logout', function () {
    Session::forget('admin');
    return redirect('/login');
})->name('logout');



Route::post('/api/send-data', [SensorController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


Route::group([], function () {
    
    Route::get('/', function () {
        return Session::has('admin') ? redirect('/dashboard') : redirect('/login');
    });

    Route::get('/dashboard', [FirebaseController::class, 'index']);
    Route::get('/api/latest-sensor', function () {
        if (!Session::has('admin')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $database = app('firebase.database');
        $data = $database->getReference('sensor')->getValue();
    
        return response()->json([
            'energi'   => $data['piezo'] ?? 0,
            'tekanan'  => $data['ldr'] ?? 0,
            'tegangan' => $data['tegangan'] ?? 0,
            'arus'     => $data['arus'] ?? 0,
            'battery_percent' => $data['battery_percent'] ?? 0,
            'kondisi'  => $data['kondisi'] ?? '-',
        ]);
    });

    Route::get('/live-data', function () {
        if (!Session::has('admin')) return redirect('/login');
        $sensors = Sensor::all();
        $devices = Device::all();
        return view('live-data', compact('sensors', 'devices'));
    });

    Route::get('/history', function () {
        if (!Session::has('admin')) return redirect('/login');
        return view('history');
    });

    Route::get('/history', function () {
        if (!Session::has('admin')) return redirect('/login');
        return app(SensorController::class)->history(); 
    });

    Route::get('/about', function () {
        if (!Session::has('admin')) return redirect('/login');
        return view('about');
    });

   
    Route::post('/sensor/store', [SensorController::class, 'store']);
    Route::put('/sensor/update/{id}', [SensorController::class, 'update']);
    Route::post('/sensor/toggle/{id}', [SensorController::class, 'toggle']);
    Route::delete('/sensor/delete/{id}', [SensorController::class, 'destroy']);

    Route::post('/device/store', [DeviceController::class, 'store']);
    Route::put('/device/update/{id}', [DeviceController::class, 'update']);
    Route::post('/device/toggle/{id}', [DeviceController::class, 'toggle']);
    Route::delete('/device/delete/{id}', [DeviceController::class, 'destroy']);
});