<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RentalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/')->withErrors(['error' => 'У вас нет разрешения на просмотр клиентов.']);
        }
        return view('clients.index', [
            'clients' => Client::all()
        ]);
    }

    public function show(string $id)
    {
        $client = Client::find($id);
        return view('clients.show', [
            'client' => Client::all()->where('id', $id)->first()
        ]);
    }
}
