<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">

    {{-- @if ($this->success)
        <div class="mb-4 text-emerald-400">{{ $this->success }}</div>
    @elseif ($this->error)
        <div class="mb-4 text-red-400">{{ $this->error }}</div>
    @endif --}}


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

    <h3 class="mt-12 mb-6 text-2xl font-semibold text-gray-800 border-b pb-2">Existing Slides</h3>

    <div class="space-y-4">
        @foreach ($slides as $slide)
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between border rounded-md p-4 shadow-sm hover:shadow-md transition-shadow bg-gray-50">
                <div class="flex items-center mb-3 sm:mb-0">

                    <strong class="ml-3 text-lg text-gray-900">{{ $slide->title }}</strong>
                </div>
                <div class="flex space-x-3 justify-end">
                    <a class="px-4 py-2 text-sm bg-indigo-500 text-white rounded"
                        href="{{ route('cms.slides.edit-slide-form', ['slideID' => $slide->slideID]) }}">
                        Edit
                    </a>

                    <button wire:click="delete({{ $slide->slideID }})"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        class="px-4 py-2 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
