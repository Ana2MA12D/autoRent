<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
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
