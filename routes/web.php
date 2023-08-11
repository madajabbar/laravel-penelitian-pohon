<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\RelayController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/home',[UserController::class,'index'])->name('home');
    Route::get('/home/log',[UserController::class,'log']);
    Route::post('change', [RelayController::class,'change'])->name('relay.change');
    Route::get('/soil/{id}',[UserController::class,'soil']);
    Route::get('/humitemp/{id}',[UserController::class,'humidityTemperature']);
});
Route::middleware(['auth:sanctum','role:true'])->group(function(){
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::get('dashboard/value', [DashboardController::class,'value'])->name('dashboard.value');
    Route::resource('node', NodeController::class);
    Route::resource('sensor', SensorController::class);
    Route::resource('control',ControlController::class);
    Route::resource('relay', RelayController::class);
    Route::resource('user', AdminUserController::class);
    Route::get('log', [LogController::class,'index'])->name('log.index');
    Route::get('log/datatable',[LogController::class,'table'])->name('log.table');
});
