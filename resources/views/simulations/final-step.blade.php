<x-app-layout>
    <div class="py-10 bg-darkblue text-white">
        <div class="max-w-7xl mx-auto px-4">

            <h2 class="text-3xl md:text-4xl font-extrabold text-center">
                Voici notre sélection pour le style
                {{ optional($simulation->photoType)->name }} !
            </h2>

            <div id="cards-container" class="mt-8 flex flex-col md:flex-row justify-center items-start gap-8">
                @foreach ($packs as $index => $pack)
                <div
                    class="card relative bg-gradient-to-r from-[#111827] to-[#1F2937] 
                    rounded-lg shadow-lg transition-all 
                    w-full md:w-1/3 flex flex-col
                    hover:scale-105 hover:z-10 hover:shadow-[0_4px_15px_0_rgba(246,253,255,0.8)]
                    @if($index === 1) card-recommended shadow-[0_4px_15px_0_rgba(246,253,255,0.8)] scale-105 z-10 @endif">
                    <div class="relative w-full h-56 overflow-hidden rounded-t-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                        <img src="{{ asset('storage/'.$simulation->photoType->image_url) }}" alt="Illustration du pack"
                            class="w-full h-full object-cover" />

                        @if ($index === 1)
                        <div class="absolute top-2 left-2 
                                            bg-infocus-icewhite text-gray-800 
                                            px-5 py-2 rounded-md font-semibold shadow 
                                            text-sm">
                            Recommandé
                        </div>
                        @endif
                        <div class="absolute top-2 right-2">
                            <button class="bg-infocus-icewhite hover:bg-opacity-90 
                                           p-1 rounded-full text-white focus:outline-none h-8 w-8">
                                <i class='bx bx-heart text-infocus-twilightblue'></i>
                            </button>
                        </div>
                        <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 
                        text-white drop-shadow-lg text-center">
                            <h3 class="text-xl font-bold">
                                {{ $pack['title'] }}
                            </h3>
                            <div class="text-2xl md:text-3xl font-extrabold">
                                {{ number_format($pack['price'], 2) }}€/mois
                            </div>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <div class="mt-4 text-left mx-auto w-full max-w-xs">
                            <div class="flex items-center space-x-2 mb-2">
                                <i class='bx bxs-camera text-xl'></i>
                                <div class="leading-tight">
                                    <p class="font-semibold">
                                        {{ $pack['camera']->name ?? 'Nom du boîtier' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 mb-2">
                                <i class='bx bx-aperture text-xl'></i>
                                <div class="leading-tight">
                                    <p class="font-semibold text-sm">
                                        {{ $pack['lens']->name ?? 'Nom de l’objectif' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <ul class="mt-2 text-left mx-auto w-full max-w-xs space-y-2">
                            <li class="flex items-center space-x-2">
                                <span class="p-1 border rounded-full border-white/20 bg-green-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg></span>
                                <span>Facilité d'utilisation</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="p-1 border rounded-full border-white/20 bg-green-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5">
                                        </path>
                                    </svg></span>
                                <span>Permet d'autres styles</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="p-1 border rounded-full border-white/20 bg-red-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 15 15">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M12.854 2.854a.5.5 0 0 0-.708-.708L7.5 6.793L2.854 2.146a.5.5 0 1 0-.708.708L6.793 7.5l-4.647 4.646a.5.5 0 0 0 .708.708L7.5 8.207l4.646 4.647a.5.5 0 0 0 .708-.708L8.207 7.5z"
                                            clip-rule="evenodd" />
                                    </svg></span>
                                <span>Profondeur de champ limitée</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <span class="p-1 border rounded-full border-white/20 bg-red-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 15 15">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M12.854 2.854a.5.5 0 0 0-.708-.708L7.5 6.793L2.854 2.146a.5.5 0 1 0-.708.708L6.793 7.5l-4.647 4.646a.5.5 0 0 0 .708.708L7.5 8.207l4.646 4.647a.5.5 0 0 0 .708-.708L8.207 7.5z"
                                            clip-rule="evenodd" />
                                    </svg></span>
                                <span>Créer du grain à faible luminosité</span>
                            </li>
                        </ul>

                        <a href="#" class="mt-4 infocus-btn-primary 
                                      text-infocus-twilightblue py-2 px-4 
                                      rounded font-medium text-center block 
                                      hover:opacity-90 transition-all">
                            Découvrir ce pack
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-20 flex justify-center gap-4">
                <a href="#" class="bg-infocus-twilightblue text-infocus-icewhite py-2 px-4 rounded ml-4 font-semibold border-infocus-icewhite border
                transition-colors duration-200">
                    Voir tous nos packs
                </a>
                <a href="#" class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium">
                    Recommencer le questionnaire
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.card');
        const recommendedCard = document.querySelector('.card-recommended');

        cards.forEach(card => {
            card.addEventListener('mouseover', () => {
                cards.forEach(c => {
                    c.classList.remove('scale-105', 'z-10', 'shadow-[0_4px_15px_0_rgba(246,253,255,0.8)]');
                });

                card.classList.add('scale-105', 'z-10', 'shadow-[0_4px_15px_0_rgba(246,253,255,0.8)]');
            });

            card.addEventListener('mouseout', () => {
                cards.forEach(c => {
                    c.classList.remove('scale-105', 'z-10', 'shadow-[0_4px_15px_0_rgba(246,253,255,0.8)]');
                });

                if (recommendedCard) {
                    recommendedCard.classList.add('scale-105', 'z-10', 'shadow-[0_4px_15px_0_rgba(246,253,255,0.8)]');
                }
            });
        });
    });
</script>