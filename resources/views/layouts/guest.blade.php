<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/components.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="/img/Fav blanc couleur.png">
    <link rel="stylesheet" href="https://use.typekit.net/rio1oev.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.js"></script>
    <!-- Swiper Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Quicksand:wght@300..700&family=Ruthie&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen bg-infocus-twilightblue font-quicksand">
    @livewire('navigation-menu')
    @isset($header)
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main class="flex-grow">
        {{ $slot }}
    </main>
    @livewire('footer-menu')

    @stack('modals')
    @stack('scripts')
    @livewireScripts
</body>

</html>