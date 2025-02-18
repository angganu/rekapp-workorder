<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// Data Master
use App\Http\Controllers\Masters\CompaniesController;
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

    Route::prefix('masters')->group(function () {
        Route::apiResource('companies', CompaniesController::class);
        
    });
});