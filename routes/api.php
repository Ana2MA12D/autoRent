<?php
use App\Http\Controllers\CarsControllerApi;
use App\Http\Controllers\ClientControllerApi;
use App\Http\Controllers\PaymentControllerApi;
use App\Http\Controllers\RentalOrderControllerApi;
use Illuminate\Support\Facades\Route;

Route::get('/car', [CarsControllerApi::class, 'index']);
Route::get('/car/{id}', [CarsControllerApi::class, 'show']);
Route::get('/rentalorder', [RentalOrderControllerApi::class, 'index']);
Route::get('/rentalorder/{id}', [RentalOrderControllerApi::class, 'show']);
Route::get('/client', [ClientControllerApi::class, 'index']);
Route::get('/client/{id}', [ClientControllerApi::class, 'show']);
Route::get('/payment', [PaymentControllerApi::class, 'index']);
Route::get('/payment/{id}', [PaymentControllerApi::class, 'show']);
