<x-guest-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6">

            <div class="mx-auto max-w-screen-xl max-sm:py-16">
                <h1 class="mb-8 text-lg text-infocus-icewhite dark:text-white">FAQ</h1>
                <h2
                    class="mb-8 text-5xl font-semibold text-infocus-icewhite dark:text-white lg:max-w-[30vw] md:max-w-[50vw]">
                    Des questions ? Nous sommes là pour t'aider !
                </h2>

                <div class="flex flex-col md:flex-row gap-6">
                    @foreach([0, 1] as $column)
                    <div class="flex-1 flex flex-col gap-6">
                        @foreach($faqs as $index => $faq)
                        @if($index % 2 == $column)
                        <div class="bg-infocus-icewhite infocus-shadow-box rounded-lg shadow-md p-4 relative">
                            @if($index == 1)
                            <img src="/img/hikari_left_question.png" alt="Chouette InFocus"
                                class="absolute -top-36 left-[92.5%] transform -translate-x-1/2 w-48 h-48 z-0 hidden md:block" />

                            @endif

                            <div class="flex items-center gap-2 cursor-pointer"
                                onclick="toggleParagraph('{{ $column }}-{{ $index }}')">
                                <span id="arrow-{{ $column }}-{{ $index }}" class="transition-transform rotate-0 inline-flex items-center justify-center
                                        w-8 h-8 rounded-lg bg-infocus-intenseblue text-infocus-icewhite
                                        transition-all duration-300 transform">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>

                                <h2 class="text-lg font-semibold">
                                    {{ $faq->question }}
                                </h2>
                            </div>


                            <div id="para-{{ $column }}-{{ $index }}"
                                class="mt-2 overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                                <p class="p-2 text-gray-500">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    function toggleParagraph(id) {
        const para = document.getElementById(`para-${id}`);
        const arrow = document.getElementById(`arrow-${id}`);
        if (para.classList.contains('max-h-0')) {
            para.classList.remove('max-h-0', 'opacity-0');
            para.classList.add('max-h-screen', 'opacity-100');
            arrow.classList.remove('rotate-0');
            arrow.classList.add('rotate-180');
        } else {
            para.classList.add('max-h-0', 'opacity-0');
            para.classList.remove('max-h-screen', 'opacity-100');
            arrow.classList.add('rotate-0');
            arrow.classList.remove('rotate-180');
        }
    }
</script>