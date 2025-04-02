<x-app-layout>

<div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-xl font-bold">Auto aanbieden</h2>
    <form action="{{ route('cars.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Kenteken</label>
            <input type="text" name="license_plate" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Merk</label>
            <input type="text" name="brand" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Model</label>
            <input type="text" name="model" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Prijs</label>
            <input type="number" name="price" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Kilometerstand</label>
            <input type="number" name="mileage" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
    </form>
</div>

</x-app-layout>
