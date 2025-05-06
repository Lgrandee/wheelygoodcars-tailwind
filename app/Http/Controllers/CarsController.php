<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::paginate(1); // 10 items per page
        return view('welcome', compact('cars'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validatie voor de afbeelding
        ]);

        // Afbeelding opslaan
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
        }

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
            'image' => $imagePath, // Pad naar de afbeelding opslaan
        ]);

        return redirect()->route('home');
    }

    public function destroy(Car $car)
    {
        // Verwijder de afbeelding als die er is
        if ($car->image) {
            \Storage::delete('public/' . $car->image);
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validatie voor de afbeelding
        ]);

        // Afbeelding verwerken bij update
        if ($request->hasFile('image')) {
            // Verwijder oude afbeelding als die er is
            if ($car->image) {
                \Storage::delete('public/' . $car->image);
            }
            // Sla de nieuwe afbeelding op
            $imagePath = $request->file('image')->store('cars', 'public');
            $car->image = $imagePath;
        }

        $car->update([
            'price' => $request->price,
            'mileage' => $request->mileage,
            // Sla de nieuwe afbeelding op als die geüpload is
        ]);

        return redirect()->route('cars.myOffers')->with('success', 'Auto succesvol bijgewerkt!');
    }


}
