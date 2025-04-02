<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-xl font-bold">Aangeboden auto's</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full bg-white shadow-lg rounded-lg mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Kenteken</th>
                    <th class="p-3">Merk</th>
                    <th class="p-3">Model</th>
                    <th class="p-3">Prijs</th>
                    <th class="p-3">Kilometerstand</th>
                    <th class="p-3">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr class="border-t">
                        <form action="{{ route('cars.update', $car->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <td class="p-3">{{ $car->license_plate }}</td>
                            <td class="p-3">{{ $car->brand }}</td>
                            <td class="p-3">{{ $car->model }}</td>
                            <td class="p-3">
                                <input type="number" name="price" value="{{ $car->price }}" class="border p-1 w-20">
                            </td>
                            <td class="p-3">
                                <input type="number" name="mileage" value="{{ $car->mileage }}" class="border p-1 w-20">
                            </td>
                            <td class="p-3 flex gap-2">
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Opslaan</button>
                            </form>

                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Verwijderen</button>
                            </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 </x-app-layout>
