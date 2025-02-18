<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FirebaseController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('iot')->group(function () {
    Route::get("watch", [FirebaseController::class,'watch']);
});

/* -- Artisan by URL -------------------------------------------------------- */
Route::get('/artisan/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<p>Reoptimized class loader</p>';
});
Route::get('/artisan/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return '<p>Configuration cache cleared!</p>';
});
Route::get('/artisan/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<p>Configuration cache successfully!</p>';
});
Route::get('/artisan/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<p>Route cache successfully!</p>';
});
Route::get('/artisan/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<p>Route cache cleared!</p>';
});
Route::get('/artisan/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<p>View cache cleared!</p>';
});
Route::get('/artisan/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<p>Application cache cleared!</p>';
});
/* ----------------------------------------------------------------------- */