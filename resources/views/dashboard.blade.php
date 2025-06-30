<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <livewire:cms.cms-content-cards />
                </div>
                <hr class="border-t-2 border-indigo-300 my-6" />
                <div class="mx-w-7xl mx-auto sm:px-6 lg:px-8">
                    <livewire:cms.testimonials-list />
                </div>

                <hr class="border-t-2 border-indigo-300 my-6" />

                <div class="mx-w-7xl mx-auto sm:px-6 lg:px-8">
                    <livewire:cms.articles-list />
                </div>
            </div>
        </div>
</x-app-layout>
