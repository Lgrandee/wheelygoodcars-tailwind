<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold mb-4">Auto aanbieden</h2>

        <form action="{{ route('cars.store') }}" method="POST" id="carForm" enctype="multipart/form-data">
            @csrf

            {{-- Stap 1: Basisgegevens --}}
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

            {{-- Stap 2: Specificaties --}}
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

            {{-- Stap 3: Optioneel & Bevestigen --}}
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

    <script>
        let currentStep = 1;
        function showStep(step) {
            document.querySelectorAll('.step').forEach(s => s.classList.add('hidden'));
            document.getElementById('step-' + step).classList.remove('hidden');
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
        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });
    </script>
</x-app-layout>
