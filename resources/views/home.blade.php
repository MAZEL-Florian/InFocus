<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/img/Fav blanc couleur.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.0.2/glide.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.js"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Quicksand:wght@300..700&family=Ruthie&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/components.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://use.typekit.net/rio1oev.css">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased bg-infocus-twilightblue font-quicksand">

    @livewire('navigation-menu')
    <div class="container mx-auto text-infocus-icewhite">
        <div class="sm:flex text-center sm:text-left justify-between mb-10">
            <div>
                <h1 class="py-10 text-5xl font-abeezee">Essayez, Apprenez, Achetez <br>si vous le
                    souhaitez
                </h1>
                <img src="img/hikari-night.png" width="78px" height="111px">
                <a href="#" class="infocus-btn-primary text-infocus-twilightblue font-medium">{{ __('Find my ideal gear') }}</a>
            </div>

        </div>
        <h2 class="py-24 text-7xl text-infocus-icewhite font-ruthie">{{ __('How it works') }}
        </h2>
        <div class="flex flex-col md:grid grid-cols-9 mx-auto p-2 text-blue-50">
            <div class="flex flex-row-reverse md:contents">
                <div
                    class="bg-infocus-icewhite text-black col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto infocus-shadow">
                    <h3 class="font-semibold text-infocus-redphoto text-4xl mb-1">01</h3>
                    <h3 class="font-semibold text-3xl mb-1">Remplis notre formulaire interactif</h3>
                    <p class="leading-tight text-justify font-medium">
                        Lorem ipsum dolor sit amet consectetur. Aliquam amet ullamcorper risus imperdiet tellus quis
                        pellentesque egestas elit. Fermentum ac sit risus.
                    </p>
                </div>
                <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-white pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-infocus-icewhite infocus-shadow"></div>
                </div>
            </div>
            <div class="flex md:contents">
                <div class="col-start-5 col-end-6 mr-10 md:mx-auto relative">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-white pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-infocus-icewhite infocus-shadow"></div>
                </div>
                <div
                    class="bg-infocus-icewhite text-black col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto infocus-shadow">
                    <h3 class="font-semibold text-infocus-redphoto text-4xl mb-1">02</h3>
                    <h3 class="font-semibold text-3xl mb-1">Sélectionne le pack qui te convient</h3>
                    <p class="leading-tight text-justify font-medium">
                        Lorem ipsum dolor sit amet consectetur. Aliquam amet ullamcorper risus imperdiet tellus quis
                        pellentesque egestas elit. Fermentum ac sit risus.
                    </p>
                </div>
            </div>
            <div class="flex flex-row-reverse md:contents">
                <div
                    class="bg-infocus-icewhite text-black col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto infocus-shadow">
                    <h3 class="font-semibold text-infocus-redphoto text-4xl mb-1">03</h3>
                    <h3 class="font-semibold text-3xl mb-1">Loue ton matériel & ajuste ton budget</h3>
                    <p class="leading-tight text-justify font-medium">
                        Lorem ipsum dolor sit amet consectetur. Aliquam amet ullamcorper risus imperdiet tellus quis
                        pellentesque egestas elit. Fermentum ac sit risus.
                    </p>
                </div>
                <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-white pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-infocus-icewhite infocus-shadow"></div>
                </div>
            </div>
            <div class="col-start-6 col-end-10 flex justify-center items-end mt-4 mx-auto">
                <a href="#" class="infocus-btn-primary text-infocus-twilightblue font-medium">{{ __('Find my ideal gear') }}</a>

            </div>
        </div>



        {{-- STYLE PHOTO --}}
        @if($photoTypes->isNotEmpty())

        <h3 class="py-24 text-7xl text-infocus-icewhite font-ruthie">{{ __('Find your photo style') }}
        </h3>
        <div class="relative w-full glide-photostyle">
            <!-- Slides -->
            <div class="overflow-hidden" data-glide-el="track">
                
                <ul class="relative w-full overflow-hidden p-0 whitespace-no-wrap flex flex-no-wrap [backface-visibility: hidden] [transform-style: preserve-3d] [touch-action: pan-Y] [will-change: transform]">
                    @foreach($photoTypes as $photoType)
                    <li class="relative w-48 flex flex-shrink-0">
                        <div class="relative group">
                            <a href="#">
                                <img src="{{ asset('storage/'.$photoType->image) }}" alt="{{ $photoType->name }}"
                                    class="object-contain h-48 w-48 rounded-lg object-cover object-center transition duration-500 ease-in-out transform brightness-75 group-hover:brightness-50" />
                            </a>
                            <div
                                class="bg-grey-800 bg-opacity-30 absolute inset-0 flex items-end justify-start p-6 pointer-events-none">
                                <h3 class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white">{{
                                    $photoType->name }}</h3>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="absolute left-0 flex items-center justify-between w-full h-0 px-4 top-1/2"
                data-glide-el="controls">
                <button
                    class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700 hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none bg-white/20"
                    data-glide-dir="<" aria-label="prev slide">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <title>Slide précédente</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
                <button
                    class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700 hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none bg-white/20"
                    data-glide-dir=">" aria-label="next slide">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <title>Slide suivante</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </button>
            </div>
        </div>
        @endif
        {{-- L'EQUIPEMENT IDEAL SELON TES BESOINS --}}
        <h3 class="py-24 text-7xl text-infocus-icewhite font-ruthie">{{ __('The ideal equipment for your needs') }}
        </h3>
        <div class="flex flex-col items-center py-10">
            <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
                <div class="flex flex-col items-center text-center max-w-xs">

                    <i class='bx bxs-camera bx-lg'></i>

                    <h2 class="text-4xl py-3 text-infocus-icewhite font-semibold mb-2">Loue simplement</h2>
                    <p class="text-infocus-icewhite">Grâce à tous nos partenaires, tu accède à du matériel de qualité
                        adapté à tes attentes et ton niveau.</p>
                </div>
                <div class="flex flex-col items-center text-center max-w-xs">

                    <i class='bx bx-money bx-lg'></i>

                    <h2 class="text-4xl py-3 text-infocus-icewhite font-semibold mb-2">Adapté à ton budget</h2>
                    <p class="text-infocus-icewhite">Avec InFocus, tu peux explorer n’importe quelle pratique, à
                        n’importe quel budget !</p>
                </div>
            </div>
            <div class="py-10">
                <a href="#" class="infocus-btn-primary text-infocus-twilightblue font-medium">{{ __('Find my ideal gear') }}</a>
            </div>
        </div>

        {{-- NOS PACKS DU MOMENT --}}
        @if($photoTypes->isNotEmpty())
        <h3 class="py-24 text-7xl text-infocus-icewhite font-ruthie">{{ __('Our packs of the moment') }}
        </h3>
        <div class="relative w-full glide-currentpacks">
            <!-- Slides -->
            <div class="overflow-hidden" data-glide-el="track">
                <ul
                    class="relative w-full overflow-hidden p-0 whitespace-no-wrap flex flex-no-wrap [backface-visibility: hidden] [transform-style: preserve-3d] [touch-action: pan-Y] [will-change: transform]">
                    @foreach($photoTypes as $photoType)
                    <li class="relative w-48 flex flex-shrink-0">
                        <div class="relative group">
                            <a href="#">
                                <img src="{{ asset('storage/'.$photoType->image) }}" alt="{{ $photoType->name }}"
                                    class="object-contain h-48 w-48 rounded-lg object-cover object-center transition duration-500 ease-in-out transform brightness-75 group-hover:brightness-50" />
                            </a>
                            <div
                                class="bg-grey-800 bg-opacity-30 absolute inset-0 flex items-end justify-start p-6 pointer-events-none">
                                <h3 class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white">{{
                                    $photoType->name }}</h3>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- Controls -->
            <div class="absolute left-0 flex items-center justify-between w-full h-0 px-4 top-1/2"
                data-glide-el="controls">
                <button
                    class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700 hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none bg-white/20"
                    data-glide-dir="<" aria-label="prev slide">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <title>Slide précédente</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
                <button
                    class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700 hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none bg-white/20"
                    data-glide-dir=">" aria-label="next slide">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <title>Slide suivante</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </button>
            </div>
        </div>
        @endif



        {{-- ILS NOUS FONT CONFIANCE --}}
        @if($partners->isNotEmpty())
        <h3 class="py-24 text-7xl text-infocus-icewhite font-ruthie">{{ __('They trust us') }}
        </h3>
        <div
            class="flex max-md:flex-col max-md:justify-center items-center md:space-x-10 max-md:space-y-10 md:justify-evenly">

            @foreach ($partners as $partner)
            <img src="{{ asset('storage/'.$partner->image) }}" class="h-16" alt="{{ $partner->name }}">
            @endforeach
        </div>
        @endif


        {{-- BLOG --}}
        <h3 class="py-24 text-7xl text-infocus-icewhite font-ruthie">{{ __('Our latest blog posts') }}
        </h3>
        <div class="flex flex-wrap max-md:justify-center justify-evenly gap-4 pb-24">
            <div class="w-full sm:w-1/2 lg:w-1/5 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="https://picsum.photos/400/250" alt="" />
                </a>
                <div class="p-5">
                    <div class="py-5 pt-0">
                        <span
                            class="select-none text-center uppercase transition-all py-3 px-6 rounded-lg bg-infocus-icewhite text-infocus-bluenight font-medium">
                            10/05/2024
                        </span>
                    </div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-medium tracking-tight text-infocus-icewhite">Les
                            objectifs
                            les plus populaires du moment !</h5>
                    </a>
                    <p class="mb-3 text-infocus-icewhite">Canon, Nikon, Fujifilm, lequel
                        choisir
                        ?</p>
                    <div class="col-start-6 col-end-10 flex justify-center items-end mt-4 mx-auto">
                        <a href="#" class="infocus-btn-primary text-infocus-twilightblue font-medium">Lire</a>

                    </div>
                </div>
            </div>

            <div class="w-full sm:w-1/2 lg:w-1/5 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="https://picsum.photos/400/250" alt="" />
                </a>
                <div class="p-5">
                    <div class="py-5 pt-0">
                        <span
                            class="select-none text-center uppercase transition-all py-3 px-6 rounded-lg bg-infocus-icewhite text-infocus-bluenight font-medium">
                            10/05/2024
                        </span>
                    </div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-medium tracking-tight text-infocus-icewhite">Les
                            objectifs
                            les plus populaires du moment !</h5>
                    </a>
                    <p class="mb-3 text-infocus-icewhite">Canon, Nikon, Fujifilm, lequel
                        choisir
                        ?</p>
                    <div class="col-start-6 col-end-10 flex justify-center items-end mt-4 mx-auto">
                        <a href="#" class="infocus-btn-primary text-infocus-twilightblue font-medium">Lire</a>

                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/5 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="https://picsum.photos/400/250" alt="" />
                </a>
                <div class="p-5">
                    <div class="py-5 pt-0">
                        <span
                            class="select-none text-center uppercase transition-all py-3 px-6 rounded-lg bg-infocus-icewhite text-infocus-bluenight font-medium">
                            10/05/2024
                        </span>
                    </div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-medium tracking-tight text-infocus-icewhite">Les
                            objectifs
                            les plus populaires du moment !</h5>
                    </a>
                    <p class="mb-3 text-infocus-icewhite">Canon, Nikon, Fujifilm, lequel
                        choisir
                        ?</p>
                    <div class="col-start-6 col-end-10 flex justify-center items-end mt-4 mx-auto">
                        <a href="#" class="infocus-btn-primary text-infocus-twilightblue font-medium">Lire</a>

                    </div>
                </div>
            </div>

            <div
                class="w-full sm:w-1/2 lg:w-1/5 bg-gray-200 border border-gray-200 rounded-lg shadow flex items-center justify-center dark:bg-gray-800 dark:border-gray-700">
                <a href="#"
                    class="flex flex-col items-center justify-center p-5 h-full w-full text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                    <div class="text-5xl mb-2">+</div>
                    <div class="text-lg font-medium">Voir plus</div>
                </a>
            </div>

        </div>

    </div>


    @livewire('footer-menu')
</body>

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

var glidePhotoStyle = initializeGlide('.glide-photostyle');
var glideCurrentPacks = initializeGlide('.glide-currentpacks');

</script>

</html>