<x-guest-layout>
    <section class="py-16">
        <div class="container mx-auto">
            <h2 class="text-4xl font-semibold mb-10 text-infocus-icewhite text-center">
                Nos articles
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                <article class="text-infocus-icewhite overflow-hidden">
                    <div class="relative">
                        <img src="/img/blog1.jpg" alt="Image article de blog" class="rounded">
                    </div>
                    <div class="py-5">
                        <span class="bottom-2 left-2 bg-infocus-icewhite text-black text-xs font-medium
                    py-1 px-2 rounded">
                            22 février 2024
                        </span>
                        <h3 class="text-lg font-semibold mb-2">
                            Quels sont les meilleurs boîtiers pour les débutants&nbsp;?
                        </h3>
                        <p class="text-sm mb-4">
                            Lorem ipsum is simply dummy text of the printing and typesetting industry…
                        </p>
                        <a href="{{ route('blog.index') }}" class="text-sm font-medium hover:underline">
                            Voir plus
                        </a>
                    </div>
                </article>

                <article class="text-infocus-icewhite overflow-hidden">
                    <div class="relative">
                        <img src="/img/blog2.jpg" alt="Image article de blog" class="rounded">

                    </div>
                    <div class="py-5">
                        <span class="bottom-2 left-2 bg-infocus-icewhite text-black text-xs font-medium
                    py-1 px-2 rounded">
                            04 juin 2024
                        </span>
                        <h3 class="text-lg font-semibold mb-2">
                            10 Astuces pour Réussir ses Premières Photos
                        </h3>
                        <p class="text-sm mb-4">
                            Lorem ipsum is simply dummy text of the printing and typesetting industry…
                        </p>
                        <a href="{{ route('blog.index') }}" class="text-sm font-medium hover:underline">
                            Voir plus
                        </a>
                    </div>
                </article>

                <article class="text-infocus-icewhite overflow-hidden">
                    <div class="relative">
                        <img src="/img/blog3.jpg" class="rounded" alt="Image article de blog">
                    </div>
                    <div class="py-5">
                        <span class="bottom-2 left-2 bg-infocus-icewhite text-black text-xs font-medium
                    py-1 px-2 rounded">
                            12 novembre 2024
                        </span>
                        <h3 class="text-lg font-semibold mb-2">
                            Les Bases de la Photographie&nbsp;: Guide Complet
                        </h3>
                        <p class="text-sm mb-4">
                            Lorem ipsum is simply dummy text of the printing and typesetting industry…
                        </p>
                        <a href="{{ route('blog.index') }}" class="text-sm font-medium hover:underline">
                            Voir plus
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
</x-guest-layout>