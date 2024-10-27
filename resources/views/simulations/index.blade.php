<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="img/hikari-night.png" width="78px" height="111px">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mx-auto text-center w-2/4">
                    <h1 class="text-4xl font-bold mb-10">Bienvenue dans notre formulaire interactif !</h1>
                    <p class="mb-4">
                        Dis-nous ce que tu veux <strong>capturer</strong> et on te trouvera <strong>LE matériel
                            photo
                            parfait</strong>, adapté à ton <strong>budget</strong> et ton <strong>niveau</strong>.
                        Quelques clics et hop, l'aventure photographique commence !
                    </p>
                    <p class="mb-6">
                        Laisse notre <strong>algorithme intelligent</strong> te proposer une sélection de
                        <strong>packs
                            personnalisés</strong>, composés du boitier, des objectifs et des accessoires qui
                        correspondent parfaitement à <strong>tes besoins</strong>.
                    </p>

                    <div class="flex justify-evenly">
                        <a href="{{ route('home.index') }}"
                            class="border-solid border border-infocus-oceanblue text-infocus-oceanblue py-2 px-4 rounded">
                            Revenir à l'accueil
                        </a>
                        <a href="{{ route('simulation.photoType') }}"
                            class="bg-infocus-intenseblue text-white py-2 px-4 rounded">
                            Démarrer le questionnaire
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>