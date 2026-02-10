<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarsControllerApi;
use App\Http\Controllers\ClientControllerApi;
use App\Http\Controllers\PaymentControllerApi;
use App\Http\Controllers\RentalOrderControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/car', [CarsControllerApi::class, 'index']);
Route::get('/car/{id}', [CarsControllerApi::class, 'show']);
Route::get('/rentalorder', [RentalOrderControllerApi::class, 'index']);
Route::get('/rentalorder/{id}', [RentalOrderControllerApi::class, 'show']);
Route::middleware('auth:sanctum')->get('/client',[ClientControllerApi::class, 'index']);
Route::get('/client/{id}', [ClientControllerApi::class, 'show']);
Route::get('/payment', [PaymentControllerApi::class, 'index']);
Route::get('/payment/{id}', [PaymentControllerApi::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/client' , [ClientControllerApi::class, 'index']);
    Route::get('logout', [AuthController::class, 'logout']);
});
