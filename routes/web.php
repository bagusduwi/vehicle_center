<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('/login'));
});

# auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

# backend
Route::middleware(['auth'])->group(function () {

    # dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    # admin middleware
    Route::middleware(['admin'])->group(function () {
        # vehicle
        Route::resource('/vehicle', VehicleController::class);

        # driver
        Route::resource('/driver', DriverController::class);

        # fuel
        Route::resource('/fuel', FuelController::class);

        # service
        Route::resource('/service', ServiceController::class);

        # booking
        Route::resource('/booking', BookingController::class);
    });

    # approval middleware 
    Route::middleware(['approval'])->group(function () {

        # approval
        Route::resource('/approval', ApprovalController::class);
        Route::get('/approval/{id}/{status}', [ApprovalController::class, 'action']);
    });

    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/history/information/{id}', [HistoryController::class, 'show']);
    Route::get('/history/report', [HistoryController::class, 'report']);
});
