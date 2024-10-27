<x-app-layout>
    <div class="py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="../img/hikari-night.png" width="78px" height="111px" class="mb-6">
            <h1 class="text-infocus-icewhite text-4xl font-bold mb-10">Commencez par choisir votre style de photographie</h1>
            
            <form action="{{ route('simulation.store') }}" method="POST">
                @csrf
                <input type="hidden" id="selectedPhotoTypeId" name="photo_type_id">

                @if($photoTypes->isNotEmpty())
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-center">
                    @foreach($photoTypes as $photoType)
                    <li class="flex justify-center">
                        <div class="relative group w-48">
                            <a href="#" onclick="selectPhotoType({{ $photoType->id }}); return false;">
                                <img src="{{ asset('storage/'.$photoType->image_url) }}" alt="{{ $photoType->name }}"
                                    class="object-contain h-48 w-48 rounded-lg object-cover object-center transition duration-500 ease-in-out transform brightness-75 group-hover:brightness-50" />
                            </a>
                            <div class="bg-grey-800 bg-opacity-30 absolute inset-0 flex items-end justify-start p-6 pointer-events-none">
                                <h3 class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white">
                                    {{ $photoType->name }}
                                </h3>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
                <button type="submit" class="mt-4">Valider</button>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    function selectPhotoType(photoTypeId) {
        document.getElementById('selectedPhotoTypeId').value = photoTypeId;
    }
</script>
