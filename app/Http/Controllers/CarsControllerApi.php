<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarsControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response(Car::limit($request->perpage ?? 5)
            ->offset(($request->perpage ?? 5) * ($request->page ?? 0))
            ->get());
    }

    public function total()
    {
        return response(Car::all()->count());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create-car')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на добавление автомобиля',
            ]);
        }

        $validated = $request->validate([
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'gov_number' => 'required|max:255|unique:cars,gov_number',
            'status' => 'required|max:255',
            'price' => 'required|max:255',
            'image' => 'required|file'
        ]);

        $file = $request->file('image');

        $fileName = rand(1, 100000) . '_' . $file->getClientOriginalName();
        try {
            $path = Storage::disk('s3')->putFileAs('car_pictures', $file, $fileName);
            $fileUrl = Storage::disk('s3')->url($path);
        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в хранилище S3',
            ]);
        }

        $car = new Car($validated);
        $car->brand = $validated['brand'];
        $car->model = $validated['model'];
        $car->gov_number = $validated['gov_number'];
        $car->status = $validated['status'];
        $car->price = $validated['price'];
        $car->image = $fileUrl;
        $car->save();

        return response()->json([
            'code' => 0,
            'message' => 'Автомобиль успешно добавлен',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response(Car::find($id));
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
