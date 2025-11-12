<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarFavoriteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFavoriteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RentalOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello']);
});

Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::get('/rental-orders', [RentalOrderController::class, 'index']);
Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{id}', [CarController::class, 'show']);



Route::get('/favorites', [CarFavoriteController::class, 'index'])->name('favorites.index');
Route::get('/favorites/create', [CarFavoriteController::class, 'create'])->name('favorites.create');
Route::post('/favorites', [CarFavoriteController::class, 'store'])->name('favorites.store');
Route::get('/favorites/edit/{id}', [CarFavoriteController::class, 'edit'])->name('favorites.edit');
Route::put('/favorites/update/{id}', [CarFavoriteController::class, 'update'])->name('favorites.update');
Route::get('/favorites/destroy/{id}', [CarFavoriteController::class, 'destroy'])->name('favorites.destroy');


Route::get('/rental_orders', [RentalOrderController::class, 'index'])->name('rental_orders.index');
Route::get('/rental_orders/create', [RentalOrderController::class, 'create'])->name('rental_orders.create')->middleware('auth');
Route::post('/rental_orders', [RentalOrderController::class, 'store'])->name('rental_orders.store');
Route::get('/rental_orders/{id}', [RentalOrderController::class, 'show'])->name('rental_orders.show')->whereNumber('id');
Route::get('/rental_orders/{id}/edit', [RentalOrderController::class, 'edit'])->name('rental_orders.edit')->middleware('auth');
Route::put('/rental_orders/{id}', [RentalOrderController::class, 'update'])->name('rental_orders.update')->middleware('auth');
Route::delete('/rental_orders/{id}', [RentalOrderController::class, 'destroy'])->name('rental_orders.destroy')->middleware('auth');


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/auth', [LoginController::class, 'authenticate']);
Route::get('/auth', function () {
    return redirect('/login');
});

Route::get('/error', function () {
    return view('error', ['message' => session('message')]);
});
