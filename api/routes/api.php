<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
// use App\Http\Controllers\API\BlogController;

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
    // Route::apiResource('blogs', BlogController::class);
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user');

    // Route::prefix('wo')->group(function () {
    //     Route::post("fire", [FirebaseController::class,'fire']);
    //     Route::post("push", [RecapController::class,'pushValue']);
    //     Route::post("syncHourly", [SyncronizeController::class,'syncHourly']);
    //     Route::post("syncDaily", [SyncronizeController::class,'syncDaily']);
    //     Route::post("syncMonthly", [SyncronizeController::class,'syncMonthly']);
    //     Route::post("syncYearly", [SyncronizeController::class,'syncYearly']);
    // });

});