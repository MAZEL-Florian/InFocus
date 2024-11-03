<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="../../img/hikari-night.png" width="78px" height="111px">
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
                    @foreach ($photosByGroups as $groupIndex => $photosByGroup)
                        <div class="flex flex-wrap gap-4 mb-8 justify-center">
                            @foreach ($photosByGroup as $photo)
                                <div class="group relative">
                                    <a href="#" onclick="selectPhotoType({{ $photo->id }}, {{ $groupIndex }}); return false;">
                                        <img src="{{ asset('storage/'.$photo->image_url) }}"
                                             id="photo-{{ $groupIndex }}-{{ $photo->id }}"
                                             class="object-contain h-72 w-72 rounded-lg object-cover object-center transition duration-500 ease-in-out transform brightness-75 group-hover:brightness-50" />
                                    </a>
                                    <p id="selected-text-{{ $groupIndex }}" class="absolute top-0 left-0 p-2 text-white bg-blue-500 rounded hidden">Sélectionnée</p>
                                </div>
                            @endforeach
                            <!-- Champ caché pour stocker l'ID de la photo sélectionnée pour chaque groupe -->
                            <input type="hidden" name="selectedPhotos[{{ $groupIndex }}]" id="selectedPhotoTypeId-{{ $groupIndex }}">
                        </div>
                    @endforeach

                    <div class="flex justify-evenly mt-10">
                        <button type="button" onclick="window.location='{{ route('home.index') }}'"    
                                class="border-solid border border-infocus-oceanblue text-infocus-oceanblue py-2 px-4 rounded">
                            Précédent
                        </button>
                        <button type="submit"
                                class="bg-infocus-intenseblue text-white py-2 px-4 rounded">
                            Suivant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function selectPhotoType(photoId, groupIndex) {
        // Mettre à jour l'ID de la photo sélectionnée dans le champ caché
        document.getElementById('selectedPhotoTypeId-' + groupIndex).value = photoId;

        // Retirer la sélection visuelle des autres photos dans le groupe
        document.querySelectorAll('[id^="photo-' + groupIndex + '-"]').forEach(photoElement => {
            photoElement.classList.remove('border-4', 'border-blue-500');
        });

        // Ajouter un indicateur visuel pour la photo sélectionnée
        document.getElementById('photo-' + groupIndex + '-' + photoId).classList.add('border-4', 'border-blue-500');

        // Afficher le texte de sélection
        document.getElementById('selected-text-' + groupIndex).classList.remove('hidden');
    }
</script>
