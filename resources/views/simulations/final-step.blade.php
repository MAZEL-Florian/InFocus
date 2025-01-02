{{-- resources/views/simulations/final-step.blade.php --}}
<x-app-layout>
    <div class="py-10 bg-darkblue text-center text-white">
        <h2 class="text-3xl font-bold">
            Voici notre sélection pour le style 
            {{ optional($simulation->photoType)->name }} !
        </h2>
        
        <div class="mt-8 flex flex-col md:flex-row justify-center gap-8">
            @foreach ($packs as $index => $pack)
                <div class="relative bg-gray-800 rounded-lg p-6 w-full md:w-1/3 flex flex-col">
                    {{-- Le bandeau "Recommandé" sur la carte du milieu (index === 1) --}}
                    @if ($index === 1)
                        <div class="absolute top-0 left-0 bg-yellow-300 text-gray-800 px-3 py-1 rounded-br-lg font-semibold">
                            Recommandé
                        </div>
                    @endif

                    {{-- Titre du pack et prix --}}
                    <h3 class="text-xl font-semibold mt-2">{{ $pack['title'] }}</h3>
                    <div class="text-2xl font-bold mt-4">
                        {{ number_format($pack['price'], 2) }}€/mois
                    </div>

                    {{-- Infos matériel : boîtier + objectif --}}
                    <div class="mt-6 text-left mx-auto">
                        <p class="font-bold">
                            {{ $pack['camera']->name ?? 'Nom du boîtier' }}
                        </p>
                        <p class="text-sm">
                            {{ $pack['lens']->name ?? 'Nom de l’objectif' }}
                        </p>
                    </div>

                    {{-- Quelques "avantages" / "inconvénients" en icônes --}}
                    <ul class="mt-6 text-left space-y-2">
                        <li class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-500" ...>...</svg>
                            <span>Facilité d'utilisation</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-500" ...>...</svg>
                            <span>Permet d'autres styles</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-red-500" ...>...</svg>
                            <span>Profondeur de champ limitée</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-red-500" ...>...</svg>
                            <span>Créer du grain à faible luminosité</span>
                        </li>
                    </ul>

                    {{-- Bouton de découverte --}}
                    <a href="#"
                       class="mt-auto inline-block bg-blue-500 hover:bg-blue-600 text-white rounded py-2 px-4 font-semibold transition-colors duration-200">
                        Découvrir ce pack
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center gap-4">
            <a href="#" class="text-white underline">
                Voir tous nos packs
            </a>
            <a href="#"
               class="bg-white text-blue-900 py-2 px-4 rounded ml-4 font-semibold hover:bg-gray-200 transition-colors duration-200">
               Recommencer le questionnaire
            </a>
        </div>
    </div>
</x-app-layout>
