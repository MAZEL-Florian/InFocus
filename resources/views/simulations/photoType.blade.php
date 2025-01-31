<x-app-layout>
    <div class="relative py-24 bg-darkblue">
        <!-- Overlay -->
        <div id="overlay"
            class="absolute inset-0 flex items-center justify-center z-10 transition-opacity duration-500 bg-black bg-opacity-50">
            <div class="text-center p-8 rounded-lg">
                <img src="{{ asset('img/hikari-front.png') }}" alt="Hikari" width="78" height="111"
                    class="mx-auto mb-6">
                <h2 class="text-white text-2xl font-semibold mb-4">
                    Salut, moi c’est Hikari ! <br>
                    Je t’accompagne tout au long de ce simulateur pour trouver ton pack de matériel idéal.
                </h2>
                <p class="text-white mb-6">
                    Commençons par choisir le style de photos que tu souhaites explorer !
                </p>
                <button id="startButton" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                    Commencer
                </button>
            </div>
        </div>

        <div id="mainContent" class="max-w-7xl mx-auto sm:px-6 lg:px-8 z-0">
            <h1 class="text-infocus-icewhite text-4xl font-bold mb-10 text-center">Choisis ton style photographique</h1>

            <form action="{{ route('simulation.store') }}" method="POST">
                @csrf
                <input type="hidden" id="selectedPhotoTypeId" name="photo_type_id">

                @if($photoTypes->isNotEmpty())
                <div class="relative">
                    <div id="slider"
                        class="flex overflow-x-scroll custom-scrollbar space-x-4 scroll-smooth snap-x snap-mandatory pb-6">
                        @foreach($photoTypes as $photoType)
                        <div class="snap-center flex-shrink-0"
                            style="width: 668px; height: 422px; overflow: hidden; border-radius: 10px;">
                            <a href="#" onclick="selectPhotoType({{ $photoType->id }}); return false;">
                                <div id="photo-{{ $photoType->id }}" class="relative group photo-item">
                                    <img src="{{ asset('storage/'.$photoType->image_url) }}"
                                        alt="{{ $photoType->name }}"
                                        class="h-[422px] w-[668px] object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                                    <div
                                        class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-center py-2 rounded-b-lg">
                                        <h3 class="text-lg font-medium">{{ $photoType->name }}</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <button type="submit"
                    class="mt-6 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                    Valider
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('startButton').addEventListener('click', function () {
        const overlay = document.getElementById('overlay');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    });

    function selectPhotoType(photoTypeId) {
        document.querySelectorAll('.photo-item').forEach(photo => {
            photo.classList.remove('border-4', 'border-blue-500');
        });


        const selectedPhoto = document.getElementById(`photo-${photoTypeId}`);
        selectedPhoto.classList.add('border-4', 'border-blue-500');

        document.getElementById('selectedPhotoTypeId').value = photoTypeId;
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #888;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .photo-item {
        overflow: hidden;
        position: relative;
        border-radius: 10px;
    }

    .photo-item img {
        transition: transform 0.3s ease-in-out;
    }

    .photo-item:hover img {
        transform: scale(1.05);
    }

    .photo-item {
        transition: border 0.2s ease-in-out;
    }
</style>