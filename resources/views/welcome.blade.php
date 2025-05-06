<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 px-4">
        <h2 class="text-2xl font-extrabold mb-8 text-gray-800">🚗 Aangeboden auto's</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($cars as $car)
                <!-- Auto kaart -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition duration-300 ease-in-out p-5">
                    <!-- Afbeelding -->
                    <div class="h-40 bg-gray-100 flex items-center justify-center rounded-md mb-4 overflow-hidden">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="Auto afbeelding" class="object-cover h-full w-full">
                        @else
                            <span class="text-gray-400 text-sm">Geen afbeelding beschikbaar</span>
                        @endif
                    </div>

                    <!-- Info -->
                    <h3 class="text-blue-700 font-bold text-lg">{{ $car->brand }} {{ $car->model }}</h3>
                    <p class="text-sm text-gray-500 mb-1">{{ $car->license_plate }} • {{ $car->production_year ?? '—' }}</p>
                    <p class="text-green-600 font-extrabold text-lg mb-4">€{{ number_format($car->price, 2) }}</p>

                    <div class="text-sm text-gray-700 grid grid-cols-2 gap-y-2">
                        <p><span class="font-medium">Kilometerstand:</span> {{ $car->mileage }} km</p>
                        <p><span class="font-medium">Zitplaatsen:</span> {{ $car->seats ?? '—' }}</p>
                        <p><span class="font-medium">Deuren:</span> {{ $car->doors ?? '—' }}</p>
                        <p><span class="font-medium">Gewicht:</span> {{ $car->weight ?? '—' }} kg</p>
                        <p><span class="font-medium">Kleur:</span> {{ $car->color ?? '—' }}</p>
                        <p><span class="font-medium">Bekeken:</span> {{ $car->views }}</p>
                        <p><span class="font-medium">Verkocht op:</span> {{ $car->sold_at ? $car->sold_at->format('d-m-Y') : '—' }}</p>
                    </div>

                    <!-- Gebruiker -->
                    <div class="mt-4 pt-3 border-t text-sm text-gray-600 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-6 8a6 6 0 0112 0H4z" />
                        </svg>
                        <span>Aangeboden door: <span class="font-semibold text-gray-800">{{ $car->user->name ?? 'Onbekende gebruiker' }}</span></span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginatie -->
        <p>{{ $cars->links() }}</p>
    </div>
</x-app-layout>
