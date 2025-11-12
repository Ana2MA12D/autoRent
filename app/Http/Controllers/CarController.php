<?php
// app/Http/Controllers/CarController.php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
//        $cars = Car::all();
        $perpage = $request->perpage ?? 2;
        return view('cars.index', [
            'cars' => Car::paginate($perpage)->withQueryString()
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
