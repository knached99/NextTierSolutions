<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">

    @if (session('contentCreationSuccess'))
        <div class="mb-4 text-emerald-500">{{ session('contentCreationSuccess') }}</div>

        @if ($success)
            <div class="mb-6 bg-emerald-400 text-white rounded-sm p-3 font-medium text-center">
                {{ $success }}
            </div>
        @elseif($error)
            <div class="mb-6 bg-red-400 text-white rounded-sm p-3 font-medium text-center">
                {{ $error }}
            </div>
        @endif

        <form wire:submit.prevent="update" enctype="multipart/form-data">

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">Region (readonly)</label>
                <input type="text" class="w-full p-2 border rounded bg-gray-100" wire:model="region" readonly />
            </div>

            @if ($this->isImageRegion())
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Upload New Image</label>
                    <input type="file" wire:model="image" class="w-full" />
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded">
                    @elseif ($existingImage)
                        <img src="{{ Storage::url($existingImage) }}" class="mt-2 w-32 h-32 object-cover rounded">
                    @endif
                </div>
            @else
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Content</label>
                    <textarea wire:model.defer="content" class="w-full p-2 border rounded h-48"></textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update
                Content</button>
        </form>
</div>
