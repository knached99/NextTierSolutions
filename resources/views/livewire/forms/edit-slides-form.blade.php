<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">

    @if (session()->has('success'))
        <div class="mb-6 text-green-600 font-medium text-center">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label for="title" class="block mb-2 font-semibold text-gray-700">Title</label>
            <input id="title" type="text" wire:model="title"
                class="w-full rounded-md border px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none
                @error('title') border-red-500 @enderror"
                placeholder="Enter slide title" />
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="subtitle" class="block mb-2 font-semibold text-gray-700">Subtitle</label>
            <input id="subtitle" type="text" wire:model="subtitle"
                class="w-full rounded-md border px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none
                @error('subtitle') border-red-500 @enderror"
                placeholder="Enter slide subtitle" />
            @error('subtitle')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 font-semibold text-gray-700">Description</label>
            <textarea id="description" wire:model="description" rows="4"
                class="w-full rounded-md border px-4 py-2 resize-none focus:ring-2 focus:ring-blue-400 focus:outline-none
                @error('description') border-red-500 @enderror"
                placeholder="Enter slide description"></textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
            Save Slide
        </button>
    </form>

</div>
