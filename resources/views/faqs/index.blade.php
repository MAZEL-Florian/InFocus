<x-guest-layout>
    @livewire('navigation-menu')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our packs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                        <h2 class="mb-8 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ __('Frequently asked questions') }}</h2>
                        <div class="grid pt-8 text-left border-t border-gray-200 md:gap-16 dark:border-gray-700 md:grid-cols-2">
                            <div>
                                @foreach($faqs as $faq)
                                <div class="mb-10">
                                    <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                                        <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                        {{ $faq->question }}
                                    </h3>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $faq->answer }}</p>
                                </div>
                                @endforeach
                               
                            </div>
                        </div>
                    </div>
                  </section>


               



                

            </div>
        </div>
    </div>
    @livewire('footer-menu')
</x-guest-layout>
