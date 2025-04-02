<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-xl font-bold">Aangeboden auto's</h2>
        <table class="w-full bg-white shadow-lg rounded-lg mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 text-left">Kenteken</th>
                    <th class="p-3 text-left">Merk</th>
                    <th class="p-3 text-left">Model</th>
                    <th class="p-3 text-left">Prijs</th>
                    <th class="p-3 text-left">Kilometerstand</th>
                    <th class="p-3 text-left">Geplaatst door</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr class="border-t">
                        <td class="p-3 text-left">{{ $car->license_plate }}</td>
                        <td class="p-3 text-left">{{ $car->brand }}</td>
                        <td class="p-3 text-left">{{ $car->model }}</td>
                        <td class="p-3 text-left">€{{ number_format($car->price, 2) }}</td>
                        <td class="p-3 text-left">{{ $car->mileage }} km</td>
                        <td class="p-3 text-left">{{ $car->user->name ?? 'Onbekend' }}</td> <!-- Hier wordt de naam van de persoon weergegeven -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

