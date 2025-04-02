<x-app-layout>
    @section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
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
            <label for="price" class="block text-sm font-medium text-gray-700">Prijs:</label>
            <input type="number" name="price" value="{{ $car->price }}" required class="border p-2 w-full rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
    </form>
</div>
@endsection

</x-app-layout>
