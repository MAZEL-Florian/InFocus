<x-guest-layout>
    @livewire('navigation-menu')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-center">
                    <img src="{{ asset('img/Hikari Right.png') }}" alt="Hikari" class="mx-auto mb-4" />
                    
                    <h1 class="text-2xl font-bold mb-4">Bienvenue dans notre formulaire interactif !</h1>
                    
                    <p class="mb-4">
                        Dis-nous ce que tu veux <strong>capturer</strong> et on te trouvera <strong>LE matériel photo parfait</strong>, adapté à ton <strong>budget</strong> et ton <strong>niveau</strong>. Quelques clics et hop, l'aventure photographique commence !
                    </p>
                    
                    <p class="mb-6">
                        Laisse notre <strong>algorithme intelligent</strong> te proposer une sélection de <strong>packs personnalisés</strong>, composés du boitier, des objectifs et des accessoires qui correspondent parfaitement à <strong>tes besoins</strong>.
                    </p>
                    

                        <button class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
                            Démarrer le questionnaire
                        </button>

                </div>
            </div>
        </div>
    </div>
    @livewire('footer-menu')
</x-guest-layout>
