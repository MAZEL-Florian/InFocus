<x-app-layout>
    <div class="relative py-24 bg-darkblue">
        <!-- Overlay -->
        <div id="overlay"
            class="absolute inset-0 flex items-center justify-center z-10 transition-opacity duration-500 bg-black bg-opacity-50">
            <div class="text-center p-8 rounded-lg">
                <img src="{{ asset('img/hikari-right.png') }}" alt="Hikari" width="78" height="111"
                    class="mx-auto mb-6">
                <h2 class="text-white text-2xl font-semibold mb-4">
                    La colorimétrie c’est fait.
                    <br>

                </h2>
                <p class="text-white mb-6">
                    Je souhaite maintenant que tu choisisse ta focale. C’est le niveau de zoom. Regarde l’arrière plan
                    des photos et choisi celui que tu préfère. (Loin du sujet ou proche)
                    <br>
                    Cela vas déterminer en parti tes objectifs.
                </p>
                <button id="startButton" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                    Commencer
                </button>
            </div>
        </div>

        <div id="mainContent" class="max-w-7xl mx-auto sm:px-6 lg:px-8 z-0">
            <form action="{{ route('simulation.post-step-two', ['simulation' => $simulation]) }}" method="POST">
                @csrf
                <!-- Hidden inputs to store selected photos -->
                @foreach ($photosByGroups as $groupIndex => $photosByGroup)
                <input type="hidden" name="selectedPhotos[{{ $groupIndex }}]" id="selectedPhoto-{{ $groupIndex }}">
                @endforeach

                <!-- Series slider -->
                <div class="relative">
                    <div id="slider"
                        class="flex overflow-x-scroll custom-scrollbar space-x-4 scroll-smooth snap-x snap-mandatory pb-6">
                        @foreach ($photosByGroups as $groupIndex => $photosByGroup)
                        <div id="series-{{ $groupIndex }}" class="series hidden">
                            <div class="flex justify-center gap-4">
                                @foreach ($photosByGroup as $photo)
                                <div class="photo-item cursor-pointer" style="width: 668px; height: 422px;"
                                    onclick="selectPhoto({{ $photo->id }}, {{ $groupIndex }})">
                                    <img src="{{ asset('storage/' . $photo->image_url) }}" alt="Photo {{ $photo->id }}"
                                        id="photo-{{ $groupIndex }}-{{ $photo->id }}"
                                        class="h-full w-full object-cover rounded-lg transition-transform duration-300 ease-in-out hover:scale-105">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="flex justify-between items-center mt-6">
                    <button type="button" id="prevButton"
                        class="text-infocus-icewhite border border-infocus-icewhite py-2 px-4 rounded transition"
                        disabled>
                        Précédent
                    </button>
                    <button type="button" id="nextButton"
                        class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded transition">
                        Suivant
                    </button>
                </div>

                <!-- Submit button -->
                <button type="submit" id="submitButton"
                    class="mt-6 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    Valider
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let currentSeries = 0;
    const totalSeries = {{ count($photosByGroups) }};

    function showSeries(index) {
        // Show only the current series
        document.querySelectorAll('.series').forEach((series, i) => {
            series.classList.toggle('hidden', i !== index);
        });

        // Enable/Disable navigation buttons
        document.getElementById('prevButton').disabled = index === 0;
        document.getElementById('nextButton').disabled = index === totalSeries - 1;

        // Enable/Disable submit button on last series
        document.getElementById('submitButton').disabled = !(
            index === totalSeries - 1 &&
            Array.from({ length: totalSeries }, (_, i) =>
                document.getElementById(`selectedPhoto-${i}`).value
            ).every(value => value !== '')
        );
    }

    function selectPhoto(photoId, groupIndex) {
        // Clear previous selection
        document.querySelectorAll(`#series-${groupIndex} .photo-item img`).forEach(photo => {
            photo.classList.remove('border-4', 'border-blue-500');
        });

        // Highlight selected photo
        const selectedPhoto = document.getElementById(`photo-${groupIndex}-${photoId}`);
        selectedPhoto.classList.add('border-4', 'border-blue-500');

        // Save selection
        document.getElementById(`selectedPhoto-${groupIndex}`).value = photoId;

        // Enable the submit button if all series have a selected photo
        const allSelected = Array.from({ length: totalSeries }, (_, i) =>
            document.getElementById(`selectedPhoto-${i}`).value
        ).every(value => value !== '');

        if (allSelected && currentSeries === totalSeries - 1) {
            document.getElementById('submitButton').disabled = false;
        }
    }

    document.getElementById('startButton').addEventListener('click', function () {
        document.getElementById('overlay').classList.add('opacity-0', 'pointer-events-none');
        showSeries(0);
    });

    document.getElementById('prevButton').addEventListener('click', function () {
        if (currentSeries > 0) {
            currentSeries--;
            showSeries(currentSeries);
        }
    });

    document.getElementById('nextButton').addEventListener('click', function () {
        if (currentSeries < totalSeries - 1) {
            currentSeries++;
            showSeries(currentSeries);
        }
    });

    // Initialize the first series
    showSeries(0);
</script>

<style>
    .photo-item {
        overflow: hidden;
        border-radius: 10px;
        transition: border 0.2s ease-in-out;
    }

    .photo-item img {
        transition: transform 0.3s ease-in-out;
    }

    .photo-item:hover img {
        transform: scale(1.05);
    }

    .photo-item img.border-4 {
        border: 4px solid #3b82f6;
    }

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
</style>