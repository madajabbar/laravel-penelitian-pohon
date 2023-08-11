<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EdgeController;
use App\Http\Controllers\API\LogController;
use App\Http\Controllers\API\NodeController;
use App\Http\Controllers\API\RelayController;
use App\Http\Controllers\API\SensorController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/user', UserController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/node', [NodeController::class, 'index']);
    Route::get('/sensor', [SensorController::class, 'index']);
    Route::get('/relay', [RelayController::class, 'index']);
    Route::get('/log', [LogController::class, 'index']);
});
Route::post('login', [AuthController::class, 'login']);
Route::post('/soil',[EdgeController::class,'soil']);
Route::post('/control',[EdgeController::class,'humiditytemperature']);
Route::prefix('admin')->middleware(['auth:sanctum', 'role:true'])->group(
    function () {
        Route::resource('/user', UserController::class);
        Route::resource('/node', NodeController::class);
        Route::resource('/sensor', SensorController::class);
        Route::resource('/log', LogController::class);
        Route::resource('/relay', RelayController::class);
    }
);
Route::post('/log', [LogController::class,'store']);
Route::get('/data', [EdgeController::class,'index']);
