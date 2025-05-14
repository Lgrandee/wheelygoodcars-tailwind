<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            {{-- Grote afbeelding bovenaan --}}
            @if($car->image)
                <div class="w-full h-[450px] bg-gray-100">
                    <img src="{{ asset('storage/' . $car->image) }}"
                         alt="Afbeelding van {{ $car->brand }} {{ $car->model }}"
                         class="object-contain w-full h-full rounded-t-2xl" />
                </div>
            @endif

            <div class="p-6 space-y-6">
                {{-- Titel en prijs --}}
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $car->brand }} {{ $car->model }}</h1>
                    <span class="text-green-600 text-2xl font-semibold">€{{ number_format($car->price, 2, ',', '.') }}</span>
                </div>

                {{-- Auto details lijst --}}
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-800 text-sm">
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-car-side text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Kenteken</p>
                            <p class="font-medium">{{ $car->license_plate }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-calendar-alt text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Bouwjaar</p>
                            <p class="font-medium">{{ $car->production_year ?? '—' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-tachometer-alt text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Kilometerstand</p>
                            <p class="font-medium">{{ number_format($car->mileage, 0, ',', '.') }} km</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-users text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Zitplaatsen</p>
                            <p class="font-medium">{{ $car->seats ?? '—' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-door-closed text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Deuren</p>
                            <p class="font-medium">{{ $car->doors ?? '—' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-weight text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Gewicht</p>
                            <p class="font-medium">{{ $car->weight ? $car->weight . ' kg' : '—' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-palette text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Kleur</p>
                            <p class="font-medium">{{ $car->color ?? '—' }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 bg-gray-50 px-4 py-3 rounded-lg shadow-sm">
                        <i class="fas fa-eye text-gray-500"></i>
                        <div>
                            <p class="text-xs text-gray-500">Bekeken</p>
                            <p class="font-medium">{{ $car->views }}</p>
                        </div>
                    </li>
                </ul>



                {{-- Pop-up melding na 10 seconden --}}
                <div id="popup" style="display: none;" class="mt-6 p-4 bg-yellow-100 border border-yellow-300 rounded-lg text-yellow-800">
                    {{ $car->views }} klanten hebben deze auto vandaag bekeken!
                </div>

                {{-- Bewerken/verwijderen (alleen voor eigenaar) --}}
                @if(auth()->check() && auth()->id() === $car->user_id)
                    <div class="flex space-x-4 pt-6">
                        <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded-lg">Bewerken</a>

                        <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze auto wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg">Verwijderen</button>
                        </form>
                    </div>
                @endif

                <a href="{{ route('home') }}" class="inline-block mt-6 text-blue-600 hover:underline">← Terug naar overzicht</a>
            </div>
        </div>
    </div>

    {{-- JS popup --}}
    <script>
        setTimeout(() => {
            const popup = document.getElementById('popup');
            if (popup) popup.style.display = 'block';
        }, 10000);
    </script>
</x-app-layout>
