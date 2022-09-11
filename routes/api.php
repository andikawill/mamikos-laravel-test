<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;

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

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/profile', [JWTController::class, 'profile']);
});
Route::controller(App\Http\Controllers\API\HomeAPIController::class)->group(function () {
    Route::get('/', 'index');
}); 
Route::controller(App\Http\Controllers\API\KostAPIController::class)->group(function () {
    Route::get('kosts', 'index');
    Route::post('kost', 'store');
    Route::get('kost/{id}', 'show');
    Route::put('kost/{id}', 'update');
    Route::delete('kost/{id}', 'destroy');
}); 

Route::controller(App\Http\Controllers\API\KostDetailAPIController::class)->group(function () {
    Route::get('kost_details', 'index');
    Route::post('kost_detail', 'store');
    Route::get('kost_detail/{id}', 'show');
    Route::put('kost_detail/{id}', 'update');
    Route::delete('kost_detail/{id}', 'destroy');
}); 

Route::controller(App\Http\Controllers\API\KostAvailabilityAPIController::class)->group(function () {
    Route::get('kost_availabilities', 'index');
    Route::post('kost_availability', 'store');
    Route::get('kost_availability/{id}', 'show');
    Route::put('kost_availability/{id}', 'update');
    Route::delete('kost_availability/{id}', 'destroy');
}); 

Route::controller(App\Http\Controllers\API\KostPaymentAPIController::class)->group(function () {
    Route::get('kost_payments', 'index');
    Route::post('kost_paymet', 'store');
    Route::get('kost_paymet/{id}', 'show');
    Route::put('kost_paymet/{id}', 'update');
    Route::delete('kost_paymet/{id}', 'destroy');
}); 