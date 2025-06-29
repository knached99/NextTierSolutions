<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

    @if ($success)
        <div class="mb-6 bg-emerald-400 text-white rounded-sm p-3 font-medium text-center">
            {{ $success }}
        </div>
    @elseif($error)
        <div class="mb-6 bg-red-400 text-white rounded-sm p-3 font-medium text-center">
            {{ $error }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-8 space-y-4">

        <div>

            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" wire:model.defer="title" class="w-full p-2 border rounded" />
            @error('title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea wire:model.defer="description" class="w-full p-2 border rounded"></textarea>
            @error('description')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div x-data="iconDropdown(@entangle('icon_class'))" x-init="fetchIcons()" class="relative w-full mb-4">
            <!-- Dropdown Trigger Button -->
            <button type="button" @click="open = !open"
                :class="open ? 'bg-slate-100 text-black' : 'bg-white text-gray-800'"
                class="w-full px-4 py-3 rounded-md flex items-center justify-between shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span class="flex items-center space-x-3">
                    <i :class="'bi ' + selected" class="text-lg"></i>
                    <span x-text="selected ? formatLabel(selected) : 'Choose an icon'" class="font-medium"></span>
                </span>
                <i class="bi bi-chevron-down text-lg"></i>
            </button>

            <!-- Dropdown List -->
            <div x-show="open" x-transition x-cloak
                class="absolute z-20 mt-1 w-full bg-white rounded-md shadow-lg overflow-hidden border border-gray-200"
                style="max-height: 300px;">

                <!-- Search Input -->
                <input type="text" x-model="search" placeholder="Search icons..."
                    class="w-full px-4 py-2 border-b border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                <!-- Scrollable Icons List -->
                <ul style="max-height: 250px; overflow-y: auto; display: block;" class="divide-y divide-gray-100">
                    <!-- Skeleton Loader -->
                    <template x-if="loading">
                        <template x-for="i in 6" :key="i">
                            <li class="px-4 py-3 animate-pulse flex space-x-4 items-center">
                                <div class="w-6 h-6 bg-gray-300 rounded"></div>
                                <div class="h-4 bg-gray-300 rounded flex-1"></div>
                            </li>
                        </template>
                    </template>

                    <!-- Filtered Icons List -->
                    <template x-for="icon in filteredIcons()" :key="icon">
                        <li @click="select(icon)"
                            class="cursor-pointer px-4 py-3 flex items-center space-x-3 transition-colors duration-150 rounded-md"
                            :class="{
                                'bg-slate-200': icon === selected,
                                'hover:bg-slate-200': icon !== selected
                            }">
                            <i :class="'bi ' + icon" class="text-lg"></i>
                            <span x-text="formatLabel(icon)" class="select-none"></span>
                        </li>
                    </template>

                    <!-- No results -->
                    <template x-if="!loading && filteredIcons().length === 0">
                        <li class="px-4 py-3 text-center text-gray-500 italic select-none">
                            No icons found.
                        </li>
                    </template>
                </ul>
            </div>
            @error('icon_class')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>




        <div>
            <label class="block mb-1 font-semibold">Icon Color (HEX)</label>
            <input type="color" wire:model.defer="icon_color" class="w-20 h-10 p-1 border rounded" />
            @error('icon_color')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>


        <div>
            <label class="block mb-1 font-semibold">Order</label>
            <input type="number" wire:model.defer="order" class="w-full p-2 border rounded" />
            @error('order')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            {{ $serviceId ? 'Update Service' : 'Add Service' }}
        </button>

        @if ($serviceId)
            <button type="button" wire:click="resetForm"
                class="ml-4 px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancel
            </button>
        @endif

    </form>

    <h3 class="text-xl font-semibold mb-4">Existing Services</h3>

    <div class="space-y-4 overflow-y-scroll">
        @foreach ($services as $service)
            <div class="flex items-center justify-between border p-3 rounded">
                <div>
                    <i class="{{ $service->icon_class }}" style="color: {{ $service->icon_color }};"></i>
                    <strong class="ml-2">{{ $service->title }}</strong>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('cms.service.edit-service', ['serviceID' => $service->serviceID]) }}"
                        class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    {{-- <button wire:click="edit({{ $service->serviceID }})"
                        class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button> --}}
                    <button wire:click="delete({{ $service->serviceID }})"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
@push('scripts')
    {{-- <script>
        window.iconDropdown = function(entangledModel) {
            return {
                open: false,
                selected: entangledModel,
                icons: [],
                loading: true,

                async fetchIcons() {
                    try {
                        const res = await fetch("{{ route('icons.json') }}");
                        const data = await res.json();
                        this.icons = data;
                    } catch (e) {
                        console.error("Failed to load icons:", e);
                        this.icons = [];
                    } finally {
                        this.loading = false;
                    }
                },

                select(icon) {
                    this.selected = icon;
                    this.open = false;
                },

                formatLabel(icon) {
                    return icon.replace('bi-', '').replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                }
            };
        }
    </script> --}}

    <script>
        window.iconDropdown = function(entangledModel) {
            return {
                open: false,
                selected: entangledModel,
                icons: [],
                loading: true,
                search: '',

                async fetchIcons() {
                    try {
                        const res = await fetch("{{ route('icons.json') }}");
                        const data = await res.json();
                        this.icons = data;
                    } catch (e) {
                        console.error("Failed to load icons:", e);
                        this.icons = [];
                    } finally {
                        this.loading = false;
                    }
                },

                select(icon) {
                    this.selected = icon;
                    this.open = false;
                    this.search = ''; // reset search after select
                },

                formatLabel(icon) {
                    return icon.replace('bi-', '').replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                },

                filteredIcons() {
                    if (!this.search) return this.icons;
                    return this.icons.filter(icon =>
                        this.formatLabel(icon).toLowerCase().includes(this.search.toLowerCase())
                    );
                }
            };
        }
    </script>
@endpush
