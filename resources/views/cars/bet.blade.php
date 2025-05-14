<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 px-4">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            @if($car->image)
                <img src="{{ asset('storage/' . $car->image) }}" alt="Auto afbeelding" class="w-full h-72 object-cover">
            @endif

            <div class="p-6">
                <!-- Titel -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-3xl font-bold text-gray-900">{{ $car->brand }} {{ $car->model }}</h2>
                    <span class="text-green-600 text-xl font-extrabold">€{{ number_format($car->price, 2) }}</span>
                </div>

                <!-- Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-sm">
                    <p><i class="fas fa-car-side text-blue-500"></i> <strong>Kenteken:</strong> {{ $car->license_plate }}</p>
                    <p><i class="fas fa-calendar-alt text-blue-500"></i> <strong>Bouwjaar:</strong> {{ $car->production_year ?? '—' }}</p>
                    <p><i class="fas fa-tachometer-alt text-blue-500"></i> <strong>Kilometerstand:</strong> {{ $car->mileage }} km</p>
                    <p><i class="fas fa-palette text-blue-500"></i> <strong>Kleur:</strong> {{ $car->color ?? '—' }}</p>
                    <p><i class="fas fa-users text-blue-500"></i> <strong>Zitplaatsen:</strong> {{ $car->seats ?? '—' }}</p>
                    <p><i class="fas fa-door-closed text-blue-500"></i> <strong>Deuren:</strong> {{ $car->doors ?? '—' }}</p>
                    <p><i class="fas fa-eye text-blue-500"></i> <strong>Bekeken:</strong> {{ $car->views }}</p>
                </div>

                <!-- Aanbieder -->
                <div class="mt-6 flex items-center gap-3 text-sm text-gray-600 border-t pt-4">
                    <i class="fas fa-user text-blue-500"></i>
                    Aangeboden door: <span class="font-semibold text-gray-800">{{ $car->user->name ?? 'Onbekende gebruiker' }}</span>
                </div>

                <!-- 10 sec Popup -->
                <div id="popup" style="display:none;" class="mt-6 p-4 bg-yellow-100 border border-yellow-300 rounded-lg">
                    {{ $car->views }} klanten bekeken deze auto vandaag!
                </div>

                <!-- Bod formulier -->
                <div class="mt-10 border-t pt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">💸 Plaats een bod</h3>
                    <form method="POST" action="{{ route('cars.placeBet', $car->id) }}">
                        @csrf
                        <div class="flex items-center gap-3">
                            <input type="number" name="amount" step="0.01" min="1" placeholder="Jouw bod in €" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Bieden</button>
                        </div>
                    </form>
                </div>

                <!-- Reactie van eigenaar (voorbeeld) -->
                @if(session('owner_response'))
                    <div class="mt-4 p-4 bg-green-100 border border-green-300 rounded-md">
                        Reactie van eigenaar: <strong>{{ session('owner_response') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('popup').style.display = 'block';
        }, 10000);
    </script>
</x-app-layout>
