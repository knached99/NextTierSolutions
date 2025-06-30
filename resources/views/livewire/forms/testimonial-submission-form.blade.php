<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    @if ($success)
        <div class="mb-6 bg-emerald-400 text-white rounded-sm p-3 font-medium text-center">
            {{ $success }}
        </div>
    @elseif($error)
        <div class="mb-6 bg-red-400 text-white rounded-sm p-3 font-medium text-center">
            {{ $error }}
        </div>
    @endif

    <form wire:submit.prevent="submitTestimonial" enctype="multipart/form-data">
        <p class="text-center text-lg mb-6 font-medium text-gray-800"> Use the form below to submit a testimonial on
            behalf of a client or partner. Please include the individual’s name, position, and company details, along
            with their photo and company logo if available.
            Once submitted, the testimonial will be added to the website.</p>

        <!-- Name -->
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Name</label>
            <input type="text" wire:model.defer="name" class="w-full p-2 border rounded" />
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Position -->
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Position</label>
            <input type="text" wire:model.defer="position" class="w-full p-2 border rounded" />
            @error('position')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Company Name -->
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Company Name</label>
            <input type="text" wire:model.defer="company_name" class="w-full p-2 border rounded" />
            @error('company_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Testimonial Content -->
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Testimonial</label>
            <textarea wire:model.defer="testimonial_content" class="w-full p-2 border rounded">
            </textarea>
            @error('testimonial_content')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submitter Picture -->
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Submitter Picture (JPG, JPEG, PNG)</label>
            <input type="file" wire:model="testimonial_submitter_picture" accept="image/jpeg,image/png"
                class="w-full" />
            @error('testimonial_submitter_picture')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @if ($testimonial_submitter_picture)
                <img src="{{ $testimonial_submitter_picture->temporaryUrl() }}"
                    class="mt-2 w-32 h-32 object-cover rounded" />
            @endif
        </div>

        <!-- Company Logo -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Company Logo (JPG, JPEG, PNG)</label>
            <input type="file" wire:model="company_logo" accept="image/jpeg,image/png" class="w-full" />
            @error('company_logo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @if ($company_logo)
                <img src="{{ $company_logo->temporaryUrl() }}"
                    class="mt-2 w-32 h-32 object-contain bg-gray-100 p-2 rounded" />
            @endif
        </div>

        <!-- Determine if testimonial will be shown or hidden -->
        <div x-data="{ isPublic: false }" class="mb-6">
            <span class=" text-gray-500">By default, this testimonial will be hidden, you must check the box to
                make it
                public</span>
            <label class="inline-flex items-center space-x-2 mt-5">
                <input type="checkbox" x-model="isPublic" wire:model.defer="is_public"
                    class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out">
                <span class="text-gray-700 font-medium">Toggle Testimonial Visibility</span>
            </label>

            <div class="mt-2 text-sm text-gray-600" x-show="isPublic" x-transition>
                <i class="bi bi-eye h-20 w-20"></i> This testimonial will be <span
                    class="font-semibold text-green-600">public</span>.
            </div>
            <div class="mt-2 text-sm text-gray-600" x-show="!isPublic" x-transition>
                <i class="bi bi-eye-slash h-20 w-20"></i> This testimonial will remain <span
                    class="font-semibold text-red-600">hidden</span>.
            </div>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 w-full">
            Submit Testimonial
        </button>
    </form>
</div>
