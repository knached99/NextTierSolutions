<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    @if ($success)
        <div class="mb-4 text-green-600 font-semibold">{{ $success }}</div>
    @endif
    @if ($error)
        <div class="mb-4 text-red-600 font-semibold">{{ $error }}</div>
    @endif

    <form wire:submit.prevent="submitArticle">
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Article Image</label>
            <input type="file" wire:model="post_image" class="mt-1 block w-full" accept="image/*">
            @error('post_image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @if ($post_image)
                <img src="{{ $post_image->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded" />
            @endif
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Title</label>
            <input type="text" wire:model="post_title"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />

            @error('post_title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            @if ($slug)
                <p class="mt-2 text-sm text-gray-500">
                    <span class="font-semibold">Slug:</span> {{ $slug }}
                </p>
            @endif
        </div>

        <div class="mb-4" wire:ignore>
            <label class="block font-medium text-gray-700">Content</label>
            <textarea id="post_content" wire:model="post_content" class="ckeditor mt-1 block w-full h-40">{{ $post_content }}</textarea>
            @error('post_content')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Submit</button>
    </form>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:load', () => {
            ClassicEditor
                .create(document.querySelector('#post_content'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('post_content', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush
