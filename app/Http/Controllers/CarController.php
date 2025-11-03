<?php
// app/Http/Controllers/CarController.php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', [
            'cars' => Car::all()
        ]);
    }

    public function show($id)
    {
        $car = Car::with('rentalOrders.client')->find($id);
        return view('cars.show', [
            'car' => Car::all()->where('id', $id)->first(),
        ]);
    }
}
