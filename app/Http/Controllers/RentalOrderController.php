<?php

namespace App\Http\Controllers;

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
}
