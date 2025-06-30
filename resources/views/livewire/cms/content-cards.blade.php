<div class="p-6 bg-gray-100 rounded-lg">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">All CMS Content</h3>

    <a class="bg-slate-300 p-2 mt-6 rounded hover:bg-black hover:text-white"
        href="{{ route('cms.content.createContent') }}">Add
        Content</a>

    @if ($contentItems->isEmpty())
        <p class="text-gray-600 mb-5 mt-4">No content has been added yet</p>
    @else
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($contentItems as $item)
                <a href="{{ route('cms.content.editContent', ['contentID' => $item->contentID]) }}" class="block">
                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all p-5 h-full">
                        <h4 class="text-lg font-bold text-gray-800 mb-3 capitalize truncate">
                            {{ str_replace('_', ' ', $item->region) }}
                        </h4>

                        @if (in_array($item->region, ['hero_background', 'why_us_image', 'cta_background_image']))
                            <div class="w-full aspect-video overflow-hidden rounded mb-3">
                                <img src="{{ Storage::url($item->content) }}" alt="CMS Image"
                                    class="object-cover w-full h-full transition-transform duration-300 hover:scale-105" />
                            </div>
                        @else
                            <p class="text-gray-700 text-sm line-clamp-4">
                                {{ $item->content }}
                            </p>
                        @endif

                        <div class="mt-4 text-xs text-gray-500">
                            Added: {{ $item->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
