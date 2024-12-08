<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="../../img/hikari-right.png" width="78px" height="111px">
            <div class="text-infocus-icewhite overflow-hidden sm:rounded-lg p-6">
                <h1 class="text-4xl font-bold mb-10">Choix de la colorimétrie</h1>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('simulation.post-step-one', ['simulation' => $simulation]) }}" method="POST">
                    @csrf

                    <div class="flex justify-center mb-6 space-x-2">
                        @foreach ($photosByGroups as $groupIndex => $photosByGroup)
                        <button type="button" class="stepper-dot w-4 h-4 rounded-full"
                            id="stepper-dot-{{ $groupIndex }}" onclick="goToSlide({{ $groupIndex }})"
                            :class="currentSlide === {{ $groupIndex }} ? 'bg-infocus-oceanblue' : 'bg-gray-400'">
                        </button>
                        @endforeach
                    </div>

                    <div id="photo-carousel" class="relative">
                        <div class="overflow-hidden relative">
                            @foreach ($photosByGroups as $groupIndex => $photosByGroup)
                            <div class="carousel-slide flex justify-center gap-4" id="slide-{{ $groupIndex }}">
                                @foreach ($photosByGroup as $photo)
                                <div class="group relative">
                                    <a href="#"
                                        onclick="selectPhotoType({{ $photo->id }}, {{ $groupIndex }}); return false;">
                                        <img src="{{ asset('storage/' . $photo->image_url) }}"
                                            id="photo-{{ $groupIndex }}-{{ $photo->id }}"
                                            class="object-contain h-72 w-72 rounded-lg object-cover object-center transition duration-500 ease-in-out transform brightness-75 group-hover:brightness-50" />
                                    </a>
                                    <p id="selected-text-{{ $groupIndex }}"
                                        class="absolute top-0 left-0 p-2 text-white bg-blue-500 rounded hidden">
                                        Sélectionnée</p>
                                </div>
                                @endforeach
                                <input type="hidden" name="selectedPhotos[{{ $groupIndex }}]"
                                    id="selectedPhotoTypeId-{{ $groupIndex }}">
                            </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center mt-6">
                            <button type="button" onclick="prevSlide()"
                                class="border-solid border border-infocus-oceanblue text-infocus-oceanblue py-2 px-4 rounded">
                                Précédent
                            </button>
                            <button type="submit" id="next-button" disabled
                                class="bg-infocus-intenseblue text-white py-2 px-4 rounded disabled:opacity-50 disabled:cursor-not-allowed">
                                Suivant
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let currentSlide = 0;
    const totalSlides = {{ count($photosByGroups) }};
    function checkCompletion() {
        const completed = [...Array(totalSlides).keys()].every(groupIndex => {
            const selectedPhoto = document.getElementById('selectedPhotoTypeId-' + groupIndex).value;
            return selectedPhoto !== '';
        });

        const nextButton = document.getElementById('next-button');
        if (completed) {
            nextButton.disabled = false;
        } else {
            nextButton.disabled = true;
        }
    }

    function selectPhotoType(photoId, groupIndex) {
        document.getElementById('selectedPhotoTypeId-' + groupIndex).value = photoId;

        document.querySelectorAll('[id^="photo-' + groupIndex + '-"]').forEach(photoElement => {
            photoElement.classList.remove('border-4', 'border-blue-500');
        });

        document.getElementById('photo-' + groupIndex + '-' + photoId).classList.add('border-4', 'border-blue-500');

        document.getElementById('selected-text-' + groupIndex).classList.remove('hidden');

        checkCompletion();
    }

    showSlide(0);
    checkCompletion();


    function showSlide(index) {
        document.querySelectorAll('.carousel-slide').forEach((slide, slideIndex) => {
            slide.style.display = slideIndex === index ? 'flex' : 'none';
        });
        updateStepper(index);
        currentSlide = index;
    }

    function updateStepper(index) {
        document.querySelectorAll('.stepper-dot').forEach((dot, dotIndex) => {
            dot.classList.remove('bg-infocus-oceanblue', 'bg-gray-400');
            dot.classList.add(dotIndex === index ? 'bg-infocus-oceanblue' : 'bg-gray-400');
        });
    }

    function prevSlide() {
        if (currentSlide > 0) {
            showSlide(currentSlide - 1);
        }
    }

    function nextSlide() {
        if (currentSlide < totalSlides - 1) {
            showSlide(currentSlide + 1);
        }
    }

    function goToSlide(index) {
        showSlide(index);
    }

    showSlide(0);
</script>