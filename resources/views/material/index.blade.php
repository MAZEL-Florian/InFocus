<x-guest-layout>
    <section class="relative">
        <div class="h-[700px] bg-center bg-cover" style="background-image: url('/img/home_material.jpeg')">
            <div class="max-w-7xl h-3/4 mx-auto flex items-center justify-start">
                <div class="text-infocus-icewhite px-6 md:px-8 max-w-xl">
                    <h1 class="text-4xl md:text-5xl font-bold">Notre matériel</h1>
                    <p class="mt-4">
                        Découvrez les équipements des plus grandes marques, sélectionnés pour vous accompagner dans vos
                        premiers pas en photographie.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl md:text-3xl font-semibold text-center text-infocus-icewhite mb-4">
                Nos partenaires, une garantie d’excellence
            </h3>
            <p class="text-infocus-icewhite mb-8 max-w-3xl mx-auto text-center py-12">
                Chez Infocus, nous avons sélectionné les meilleurs partenaires pour garantir à nos utilisateurs une
                expérience de photographie exceptionnelle dès leurs débuts. Canon, Nikon et Sony sont reconnus
                mondialement pour leur innovation, leur fiabilité et leur qualité d'image inégalée. Que vous soyez
                passionné par les portraits, la photographie de paysage ou les événements, leur matériel est conçu pour
                s'adapter à toutes vos ambitions.
            </p>

            @foreach($partners as $partner)
            @if($loop->odd)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 py-12">
                <div class="">
                    <img src="{{ asset('storage/' . $partner->image_url) }}" alt="Logo {{ $partner->name }}"
                        class="h-16 my-2">

                    <p class="text-infocus-icewhite py-20">
                        @switch($partner->name)
                        @case('Canon')
                        Réputé pour ses couleurs riches et sa polyvalence, Canon est un choix idéal pour les débutants.
                        Grâce à leur gamme d'appareils intuitifs et ergonomiques, Canon facilite l'apprentissage et
                        permet d'obtenir des résultats professionnels dès les premiers clichés.
                        @break

                        @case('Nikon')
                        Nikon est synonyme de détails et de netteté. Avec leurs objectifs de pointe et leurs boîtiers
                        robustes,
                        Nikon accompagne les photographes débutants pour explorer leur créativité en toute confiance,
                        qu'il s'agisse de photographie artistique ou documentaire.
                        @break

                        @case('Sony')
                        Leader dans la technologie des appareils hybrides, Sony offre des solutions légères et
                        performantes.
                        Ses fonctionnalités avancées, comme l'autofocus intelligent, permettent aux débutants de réussir
                        leurs clichés sans effort, même dans des conditions complexes.
                        @break

                        @default
                        Description non renseignée pour {{ $partner->name }}.
                        @endswitch
                    </p>
                </div>

                <div>
                    @switch($partner->name)
                    @case('Canon')
                    <img src="{{ asset('img/material_canon.jpeg') }}" alt="Appareil photo Canon"
                        class="w-full h-96 rounded-lg shadow-lg object-cover">
                    @break

                    @case('Nikon')
                    <img src="{{ asset('img/material_nikon.jpeg') }}" alt="Appareil photo Nikon"
                        class="w-full h-96 rounded-lg shadow-lg object-cover">
                    @break

                    @case('Sony')
                    <img src="{{ asset('img/material_sony.jpeg') }}" alt="Appareil photo Sony"
                        class="w-full h-96 rounded-lg shadow-lg object-cover">
                    @break

                    @default
                    <p class="text-infocus-icewhite">Aucune image d'illustration disponible pour {{ $partner->name }}.
                    </p>
                    @endswitch
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div>
                    @switch($partner->name)
                    @case('Canon')
                    <img src="{{ asset('img/material_canon.jpeg') }}" alt="Appareil photo Canon"
                        class="w-full h-auto rounded-lg shadow-lg object-cover">
                    @break

                    @case('Nikon')
                    <img src="{{ asset('img/material_nikon.jpeg') }}" alt="Appareil photo Nikon"
                        class="w-full h-auto rounded-lg shadow-lg object-cover">
                    @break

                    @case('Sony')
                    <img src="{{ asset('img/material_sony.jpeg') }}" alt="Appareil photo Sony"
                        class="w-full h-auto rounded-lg shadow-lg object-cover">
                    @break

                    @default
                    <p class="text-infocus-icewhite">Aucune image d'illustration disponible pour {{ $partner->name }}.
                    </p>
                    @endswitch
                </div>

                <div>
                    <img src="{{ asset('storage/' . $partner->image_url) }}" alt="Logo {{ $partner->name }}"
                        class="h-16 mb-4 ">

                    <p class="text-infocus-icewhite py-20">
                        @switch($partner->name)
                        @case('Canon')
                        Réputé pour ses couleurs riches et sa polyvalence, Canon est un choix idéal pour les débutants.
                        Grâce à leur gamme d'appareils intuitifs et ergonomiques, Canon facilite l'apprentissage et
                        permet d'obtenir des résultats professionnels dès les premiers clichés.
                        @break

                        @case('Nikon')
                        Nikon est synonyme de détails et de netteté. Avec leurs objectifs de pointe et leurs boîtiers
                        robustes,
                        Nikon accompagne les photographes débutants pour explorer leur créativité en toute confiance,
                        qu'il s'agisse de photographie artistique ou documentaire.
                        @break

                        @case('Sony')
                        Leader dans la technologie des appareils hybrides, Sony offre des solutions légères et
                        performantes.
                        Ses fonctionnalités avancées, comme l'autofocus intelligent, permettent aux débutants de réussir
                        leurs clichés sans effort, même dans des conditions complexes.
                        @break

                        @default
                        Description non renseignée pour {{ $partner->name }}.
                        @endswitch
                    </p>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>
    @if ($photoTypes->isNotEmpty())
    <section class="pb-8">
        <div class="container mx-auto text-center text-infocus-icewhite">
            <h2 class="text-4xl font-semibold mb-10">
                Découvrez nos recommandations personnalisées
            </h2>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($photoTypes as $photoType)
                    <div class="swiper-slide relative group">
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

            <div class="mt-8">
                <a href="{{ route('simulation.index') }}"
                    class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium">
                    Trouver mon matériel idéal
                </a>
            </div>
        </div>
    </section>
    @endif

    <section class="text-infocus-icewhite py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-semibold mb-10">
                Ton matériel idéal adapté à tes besoins
            </h2>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
                <div class="flex flex-col items-center text-center max-w-xl">
                    <i class='bx bxs-camera bx-lg mb-3'></i>
                    <p>
                        Pas besoin d'un matériel compliqué pour démarrer ! Nous vous proposons une sélection de boîtiers
                        et d'objectifs adaptés à tous les budgets, en collaboration avec Canon, Nikon et Sony. Notre
                        formulaire intelligent vous guidera pas à pas pour choisir le matériel qui correspondent à vos
                        besoins et vos envies.
                    </p>
                </div>

            </div>
            <div class="mt-8">
                <a href="{{ route('pack.index') }}"
                    class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium">
                    Voir tous nos packs
                </a>
            </div>
        </div>
    </section>
</x-guest-layout>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".mySwiper", {
            
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 20,
            centeredSlides: true,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
            },
        });
    });
</script>