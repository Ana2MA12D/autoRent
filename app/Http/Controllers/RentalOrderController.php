<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\RentalOrder;
use Illuminate\Http\Request;

class RentalOrderController extends Controller
{
    public function index()
    {
        return view('rental_orders.index', [
            'rentalOrders' => RentalOrder::with(['client', 'car'])->get()
        ]);
    }
    public function show(string $id)
    {
        $rentalOrder = RentalOrder::with(['client', 'car', 'payment'])->find($id);
        return view('rental_orders.show', [
            'rentalOrder' => RentalOrder::with(['client', 'car'])->find($id)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'dropoff_date' => 'required|date',
        ]);

        $car = Car::find($validated['car_id']);

        // Расчет количества дней и общей стоимости
        $days = \Carbon\Carbon::parse($validated['pickup_date'])->diffInDays($validated['dropoff_date']);
        $dailyPrice = $car->price ?? $car->daily_price ?? 0; // Используем price или daily_price
        $totalPrice = $days * $dailyPrice;

        // Создаем заказ с рассчитанной стоимостью
        $rentalOrder = new RentalOrder();
        $rentalOrder->client_id = $validated['client_id'];
        $rentalOrder->car_id = $validated['car_id'];
        $rentalOrder->pickup_date = $validated['pickup_date'];
        $rentalOrder->dropoff_date = $validated['dropoff_date'];
        $rentalOrder->total_price = $totalPrice; // Добавляем рассчитанную стоимость
        $rentalOrder->save();

        return redirect('/rental_orders')->with('success', 'Заказ успешно создан!');
    }

    public function create()
    {
        $cars = Car::all();
        $clients = Client::all();
        return view('rental_orders.create', compact('cars', 'clients'));
    }

    public function edit(string $id)
    {
        $rentalOrder = RentalOrder::findOrFail($id);
        $cars = Car::all();
        $clients = Client::all();

        return view('rental_orders.edit', compact('rentalOrder', 'cars', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'dropoff_date' => 'required|date',
        ]);

        $rentalOrder = RentalOrder::find($id);
        $rentalOrder->client_id = $validated['client_id'];
        $rentalOrder->car_id = $validated['car_id'];
        $rentalOrder->pickup_date = $validated['pickup_date'];
        $rentalOrder->dropoff_date = $validated['dropoff_date'];
        $rentalOrder->save();

        return redirect('/rental_orders');
    }

    public function destroy(string $id)
    {
        RentalOrder::destroy($id);
        return redirect('/rental_orders');
    }
}
