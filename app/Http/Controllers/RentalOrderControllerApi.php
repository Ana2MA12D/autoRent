<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\RentalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RentalOrderControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(RentalOrder::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create-rental-order')) {
            return response()->json([
                'code' => 1,
                'message' => 'Вы не можете создать заказ аренды',
            ]);
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'dropoff_date' => 'required|date|after_or_equal:pickup_date',
        ]);
        $car = Car::find($validated['car_id']);

        $days = \Carbon\Carbon::parse($validated['pickup_date'])->diffInDays($validated['dropoff_date']);
        $dailyPrice = $car->price ?? $car->daily_price ?? 0;
        $totalPrice = $days * $dailyPrice;
        $rentalOrder = new RentalOrder($validated);
        $rentalOrder->client_id = $validated['client_id'];
        $rentalOrder->car_id = $validated['car_id'];
        $rentalOrder->pickup_date = $validated['pickup_date'];
        $rentalOrder->dropoff_date = $validated['dropoff_date'];
        $rentalOrder->total_price = $totalPrice;
        $rentalOrder->save();

        return response()->json([
            'code' => 0,
            'message' => 'Заказ успешно добавлен',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response(RentalOrder::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
