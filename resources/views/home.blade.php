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
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://use.typekit.net/rio1oev.css">
    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased bg-infocus-primary" style="font-family: Komet;">
    @livewire('navigation-menu')

    <div class="container mx-auto">
        <div class="sm:flex text-center sm:text-left justify-between mb-10">
            <div>
                <h1 class="py-10 text-5xl font-extrabold text-white">Essayez, Apprenez, Achetez <br>(si vous le
                    souhaitez)
                </h1>
                <a href="#"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Trouver mon matériel idéal
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
            <div id="controls-carousel" class="max-sm:mx-auto relative w-96 my-10 " data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://picsum.photos/200/300"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <img src="https://picsum.photos/200/300"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://picsum.photos/200/300"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://picsum.photos/200/300"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://picsum.photos/200/300"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
        <h3 class="py-10 text-2xl font-extrabold text-white">Comment ça fonctionne
        </h3>
        <div class="flex flex-col md:grid grid-cols-9 mx-auto p-2 text-blue-50">
            <!-- left -->
            <div class="flex flex-row-reverse md:contents">
                <div class="bg-blue-500 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                    <h3 class="font-semibold text-lg mb-1">Remplis notre formulaire interactif</h3>
                    <p class="leading-tight text-justify">
                        Lorem ipsum dolor sit amet consectetur. Aliquam amet ullamcorper risus imperdiet tellus quis pellentesque egestas elit. Fermentum ac sit risus.
                    </p>
                </div>
                <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
                </div>
            </div>
            <!-- right -->
            <div class="flex md:contents">
                <div class="col-start-5 col-end-6 mr-10 md:mx-auto relative">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
                </div>
                <div class="bg-blue-500 col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                    <h3 class="font-semibold text-lg mb-1">Sélectionne le Pack qui te convient</h3>
                    <p class="leading-tight text-justify">
                        Lorem ipsum dolor sit amet consectetur. Aliquam amet ullamcorper risus imperdiet tellus quis pellentesque egestas elit. Fermentum ac sit risus.
                    </p>
                </div>
            </div>
            <!-- left -->
            <div class="flex flex-row-reverse md:contents">
                <div class="bg-blue-500 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                    <h3 class="font-semibold text-lg mb-1">Loue ton matériel et ajuste ton budget</h3>
                    <p class="leading-tight text-justify">
                        Lorem ipsum dolor sit amet consectetur. Aliquam amet ullamcorper risus imperdiet tellus quis pellentesque egestas elit. Fermentum ac sit risus.
                    </p>
                </div>
                <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
                </div>
            </div>

        </div>

        <h3 class="py-10 text-2xl font-extrabold text-white">Trouve ton style photo
        </h3>

        <!--HTML CODE-->
        <div class="flex items-center justify-center w-full h-full py-24 sm:py-8 px-4">
            <div class="w-full relative flex items-center justify-center">
                <button aria-label="slide backward"
                    class="absolute z-30 left-0 ml-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer"
                    id="prev">
                    <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
                    <div id="slider"
                        class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">
                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Portrait</h3>
                                </div>
                            </a>
                        </div>

                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Paysage</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Mariage</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Nuit</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Animalier</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Sportif</h3>
                                </div>
                            </a>
                        </div>
                        <div class="flex flex-shrink-0 relative w-full sm:w-auto group">
                            <a href="#">
                                <img src="https://i.ibb.co/fDngH9G/carosel-1.png" alt="black chair and white table"
                                    class="object-cover object-center w-full transition duration-500 ease-in-out transform group-hover:brightness-75" />
                                <div
                                    class="bg-gray-800 bg-opacity-30 absolute inset-0 flex items-center justify-center p-6">
                                    <h3
                                        class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                        Studio</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <button aria-label="slide forward"
                    class="absolute z-30 right-0 mr-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                    id="next">
                    <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <h3 class="py-10 text-2xl font-extrabold text-white">Ton matériel idéal adapté à tes besoins
        </h3>
        <div class="flex flex-col items-center py-10">
            <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
                <div class="flex flex-col items-center text-center max-w-xs">
                    <div
                        class="w-20 h-20 bg-gray-300 rounded-full font-extrabold flex items-center justify-center mb-4 text-4xl">
                        <i class='bx bx-euro bx-tada bx-rotate-90'></i>
                    </div>
                    <h2 class="text-lg text-white font-semibold mb-2">Achète simplement</h2>
                    <p class="text-white">Grâce à tous nos partenaires, tu accèdes à du matériel de qualité adapté à tes
                        attentes et ton niveau.</p>
                </div>
                <div class="flex flex-col items-center text-center max-w-xs">
                    <div
                        class="w-20 h-20 bg-gray-300 rounded-full font-extrabold flex items-center justify-center mb-4 text-4xl">
                        <i class='bx bxs-pen bx-tada'></i>
                    </div>
                    <h2 class="text-lg text-white font-semibold mb-2">Pour tous les styles</h2>
                    <p class="text-white">Avec InFocus, tu peux explorer n’importe quelle pratique, à n’importe quel
                        moment !</p>
                </div>
            </div>
            <button class="mt-8 px-6 py-2 bg-gray-400 text-white rounded-md">Trouver mon matériel idéal</button>
        </div>
        <h3 class="py-10 text-2xl font-extrabold text-white">Nos derniers articles de blog
        </h3>


        <div class="flex flex-wrap max-md:justify-center gap-4 p-6">
            <div
                class="w-full sm:w-1/2 lg:w-1/5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="https://picsum.photos/400/250" alt="" />
                </a>
                <div class="p-5">
                    <div class="py-5 pt-0">
                        <span
                            class="select-none font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10">
                            10/05/2024
                        </span>
                    </div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Les objectifs
                            les plus populaires du moment !</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Canon, Nikon, Fujifilm, lequel choisir
                        ?</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lire
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="w-full sm:w-1/2 lg:w-1/5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="https://picsum.photos/400/250" alt="" />
                </a>
                <div class="p-5">
                    <div class="py-5 pt-0">
                        <span
                            class="select-none font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10">
                            10/05/2024
                        </span>
                    </div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Les objectifs
                            les plus populaires du moment !</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Canon, Nikon, Fujifilm, lequel choisir
                        ?</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lire
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="w-full sm:w-1/2 lg:w-1/5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="https://picsum.photos/400/250" alt="" />
                </a>
                <div class="p-5">
                    <div class="py-5 pt-0">
                        <span
                            class="select-none font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10">
                            10/05/2024
                        </span>
                    </div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Les objectifs
                            les plus populaires du moment !</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Canon, Nikon, Fujifilm, lequel choisir
                        ?</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lire
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>



            <!-- "Voir plus" card -->
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
    let defaultTransform = 0;
function goNext() {
    defaultTransform = defaultTransform - 398;
    var slider = document.getElementById("slider");
    if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7) defaultTransform = 0;
    slider.style.transform = "translateX(" + defaultTransform + "px)";
}
next.addEventListener("click", goNext);
function goPrev() {
    var slider = document.getElementById("slider");
    if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
    else defaultTransform = defaultTransform + 398;
    slider.style.transform = "translateX(" + defaultTransform + "px)";
}
prev.addEventListener("click", goPrev);
</script>

</html>