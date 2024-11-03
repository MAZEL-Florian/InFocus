<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="../../img/hikari-night.png" width="78px" height="111px">
            <div class="text-infocus-icewhite overflow-hidden sm:rounded-lg p-6">
                <h1 class="text-4xl font-bold mb-10">Choix de la focale</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                
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
