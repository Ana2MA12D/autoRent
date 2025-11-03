<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarFavoriteController extends Controller
{
    public function show(string $id)
    {
//        $car = Car::with('favoriteClients')->find($id);
//        return view('cars.favorites', [
//            'car' => $car
//        ]);
    }
}
