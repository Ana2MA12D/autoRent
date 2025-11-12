<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\ClientFavoriteCar;
use Illuminate\Http\Request;

class CarFavoriteController extends Controller
{
    public function create()
    {
        return view('favorites.create', [
            'cars' => Car::all(),
            'clients' => Client::all()
        ]);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id'
        ]);

        $favorite = new ClientFavoriteCar($validated);
        $favorite->save();

        return redirect('/favorites')
            ->with('success', 'Автомобиль успешно добавлен в избранное');
    }

    public function edit(string $id)
    {
        return view('favorites.edit', [
            'favorite' => ClientFavoriteCar::all()->where('id', $id)->first(),
            'cars' => Car::all(),
            'clients' => Client::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id'
        ]);

        $favorite = ClientFavoriteCar::all()->where('id', $id)->first();
        $favorite->client_id = $validated['client_id'];
        $favorite->car_id = $validated['car_id'];
        $favorite->save();

        return redirect('/favorites');
    }

    public function destroy(string $id)
    {
        ClientFavoriteCar::destroy($id);
        return redirect('/favorites');
    }

    public function index()
    {
        $favorites = ClientFavoriteCar::with('client', 'car')->get();
        return view('favorites.index',
            ['favorites' => $favorites]);
    }
}
