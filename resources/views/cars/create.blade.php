<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold mb-6">Auto aanbieden</h2>


<div class="mb-8">
    <div class="flex items-center justify-between">
        @php
            $steps = ['Basisgegevens', 'Specificaties', 'Bevestigen'];
        @endphp
        @foreach ($steps as $index => $label)
            <div class="flex-1 text-center"> <!-- Toegevoegd text-center voor uitlijning van de tekst -->
                <div class="relative "> <!-- Vergrootte margin-bottom voor ruimte tussen progressbar en stapcirkel -->
                    <div class=" mb-9 w-full h-2 bg-gray-200 rounded-full">
                        <div class="h-2 bg-orange-500 rounded-full transition-all duration-300"
                             id="progress-bar-{{ $index + 1 }}">
                        </div>
                    </div>
                    <div class="absolute inset-0 flex justify-center">
                        <div id="step-circle-{{ $index + 1 }}"
                             class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                             bg-orange-500 text-white">
                            {{ $index + 1 }}
                        </div>
                    </div>
                </div>
                <p class="text-center text-xs text-gray-600 mt-9"> <!-- Meer ruimte boven de tekst -->
                    {{ $label }}
                </p>
            </div>
        @endforeach
    </div>
</div>

        {{-- Formulier --}}
        <form action="{{ route('cars.store') }}" method="POST" id="carForm" enctype="multipart/form-data">
            @csrf

            {{-- Stap 1 --}}
            <div class="step" id="step-1">
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
                <button type="button" onclick="nextStep()" class="bg-blue-500 text-white px-4 py-2 rounded">Volgende</button>
            </div>

            {{-- Stap 2 --}}
            <div class="step hidden" id="step-2">
                <div class="mb-4">
                    <label class="block text-gray-700">Prijs (€)</label>
                    <input type="number" name="price" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Kilometerstand</label>
                    <input type="number" name="mileage" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Zitplaatsen</label>
                    <input type="number" name="seats" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Deuren</label>
                    <input type="number" name="doors" class="w-full p-2 border rounded">
                </div>
                <button type="button" onclick="prevStep()" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Terug</button>
                <button type="button" onclick="nextStep()" class="bg-blue-500 text-white px-4 py-2 rounded">Volgende</button>
            </div>

            {{-- Stap 3 --}}
            <div class="step hidden" id="step-3">
                <div class="mb-4">
                    <label class="block text-gray-700">Bouwjaar</label>
                    <input type="number" name="production_year" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Gewicht (kg)</label>
                    <input type="number" name="weight" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Kleur</label>
                    <input type="text" name="color" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Afbeelding (optioneel)</label>
                    <input type="file" name="image" class="w-full p-2 border rounded">
                </div>
                <button type="button" onclick="prevStep()" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Terug</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Opslaan</button>
            </div>
        </form>
    </div>

{{-- Script --}}
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti"></script>

<script>
    let currentStep = 1;

    function showStep(step) {
        document.querySelectorAll('.step').forEach(s => s.classList.add('hidden'));
        document.getElementById('step-' + step).classList.remove('hidden');
        updateProgressBar();
    }

    function nextStep() {
        if (currentStep < 3) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function updateProgressBar() {
        const totalSteps = 3;

        for (let i = 1; i <= totalSteps; i++) {
            const bar = document.getElementById('progress-bar-' + i);
            const circle = document.getElementById('step-circle-' + i);

            if (i < currentStep) {
                bar.style.width = '100%';
                circle.classList.remove('bg-gray-300', 'text-gray-600');
                circle.classList.add('bg-orange-500', 'text-white');  // Oranje voor voltooide stappen
            } else if (i === currentStep) {
                bar.style.width = '50%';
                circle.classList.remove('bg-gray-300', 'text-gray-600');
                circle.classList.add('bg-orange-400', 'text-white');  // Oranje voor de huidige stap
            } else {
                bar.style.width = '0%';
                circle.classList.remove('bg-orange-500', 'bg-orange-400', 'text-white');
                circle.classList.add('bg-gray-300', 'text-gray-600');  // Grijs voor de niet-gestarte stappen
            }
        }
    }

    function showConfetti() {
        // Confetti-effect wanneer de laatste stap is bereikt
        const duration = 3 * 1000; // 3 seconden
        const end = Date.now() + duration;
        const interval = setInterval(function () {
            canvasConfetti({
                particleCount: 100,
                angle: Math.random() * 360,
                spread: Math.random() * 30 + 20,
                origin: {
                    x: Math.random(),
                    y: Math.random()
                }
            });
            if (Date.now() > end) {
                clearInterval(interval);
            }
        }, 100);
    }

    // Formulier submitten na confetti
    const form = document.getElementById('carForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Voorkom direct verzenden van het formulier

        // Toon confetti
        showConfetti();

        // Verzenden van formulier na 3 seconden
        setTimeout(function () {
            form.submit(); // Verzenden van het formulier na confetti-effect
        }, 3000); // 3 seconden vertraging
    });

    document.addEventListener('DOMContentLoaded', () => {
        showStep(currentStep);
    });
</script>
</x-app-layout>
