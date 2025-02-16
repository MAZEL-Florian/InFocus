<x-guest-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6">

            <div class="mx-auto max-w-screen-xl max-sm:py-16">
                <h1 class="mb-8 text-4xl font-semibold text-infocus-icewhite dark:text-white">FAQ</h1>
                <h2 class="mb-8 text-4xl font-semibold text-infocus-icewhite dark:text-white">Des questions ?
                    Nous sommes là pour t'aider !</h2>

                <div class="flex flex-col md:flex-row gap-6">
                    @foreach([0, 1] as $column)
                    <div class="flex-1 flex flex-col gap-6">
                        @foreach($faqs as $index => $faq)
                        @if($index % 2 == $column)
                        <div class="bg-infocus-icewhite infocus-shadow-box rounded-lg shadow-md p-4">
                            <div class="flex justify-between items-center cursor-pointer"
                                onclick="toggleParagraph('{{ $column }}-{{ $index }}')">
                                <h2 class="text-lg font-semibold">{{ $faq->question }}</h2>
                                <span id="arrow-{{ $column }}-{{ $index }}" class="transition-transform rotate-0">
                                    <svg class="w-4 h-4 text-gray-500 transition-all duration-300 transform rotate-0 peer-checked:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                            <div id="para-{{ $column }}-{{ $index }}"
                                class="mt-2 overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                                <p class="p-2">{{ $faq->answer }}</p>
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