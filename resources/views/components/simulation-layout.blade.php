@props([
    'currentStep' => 1,
    'overlayTitle' => '',
    'overlayDescription' => '',
    'overlayButtonText' => 'Commencer',
    'forceCircles' => [], 
])

<x-app-layout>
    <div class="relative py-8 bg-darkblue">
        <div id="overlay"
             class="absolute inset-0 flex items-center justify-center z-10 transition-opacity duration-500 bg-black bg-opacity-50">
            <div class="text-center p-8 rounded-lg">
                <img src="{{ asset('img/hikari-right.png') }}"
                     alt="Hikari"
                     width="78" height="111"
                     class="mx-auto mb-6">

                <h2 class="text-white text-2xl font-semibold mb-4">
                    {!! $overlayTitle !!}
                </h2>
                <p class="text-white mb-6">
                    {!! $overlayDescription !!}
                </p>

                <button id="startButton"
                        class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium transition">
                    {{ $overlayButtonText }}
                </button>
            </div>
        </div>

        <div id="mainContent" class="w-full z-0">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-2">
                    <div id="circle-0" class="circle"></div>
                    <div id="circle-1" class="circle"></div>
                    <div id="circle-2" class="circle"></div>
                </div>
                <div class="vertical-divider mx-3"></div>

                <div class="flex items-center space-x-2">
                    <div id="circle-3" class="circle"></div>
                    <div id="circle-4" class="circle"></div>
                    <div id="circle-5" class="circle"></div>
                </div>
                <div class="vertical-divider mx-3"></div>

                <div class="flex items-center space-x-2">
                    <div id="circle-6" class="circle"></div>
                    <div id="circle-7" class="circle"></div>
                    <div id="circle-8" class="circle"></div>
                </div>
            </div>

            {{ $slot }}
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('startButton')?.addEventListener('click', function () {
            const overlay = document.getElementById('overlay');
            overlay.classList.add('opacity-0', 'pointer-events-none');
        });
    </script>
    @endpush

    <style>
        .bg-darkblue {
            background-color: #0E1E34;
        }
        .circle {
            width: 14px;
            height: 14px;
            border-radius: 9999px;
            background-color: #6B7280;
        }
        .vertical-divider {
            width: 2px;
            height: 14px;
            background-color: #6B7280;
        }
        .circle.active {
            background-color: #ffffff;
        }
        #overlay {
            transition: opacity 0.5s ease;
        }
        #overlay.opacity-0 {
            opacity: 0;
        }
        #overlay.pointer-events-none {
            pointer-events: none;
        }
    </style>
</x-app-layout>
