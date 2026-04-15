<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ClientControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response(Client::limit($request->perpage ?? 5)
            ->offset(($request->perpage ?? 5) * ($request->page ?? 0))
            ->get());
    }

    public function total()
    {
        return response(Client::all()->count());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create_client')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на добавление клиента',
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|unique:clients|max:255',
            'image' => 'required|file'
        ]);

        $file = $request->file('image');

        $fileName = rand(1, 100000) . '_' . $file->getClientOriginalName();
        try {
            $path = Storage::disk('s3')->putFileAs('client_pictures', $file, $fileName);
            $fileUrl = Storage::disk('s3')->url($path);
        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в хранилище S3',
            ]);
        }

        $client = new Client($validated);
        $client->picture_url = $fileUrl;
        $client->save();

        return response()->json([
            'code' => 0,
            'message' => 'Клиент успешно добавлен',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response(Client::find($id));
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
