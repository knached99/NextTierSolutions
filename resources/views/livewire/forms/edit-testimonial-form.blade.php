<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Testimonial</h2>

    @if ($success)
        <div class="mb-6 bg-emerald-400 text-white rounded-sm p-3 font-medium text-center">
            {{ $success }}
        </div>
    @elseif($error)
        <div class="mb-6 bg-red-400 text-white rounded-sm p-3 font-medium text-center">
            {{ $error }}
        </div>
    @endif

    <form wire:submit.prevent="updateTestimonial" enctype="multipart/form-data" class="space-y-6">

        {{-- Name --}}
        <div>
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" wire:model.defer="name" class="w-full p-2 border rounded" />
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Position --}}
        <div>
            <label class="block font-semibold mb-1">Position</label>
            <input type="text" wire:model.defer="position" class="w-full p-2 border rounded" />
            @error('position')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Company Name --}}
        <div>
            <label class="block font-semibold mb-1">Company Name</label>
            <input type="text" wire:model.defer="company_name" class="w-full p-2 border rounded" />
            @error('company_name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Testimonial Content --}}
        <div>
            <label class="block font-semibold mb-1">Testimonial</label>
            <textarea wire:model.defer="testimonial_content" class="w-full p-2 border rounded" rows="4"></textarea>
            @error('testimonial_content')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submitter Picture --}}
        <div>
            <label class="block font-semibold mb-1">Submitter Picture</label>
            <div class="mb-2">
                @if ($new_submitter_picture)
                    <img src="{{ $new_submitter_picture->temporaryUrl() }}" alt="New Submitter Picture"
                        class="w-24 h-24 rounded-full object-cover" />
                @elseif ($testimonial_submitter_picture)
                    <img src="{{ Storage::url($testimonial_submitter_picture) }}" alt="Submitter Picture"
                        class="w-24 h-24 rounded-full object-cover" />
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-gray-600">No
                        Image</div>
                @endif
            </div>
            <input type="file" wire:model="new_submitter_picture" accept="image/jpeg,image/png,image/jpg" />
            @error('new_submitter_picture')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Company Logo --}}
        <div>
            <label class="block font-semibold mb-1">Company Logo</label>
            <div class="mb-2">
                @if ($new_company_logo)
                    <img src="{{ $new_company_logo->temporaryUrl() }}" alt="New Company Logo"
                        class="w-32 h-auto object-contain" />
                @elseif ($company_logo)
                    <img src="{{ Storage::url($company_logo) }}" alt="Company Logo"
                        class="w-32 h-auto object-contain" />
                @else
                    <div class="w-32 h-16 bg-gray-300 flex items-center justify-center text-gray-600">No Logo</div>
                @endif
            </div>
            <input type="file" wire:model="new_company_logo" accept="image/jpeg,image/png,image/jpg" />
            @error('new_company_logo')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update Testimonial
        </button>
    </form>
</div>
