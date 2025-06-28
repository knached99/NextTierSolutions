<div class="p-6 bg-gray-100 rounded-lg">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Published Articles</h3>

    <a class="bg-slate-300 p-3 rounded hover:bg-black hover:text-white transition"
        href="{{ route('article.create-article') }}">
        Write Article
    </a>

    @if ($articles->isEmpty())
        <p class="text-gray-600 mb-5 mt-4">No articles have been published yet.</p>
    @else
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 overflow-auto">
            @foreach ($articles as $article)
                <a href="#" class="block">
                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all p-5 h-full flex flex-col">

                        {{-- Show post image or placeholder --}}
                        <div class="mb-4 w-full aspect-video overflow-hidden rounded">
                            <img src="{{ $article->article_post_image_path
                                ? Storage::url($article->article_post_image_path)
                                : asset('assets/img/placeholders/placeholder.png') }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover transition-transform hover:scale-105" />
                        </div>

                        <h4 class="text-lg font-bold text-gray-800 mb-2 truncate">
                            {{ $article->title }}
                        </h4>

                        <p class="text-gray-700 text-sm line-clamp-3 mb-2 flex-grow">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>

                        <div class="text-xs text-gray-500">
                            Published: {{ \Carbon\Carbon::parse($article->created_at)->format('F jS, Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
