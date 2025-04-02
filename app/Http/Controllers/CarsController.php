<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::where('user_id', auth()->id())->get();
        dd($cars); // Hiermee zie je of er auto's uit de database worden opgehaald
        return view('home', compact('cars'));
    }

    public function store(Request $request)
{
    $request->validate([
        'license_plate' => 'required|string|max:10',
        'brand' => 'required|string',
        'model' => 'required|string',
        'price' => 'required|numeric',
        'mileage' => 'required|integer',
        'seats' => 'nullable|integer',
        'doors' => 'nullable|integer',
        'production_year' => 'nullable|integer',
        'weight' => 'nullable|integer',
        'color' => 'nullable|string',
    ]);

    Car::create([
        'user_id' => auth()->id(),
        'license_plate' => $request->license_plate,
        'brand' => $request->brand,
        'model' => $request->model,
        'price' => $request->price,
        'mileage' => $request->mileage,
        'seats' => $request->seats,
        'doors' => $request->doors,
        'production_year' => $request->production_year,
        'weight' => $request->weight,
        'color' => $request->color,
        'views' => 0,
    ]);

    return redirect()->route('home');
}

public function destroy(Car $car)
{
    $car->delete();

    return redirect()->route('home')->with('success', 'De auto is succesvol verwijderd.');
}
public function create()
{
    return view('cars.create');
}

public function myOffers()
{
    $cars = Car::where('user_id', auth()->id())->get();
    return view('cars.myOffers', compact('cars'));
}

public function edit(Car $car)
{
    if ($car->user_id !== auth()->id()) {
        abort(403, 'Je mag deze auto niet bewerken.');
    }

    return view('cars.edit', compact('car'));
}

public function update(Request $request, Car $car)
{
    $request->validate([
        'price' => 'required|numeric|min:0',
        'mileage' => 'required|integer|min:0',
    ]);

    $car->update([
        'price' => $request->price,
        'mileage' => $request->mileage,
    ]);

    return redirect()->route('cars.myOffers')->with('success', 'Auto succesvol bijgewerkt!');
}

}
