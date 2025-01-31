<x-simulation-layout :currentStep="$currentStep" :overlayTitle="$overlayTitle" :overlayDescription="$overlayDescription"
    :overlayButtonText="$overlayButtonText">
    <form action="{{ $postRoute }}" method="POST" id="unifiedStepForm">
        @csrf

        @foreach ($photosByGroups as $groupIndex => $photosByGroup)
        <input type="hidden" name="selectedPhotos[{{ $groupIndex }}]" id="selectedPhoto-{{ $groupIndex }}">
        @endforeach

        <div class="relative w-full">
            <div class="max-w-7xl mx-auto">
                <div id="slider"
                    class="flex overflow-x-scroll custom-scrollbar space-x-4 scroll-smooth snap-x snap-mandatory pb-6">
                    @foreach ($photosByGroups as $groupIndex => $photosByGroup)
                    <div id="series-{{ $groupIndex }}" class="series hidden w-auto flex-shrink-0 my-8">
                        <div class="flex gap-8 mx-7">
                            @foreach ($photosByGroup as $photo)
                            <div class="photo-item relative cursor-pointer"
                                id="photoItem-{{ $groupIndex }}-{{ $photo->id }}" style="width: 900px; height: 600px;"
                                onclick="selectPhoto({{ $photo->id }}, {{ $groupIndex }})">

                                <img src="{{ asset('storage/' . $photo->image_url) }}" alt="Photo {{ $photo->id }}"
                                    id="photo-{{ $groupIndex }}-{{ $photo->id }}" class="w-full h-full object-cover rounded-lg
                                                    transition-opacity duration-300 ease-in-out">

                                <div id="checkIcon-{{ $groupIndex }}-{{ $photo->id }}"
                                    class="hidden absolute top-2 right-2 bg-white p-1 rounded-full shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto flex justify-between items-center mt-6 px-4">
            <button type="button" id="prevButton" class="text-white border border-white py-2 px-4 rounded transition"
                disabled>
                Précédent
            </button>
            <button type="button" id="nextButton"
                class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium transition">
                Suivant
            </button>
        </div>
    </form>

    @push('scripts')
    <script src="{{ asset('js/simulation-step.js') }}"></script>
    <script>
        const circleOffset  = {{ $circleOffset }};
    const totalSeries   = {{ count($photosByGroups) }};

    const forcedCircles = @json($forceCircles);

        setupStep(
            totalSeries,
            circleOffset,
            '{{ $formId ?? "unifiedStepForm" }}',
        );
        document.addEventListener('DOMContentLoaded', () => {
        forcedCircles.forEach(idx => {
            document.getElementById(`circle-${idx}`)?.classList.add('active');
        });
    });
    </script>
    @endpush

</x-simulation-layout>