<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function() {
    Route::group(['prefix' => '/appointment'], function() {
        Route::post('/create', [\App\Http\Controllers\AppointmentController::class, 'create']);
        Route::get('/doctor', [\App\Http\Controllers\AppointmentController::class, 'indexAllDoctorAppointments']);
        Route::get('/patient', [\App\Http\Controllers\AppointmentController::class, 'indexAllPatientAppointments']);
        Route::put('/claim/{id}', [\App\Http\Controllers\AppointmentController::class, 'updateDoctor']);
    });
});

Route::group(['prefix' => '/user'], function() {
    Route::post('/create', [\App\Http\Controllers\UserController::class, 'register']);
    Route::post('/session', [\App\Http\Controllers\UserController::class, 'login']);
});