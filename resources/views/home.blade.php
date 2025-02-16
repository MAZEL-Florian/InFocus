<x-guest-layout>
    <section class=" bg-gradient-to-b from-infocus-twilightblue via-infocus-intenseblue to-infocus-twilightblue">

    <section class="relative min-h-screen flex items-center justify-center">
        <video class="absolute w-full h-full object-cover object-center z-0" style="opacity: 0.5;" autoplay muted loop
            playsinline>
            <source src="https://s3-figma-videos-production-sig.figma.com/video/TEAM/1151811939967604798/f5cf4825b9e9f44e3d20e493f956d4b625e99bd3?Expires=1740355200&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=qldpba1ugbH5UPDW6iOBmOnY~Wga-S7vQtjKHSLmOvBRrPu2skpUlXhUFwuPPjNekpTwkOphnLyN60z4L79mscsz1clf8dOUhLy8pEn3dbcXXZrFkrAyofFh-OUAc4L~zVYB2wmjgXul62~FIyLOT5vJU2FXgZVpyH2QKCjaXsU1uVill7ohqGvcZrzzfe15kA1YQPGn1hFZDwEF0tI72yUmDRVOGHgP8pWoSDv6tb8bAi1pAk-cc1nmetu6uM3YpOvNgcY6AYZh3S4r6cqaj3DgyCOUrwrOzckhwwRwoz~yjq5oxstorkuoZ-JJED~Xu~I33A9R7XvDtDOWq1YZDQ__" type="video/mp4" />
            Votre navigateur ne supporte pas l'élément vidéo.
        </video>

        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative z-10 px-4 text-center max-w-xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-semibold text-infocus-icewhite mb-6">
                Louer ton matériel n’a jamais été aussi simple
            </h1>
            <p class="text-infocus-icewhite text-lg md:text-xl mb-8">
                Découvre une nouvelle manière de louer : notre formulaire intelligent crée
                des recommandations sur-mesure pour t’offrir le pack photo adapté à tes
                besoins et tes ambitions.
            </p>
            <a href="{{ route('simulation.index') }}"
                class="infocus-btn-primary text-infocus-twilightblue py-3 px-6 rounded font-medium inline-block">
                Trouver mon matériel idéal
            </a>
        </div>
    </section>

    {{-- DÉCOUVRE NOS STYLES PHOTOGRAPHIQUES --}}
    @if ($photoTypes->isNotEmpty())
    <section class="py-16">
        <div class="container mx-auto text-center text-infocus-icewhite">
            <h2 class="text-4xl font-semibold mb-10">
                Découvre nos styles photographiques
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($photoTypes as $photoType)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $photoType->image_url) }}" alt="{{ $photoType->name }}"
                        class="w-full h-64 object-cover rounded-lg transition duration-300 ease-in-out transform group-hover:scale-105 group-hover:brightness-75" />
                    <div class="absolute inset-0 flex items-end p-4">
                        <div class="text-left">
                            <h3 class="text-xl md:text-2xl font-semibold text-infocus-icewhite">
                                {{ $photoType->name }}
                            </h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- LE FONCTIONNEMENT --}}
    <section class="text-infocus-icewhite py-16">
        <div class="container mx-auto">
            <h2 class="text-4xl mb-10 font-semibold pb-20 text-center">
                Le fonctionnement
            </h2>

            <div class="flex flex-col md:flex-row md:justify-center gap-8 md:gap-6 w-full max-w-5xl mx-auto">
                <div class="bg-infocus-icewhite text-black rounded-xl p-8 flex-1">
                    <h3 class="text-infocus-redphoto text-4xl font-bold mb-2">01</h3>
                    <p class="text-lg font-medium">
                        Remplis notre formulaire interactif
                    </p>
                </div>

                <div class="relative flex-1">
                    <img src="/img/hikari-front-happy.png" alt="Chouette InFocus"
                        class="absolute -top-36 left-1/2 transform -translate-x-1/2 w-48 h-48 z-0" />
                    <div class="relative bg-infocus-icewhite text-black rounded-xl p-8 z-10">
                        <h3 class="text-infocus-redphoto text-4xl font-bold mb-2">02</h3>
                        <p class="text-lg font-medium">
                            Sélectionne le pack qui te convient
                        </p>
                    </div>
                </div>

                <div class="bg-infocus-icewhite text-black rounded-xl p-8 flex-1">
                    <h3 class="text-infocus-redphoto text-4xl font-bold mb-2">03</h3>
                    <p class="text-lg font-medium">
                        Loue ton matériel & ajuste ton budget
                    </p>
                </div>
            </div>
        </div>
    </section>
    </section>


    {{-- LOUE MAINTENANT, ACHÈTE PLUS TARD --}}
    <section class="bg-infocus-twilightblue text-infocus-icewhite py-16">
        <div class="container mx-auto flex flex-col md:flex-row items-start justify-between gap-8">
            <div class="md:max-w-xl w-full">
                <h2 class="text-3xl md:text-4xl font-semibold mb-4">
                    Loue maintenant, achète plus tard !
                </h2>
                <p class="mb-6 font-semibold">
                    Avec notre option de location avec option d'achat (LOA), tu as la flexibilité
                    de louer ton équipement photo et, à la fin de ta période de location,
                    de choisir de l'acheter. Une solution pratique et abordable pour
                    les passionnés de photographie !
                    <br><br>
                    <span class="text-infocus-redphoto">Le petit + :</span> tout notre matériel
                    est reconditionné après ta location !
                </p>
                <a href="{{ route('simulation.index') }}"
                    class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium inline-block">
                    En savoir plus sur la LOA
                </a>
            </div>

            <div class="flex justify-center md:justify-end w-full md:w-auto">
                <img src="/img/home_loa.png" alt="Image LOA"
                    class="rounded-lg shadow-lg w-full md:w-auto max-w-md h-auto object-contain" />
            </div>
        </div>
    </section>


    {{-- NOS PACKS DU MOMENT --}}
    <section class="bg-infocus-twilightblue py-16">
        <div class="container mx-auto text-center text-infocus-icewhite">
            <h2 class="text-4xl mb-10 font-semibold">
                Nos packs du moment
            </h2>

            <div class="relative w-full glide-currentpacks">
                <div class="overflow-hidden" data-glide-el="track">
                    <ul class="relative w-full overflow-hidden p-0
                       flex flex-nowrap gap-4
                       [backface-visibility: hidden]
                       [transform-style: preserve-3d]
                       [touch-action: pan-y]
                       [will-change: transform]">
                        <li class="relative w-60 flex-shrink-0">
                            <div class="relative group">
                                <a href="#">
                                    <img src="/img/pack1.jpg" alt="Advanced Paysage" class="w-full h-48 object-cover rounded-lg
                               transition duration-500 ease-in-out transform brightness-75 
                               group-hover:brightness-50" />
                                </a>
                                <div class="absolute inset-0 flex items-end p-4 pointer-events-none">
                                    <h3 class="text-lg lg:text-xl font-semibold text-infocus-icewhite">
                                        Advanced Paysage
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="relative w-60 flex-shrink-0">
                            <div class="relative group">
                                <a href="#">
                                    <img src="/img/pack2.jpg" alt="Medium Animalier" class="w-full h-48 object-cover rounded-lg
                               transition duration-500 ease-in-out transform brightness-75 
                               group-hover:brightness-50" />
                                </a>
                                <div class="absolute inset-0 flex items-end p-4 pointer-events-none">
                                    <h3 class="text-lg lg:text-xl font-semibold text-infocus-icewhite">
                                        Medium Animalier
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="relative w-60 flex-shrink-0">
                            <div class="relative group">
                                <a href="#">
                                    <img src="/img/pack3.jpg" alt="Advanced Culinaire" class="w-full h-48 object-cover rounded-lg
                               transition duration-500 ease-in-out transform brightness-75 
                               group-hover:brightness-50" />
                                </a>
                                <div class="absolute inset-0 flex items-end p-4 pointer-events-none">
                                    <h3 class="text-lg lg:text-xl font-semibold text-infocus-icewhite">
                                        Advanced Culinaire
                                    </h3>
                                </div>
                            </div>
                        </li>

                        <li class="relative w-60 flex-shrink-0">
                            <div class="relative group">
                                <a href="#">
                                    <img src="/img/pack4.jpg" alt="Starter Auto moto" class="w-full h-48 object-cover rounded-lg
                               transition duration-500 ease-in-out transform brightness-75 
                               group-hover:brightness-50" />
                                </a>
                                <div class="absolute inset-0 flex items-end p-4 pointer-events-none">
                                    <h3 class="text-lg lg:text-xl font-semibold text-infocus-icewhite">
                                        Starter Auto moto
                                    </h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="absolute left-0 flex items-center justify-between w-full h-0 px-4 top-1/2"
                    data-glide-el="controls">
                    <button class="inline-flex items-center justify-center w-8 h-8 transition duration-300
                       border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700
                       hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none
                       bg-infocus-icewhite/20" data-glide-dir="<" aria-label="Slide précédent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>
                    </button>
                    <button class="inline-flex items-center justify-center w-8 h-8 transition duration-300
                       border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700
                       hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none
                       bg-infocus-icewhite/20" data-glide-dir=">" aria-label="Slide suivant">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <section class=" bg-gradient-to-b from-infocus-twilightblue via-infocus-intenseblue to-infocus-twilightblue">
        {{-- TON MATÉRIEL IDÉAL ADAPTÉ À TES BESOINS --}}
        <section class="text-infocus-icewhite py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-semibold mb-10">
                    Ton matériel idéal adapté à tes besoins
                </h2>
                <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
                    <div class="flex flex-col items-center text-center max-w-xs">
                        <i class='bx bxs-camera bx-lg mb-3'></i>
                        <h3 class="text-2xl font-semibold mb-2">
                            Loue simplement
                        </h3>
                        <p>
                            Grâce à nos partenaires, tu accèdes à du matériel de qualité
                            adapté à tes attentes et à ton niveau.
                        </p>
                    </div>
                    <div class="flex flex-col items-center text-center max-w-xs">
                        <i class='bx bx-money bx-lg mb-3'></i>
                        <h3 class="text-2xl font-semibold mb-2">
                            Adapté à ton budget
                        </h3>
                        <p>
                            Avec InFocus, tu peux explorer n’importe quelle pratique,
                            à n’importe quel budget !
                        </p>
                    </div>
                </div>
                <div class="mt-8">
                    <a href="{{ route('simulation.index') }}"
                        class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium">
                        Trouver mon matériel
                    </a>
                </div>
            </div>
        </section>

        {{-- ILS NOUS FONT CONFIANCE --}}
        <section class="py-16 ">
            <div class="container mx-auto ">
                <h2 class="text-4xl font-semibold mb-10 text-infocus-icewhite text-center">
                    Ils nous font confiance
                </h2>

                <div class="relative w-full glide-reviews">
                    <div data-glide-el="track" class="overflow-hidden">
                        <ul class="flex flex-nowrap gap-4
                               [backface-visibility:hidden]
                               [transform-style:preserve-3d]
                               [touch-action:pan-y]
                               [will-change:transform]">
                            <li class="w-[420px] flex-shrink-0 bg-white text-black rounded-lg p-6">
                                <h3 class="text-xl font-semibold mb-1">Pack Culinaire</h3>
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="block text-sm font-medium">Jean DUJARDIN</span>
                                    <div class="text-yellow-300">★★★★★</div>
                                    <span class="text-sm ml-1">5.0</span>
                                </div>
                                <p class="font-medium mb-4">Incroyable !</p>

                                <div class="pb-10">
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        <span class="text-7xl font-semibold text-black">&ldquo;</span>
                                        Ce super grand angle est vraiment surprenant par la faible
                                        déformation à 10 mm. Habitué des 14 ou 15 mm, je m'attendais
                                        à avoir des "effets courbes". Paradoxalement, il déforme
                                        moins que mon 14-35 mm. Idéal pour les photos de ville notamment.
                                        <span class="block text-right text-7xl font-semibold text-black">&rdquo;</span>

                                    </p>
                                </div>
                            </li>

                            <li class="w-[420px] flex-shrink-0 bg-white text-black rounded-lg p-6">
                                <h3 class="text-xl font-semibold mb-1">Pack Advanced Portrait</h3>
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="block text-sm font-medium">Kad MERAD</span>
                                    <div class="text-yellow-300">★★★★★</div>
                                    <span class="text-sm ml-1">5.0</span>
                                </div>
                                <p class="font-medium mb-4">Pas mal</p>

                                <div class="relative pb-10">
                                    <p class="text-sm text-gray-700 leading-relaxed mt-6 mx-2">
                                        <span class="text-7xl font-semibold text-black">&ldquo;</span>
                                        Matériel de bonne qualité et la livraison était rapide.
                                        <br>
                                        <span class="block text-right text-7xl font-semibold text-black">&rdquo;</span>
                                    </p>
                                </div>
                            </li>

                            <li class="w-[420px] flex-shrink-0 bg-white text-black rounded-lg p-6">
                                <h3 class="text-xl font-semibold mb-1">Pack Urbain</h3>
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="block text-sm font-medium">Philippe L.</span>
                                    <div class="text-yellow-300">★★★★☆</div>
                                    <span class="text-sm ml-1">4.0</span>
                                </div>
                                <p class="font-medium mb-4">Bon rapport qualité/prix</p>

                                <div class="relative pb-10">

                                    <p class="text-sm text-gray-700 leading-relaxed mt-6 mx-2">
                                        <span class="text-7xl font-semibold text-black">&ldquo;</span>

                                        Le pack m’a permis de tester différentes focales…
                                        Je recommande !
                                        <span class="block text-right text-7xl font-semibold text-black">&rdquo;</span>

                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div data-glide-el="controls"
                        class="absolute top-1/2 left-0 flex items-center justify-between w-full px-4 -translate-y-1/2">
                        <button data-glide-dir="<" class="inline-flex items-center justify-center w-8 h-8 border
                               rounded-full text-slate-700 border-slate-700
                               hover:text-slate-900 hover:border-slate-900
                               bg-infocus-icewhite/20 transition duration-300" aria-label="Avis précédent">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                            </svg>
                        </button>
                        <button data-glide-dir=">" class="inline-flex items-center justify-center w-8 h-8 border
                               rounded-full text-slate-700 border-slate-700
                               hover:text-slate-900 hover:border-slate-900
                               bg-infocus-icewhite/20 transition duration-300" aria-label="Avis suivant">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Partenaires -->
                @if ($partners->isNotEmpty())
                <div class="flex flex-wrap max-md:flex-col max-md:justify-center items-center
                           md:space-x-10 max-md:space-y-10 md:justify-evenly mt-8">
                    @foreach ($partners as $partner)
                    <img src="{{ asset('storage/' . $partner->image_url) }}" class="h-16 mx-4 my-2"
                        alt="{{ $partner->name }}">
                    @endforeach
                </div>
                @endif
            </div>
        </section>

        {{-- NOS CONSEILS ET INSPIRATIONS (BLOG) --}}
        <section class="py-16">
            <div class="container mx-auto">
                <h2 class="text-4xl font-semibold mb-10 text-infocus-icewhite text-center">
                    Nos conseils et inspirations
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                    <article class="text-infocus-icewhite overflow-hidden">
                        <div class="relative">
                            <img src="/img/blog1.jpg" alt="Image article de blog" class="rounded">
                        </div>
                        <div class="py-5">
                            <span class="bottom-2 left-2 bg-infocus-icewhite text-black text-xs font-medium
                        py-1 px-2 rounded">
                                22 février 2024
                            </span>
                            <h3 class="text-lg font-semibold mb-2">
                                Quels sont les meilleurs boîtiers pour les débutants&nbsp;?
                            </h3>
                            <p class="text-sm mb-4">
                                Lorem ipsum is simply dummy text of the printing and typesetting industry…
                            </p>
                            <a href="{{ route('blog.index') }}" class="text-sm font-medium hover:underline">
                                Voir plus
                            </a>
                        </div>
                    </article>

                    <article class="text-infocus-icewhite overflow-hidden">
                        <div class="relative">
                            <img src="/img/blog2.jpg" alt="Image article de blog" class="rounded">

                        </div>
                        <div class="py-5">
                            <span class="bottom-2 left-2 bg-infocus-icewhite text-black text-xs font-medium
                        py-1 px-2 rounded">
                                04 juin 2024
                            </span>
                            <h3 class="text-lg font-semibold mb-2">
                                10 Astuces pour Réussir ses Premières Photos
                            </h3>
                            <p class="text-sm mb-4">
                                Lorem ipsum is simply dummy text of the printing and typesetting industry…
                            </p>
                            <a href="{{ route('blog.index') }}" class="text-sm font-medium hover:underline">
                                Voir plus
                            </a>
                        </div>
                    </article>

                    <article class="text-infocus-icewhite overflow-hidden">
                        <div class="relative">
                            <img src="/img/blog3.jpg" class="rounded" alt="Image article de blog">
                        </div>
                        <div class="py-5">
                            <span class="bottom-2 left-2 bg-infocus-icewhite text-black text-xs font-medium
                        py-1 px-2 rounded">
                                12 novembre 2024
                            </span>
                            <h3 class="text-lg font-semibold mb-2">
                                Les Bases de la Photographie&nbsp;: Guide Complet
                            </h3>
                            <p class="text-sm mb-4">
                                Lorem ipsum is simply dummy text of the printing and typesetting industry…
                            </p>
                            <a href="{{ route('blog.index') }}" class="text-sm font-medium hover:underline">
                                Voir plus
                            </a>
                        </div>
                    </article>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('blog.index') }}"
                        class="infocus-btn-primary text-infocus-twilightblue py-3 px-6 rounded font-medium inline-block">
                        Voir tous nos articles
                    </a>
                </div>
            </div>
        </section>
    </section>
</x-guest-layout>

<script>
    function initializeGlide(selector) {
            return new Glide(selector, {
                type: 'carousel',
                perView: 5,
                animationDuration: 700,
                breakpoints: {
                    1024: {
                        perView: 2
                    },
                    640: {
                        perView: 1
                    }
                }
            }).mount();
        }

        var glideCurrentPacks = initializeGlide('.glide-currentpacks');

        document.addEventListener('DOMContentLoaded', function() {
            new Glide('.glide-reviews', {
                type: 'carousel',
                startAt: 0,
                perView: 3,
                gap: 24,
                autoplay: 4000,
                hoverpause: true,
                animationDuration: 800,
                breakpoints: {
                    1024: {
                        perView: 2
                    },
                    640: {
                        perView: 1
                    }
                }
            }).mount();
        });
</script>