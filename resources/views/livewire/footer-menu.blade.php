<!-- Footer -->
<footer class="text-center text-lg-start bg-infocus-anthracitegrey text-white mt-auto">
    <div class="container mx-auto">
        <section class="p-1 border-b border-infocus-icewhite border-opacity-10">
            <!-- Left -->
            <div class="flex items-start">
                <a href="{{ route('home.index') }}"><img src="{{ asset('img/Logo blanc couleur.png') }}" class="w-24"></a>
            </div>
            
            
        </section>
        
        
        <!-- Section: Links  -->
        <section class="border-b border-infocus-icewhite border-opacity-10">
            <div class="text-center md:text-left mt-5">
                <!-- Grid row -->
                <div class="flex flex-wrap justify-center mt-3">
                    <!-- Grid column -->
                    <div class="w-full md:w-1/4 lg:w-1/5 xl:w-1/6 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-4xl font-medium mb-4"> InFocus
                        </h6>
                        <p>
                            <a href="{{ route('home.index') }}" class="text-reset no-underline">Home</a>
                        </p>
                        <p>
                            <a href="{{ route('pack.index') }}" class="text-reset no-underline">Nos packs</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset no-underline">Notre matériel</a>
                        </p>
                    </div>

                    <div class="w-full md:w-1/4 lg:w-1/5 xl:w-1/6 mx-auto mb-4">
                        <h6 class="font-medium text-4xl mb-4">
                            Ressources
                        </h6>
                        <p>
                            <a href="{{ route('blog.index') }}" class="text-reset no-underline">Blog</a>
                        </p>
                        <p>
                            <a href="{{ route('faq.index') }}" class="text-reset no-underline">FAQ</a>
                        </p>
                    </div>

                    <div class="w-full md:w-1/4 lg:w-1/5 xl:w-1/6 mx-auto mb-4 space-y-3">
                        <!-- Links -->
                        <h6 class="font-medium text-4xl mb-4">
                            Contacts
                        </h6>
                        <p>
                            <i class='bx bxs-home text-white text-base'></i> 14 Avenue du Rhône, Annecy
                        </p>
                        <p>
                            <i class='bx bxs-phone text-white text-base'></i> +33 12 12 12 12
                        </p>
                        <p>
                            <i class='bx bxs-envelope text-white text-base'></i> contact.infocusfr@gmail.com
                        </p>
                        <p>
                            <a href="{{ route('user.contact') }}" class="infocus-btn-primary text-infocus-twilightblue py-2 px-4 rounded font-medium">Nous contacter</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="w-full md:w-1/2 lg:w-2/5 xl:w-1/3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="font-medium mb-4">Inscris-toi à notre Newsletter</h6>
                        <p>Recevez notre newsletter mensuelle pour obtenir des conseils utiles sur la photographie </p>
                        <p>
                        <form class="flex py-3">
                            <div class="relative w-full">

                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                        </path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                </div>
                                <input
                                    class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Votre adresse mail" type="email" id="email" required="">
                            </div>
                            <div>
                                <button type="submit"
                                    class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">S'inscrire</button>
                            </div>
                        </form>
                        </p>
                        <!-- RESEAUX SOCIAUX -->
                        <h6 class="font-medium mb-4">Réseaux sociaux</h6>

                        <a class="me-2 no-underline" href="#">
                            <i class="bx bxl-youtube border rounded-full bg-white text-gray-700"
                                style="font-size: 1.5em;"></i>
                        </a>
                        <a class="me-2 no-underline" href="#">
                            <i class="bx bxl-facebook border rounded-full bg-white text-gray-700"
                                style="font-size: 1.5em;"></i>
                        </a>
                        <a class="me-2 no-underline" href="#">
                            <i class="bx bxl-instagram border rounded-full bg-white text-gray-700"
                                style="font-size: 1.5em;"></i>
                        </a>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <section class="py-5">
            <div class="container-xxl flex flex-wrap justify-between py-2 md:flex-row flex-col">
                <div class="mb-2 md:mb-0">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    All rights reserved.
                    <a href="#" class="px-10">Mentions légales</a>
                    <a href="{{ route('policy.show') }}" class="px-10">Politique de confidentialité</a>
                    <a href="#" class="px-10">CGV</a>
                    <a href="#" class="px-10">CGU</a>
                </div>
            </div>
        </section>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->