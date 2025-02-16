<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 py-12 lg:flex lg:space-x-8">
        <div class="w-full lg:w-1/2 text-white mb-8 lg:mb-0 flex flex-col justify-center">
            <h2 class="text-4xl mb-6">
                Contactez-nous !
            </h2>

            <div class="mb-6 flex items-start space-x-3">
                <div class="w-12 h-12 flex items-center justify-center 
               bg-infocus-redphoto/10
               rounded-md

               text-infocus-redphoto">
                    <i class="bx bx-home-alt bx-lg"></i>
                </div>
                <div>
                    <p class="font-semibold text-infocus-icewhite">Notre adresse</p>
                    <p class="text-gray-200">4 Rue du verger, Annecy</p>
                </div>
            </div>

            <div class="mb-6 flex items-start space-x-3">
                <div class="w-12 h-12 flex items-center justify-center 
               bg-infocus-redphoto/10
               rounded-md
               text-infocus-redphoto">
                    <i class="bx bx-phone-call bx-lg"></i>
                </div>
                <div>
                    <p class="font-semibold text-infocus-icewhite">Notre téléphone</p>
                    <p class="text-gray-200">+33 06 45 83 92 03</p>
                </div>
            </div>

            <div class="mb-6 flex items-start space-x-3">
                <div class="w-12 h-12 flex items-center justify-center 
               bg-infocus-redphoto/10
               rounded-md
               text-infocus-redphoto">
                    <i class="bx bx-envelope bx-lg"></i>
                </div>
                <div>
                    <p class="font-semibold text-infocus-icewhite">Notre email</p>
                    <p class="text-gray-200">contact.infocusfr@gmail.com</p>
                </div>
            </div>

        </div>

        <div class="w-full lg:w-1/2 bg-infocus-icewhite rounded-lg shadow-lg p-6">
            <form method="POST" action="{{ route('user.sendContact') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="nom" class="block text-gray-700 font-semibold">Nom</label>
                        <input type="text" id="nom" name="nom" class="mt-1 block w-full rounded-md border-gray-300"
                            placeholder="Votre nom" />
                    </div>
                    <div>
                        <label for="prenom" class="block text-gray-700 font-semibold">Prénom</label>
                        <input type="text" id="prenom" name="prenom"
                            class="mt-1 block w-full rounded-md border-gray-300" placeholder="Votre prénom" />
                    </div>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold">Adresse email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300"
                        placeholder="Votre email" />
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-semibold">
                        Votre message :
                    </label>
                    <textarea id="message" name="message" rows="5" class="mt-1 block w-full rounded-md border-gray-300"
                        placeholder="Votre description à ajouter (250 caractères maximum)"></textarea>
                    <p class="text-right text-sm text-gray-400">
                        0/250
                    </p>

                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-infocus-intenseblue text-white px-6 py-2 rounded-md 
                                       hover:bg-infocus-twilightblue transition-colors">
                        Envoyer ma demande
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>