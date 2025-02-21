<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// Data Master
use App\Http\Controllers\Masters\CompaniesController;
use App\Http\Controllers\Masters\LocationsController;
use App\Http\Controllers\Masters\AreasController;
use App\Http\Controllers\Masters\RoomsController;
use App\Http\Controllers\Masters\RoomCategoriesController;

// End Data Master

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::post('forget', 'forget')->name('forget');
    Route::post('resetPass', 'resetPassword')->name('reset');
    
    Route::get('login', 'authLogin')->name('login');
    Route::get('logout', 'authLogout')->name('logout');
    Route::get('reset', 'getResetToken')->name('reset');
});

Route::middleware('auth:sanctum')->group( function () {
    
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user');

    Route::prefix('wo')->group(function () {
        Route::apiResource('requests', CompaniesController::class);
        Route::apiResource('plannings', CompaniesController::class);
        Route::apiResource('realizations', CompaniesController::class);
        Route::apiResource('projects', CompaniesController::class);
    });

    Route::prefix('masters')->group(function () {
        Route::apiResource('companies', CompaniesController::class);
        Route::apiResource('locations', LocationsController::class);
        Route::apiResource('areas', AreasController::class);
        Route::apiResource('rooms', RoomsController::class);
        Route::apiResource('room-categories', RoomCategoriesController::class);

        Route::apiResource('assets', RoomsController::class);
        Route::apiResource('asset-categories', RoomsController::class);

        Route::apiResource('job-positions', RoomsController::class);
        Route::apiResource('employees', RoomsController::class);
        Route::apiResource('employee-positions', RoomsController::class);

        Route::apiResource('activities', RoomsController::class);
        Route::apiResource('rating-parameters', RoomsController::class);
        
    });
});