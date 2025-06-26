<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    @if ($success)
        <div class="mb-4 text-emerald-500">{{ $success }}</div>
    @elseif ($error)
        <div class="mb-4 text-red-500">{{ $error }}</div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Select Region</label>
            <select wire:model="region" class="w-full p-2 border rounded">
                <option value="">-- Select --</option>
                @foreach ($availableRegions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('region')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Image upload visible all the time --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Upload Image</label>
            <input type="file" wire:model="image" class="w-full" />
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded" />
            @endif
        </div>

        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea wire:model.defer="content" class="w-full p-2 border rounded"></textarea>
            @error('content')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save Content
        </button>
    </form>
</div>

{{-- @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            let editorInstance;

            ClassicEditor
                .create(document.querySelector('#editor-container'))
                .then(editor => {
                    editorInstance = editor;

                    // Set initial data from Livewire property content
                    editor.setData(@this.get('content') ?? '');

                    // Update Livewire on editor changes
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    });

                    // Optional: if you want Livewire to update the editor content when "content" changes outside of editor,
                    // you can listen for Livewire events, but be careful not to override while typing.
                    Livewire.on('resetEditorContent', content => {
                        if (content !== editor.getData()) {
                            editor.setData(content || '');
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush --}}
