<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientFavoriteController extends Controller
{
    public function show(string $id)
    {
//        $client = Client::with('favoriteCars')->find($id);
//        return view('clients.favorites', [
//            'client' => $client
//        ]);
    }
}
