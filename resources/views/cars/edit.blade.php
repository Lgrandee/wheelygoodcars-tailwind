<x-app-layout>
    @section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
        <h1 class="text-xl font-bold mb-4">Auto Bewerken</h1>

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="license_plate" class="block text-sm font-medium text-gray-700">Kenteken:</label>
                <input type="text" name="license_plate" value="{{ $car->license_plate }}" required class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700">Merk:</label>
                <input type="text" name="brand" value="{{ $car->brand }}" required class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="model" class="block text-sm font-medium text-gray-700">Model:</label>
                <input type="text" name="model" value="{{ $car->model }}" required class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Prijs (€):</label>
                <input type="number" name="price" value="{{ $car->price }}" required class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="mileage" class="block text-sm font-medium text-gray-700">Kilometerstand:</label>
                <input type="number" name="mileage" value="{{ $car->mileage }}" required class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="seats" class="block text-sm font-medium text-gray-700">Zitplaatsen:</label>
                <input type="number" name="seats" value="{{ $car->seats }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="doors" class="block text-sm font-medium text-gray-700">Aantal deuren:</label>
                <input type="number" name="doors" value="{{ $car->doors }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="production_year" class="block text-sm font-medium text-gray-700">Bouwjaar:</label>
                <input type="number" name="production_year" value="{{ $car->production_year }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-sm font-medium text-gray-700">Gewicht (kg):</label>
                <input type="number" name="weight" value="{{ $car->weight }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700">Kleur:</label>
                <input type="text" name="color" value="{{ $car->color }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Afbeelding URL (optioneel):</label>
                <input type="file" name="image" class="border p-2 w-full rounded">
            </div>

            @if ($car->image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Huidige afbeelding:</label>
                    <img src="{{ asset('storage/' . $car->image) }}" alt="Auto afbeelding" class="h-16">
                </div>
            @endif

            <div class="flex justify-between mt-6">
                <a href="{{ route('cars.index') }}" class="text-blue-500 hover:underline">Annuleren</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
            </div>
        </form>
    </div>
    @endsection
</x-app-layout>
