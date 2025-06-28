<x-main-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">

        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="mt-8 inline-flex items-center text-xl text-blue-600 hover:underline">
                ← Back
            </a>
        </div>

        <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex space-x-1">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li>/</li>
                @if (url()->previous() && url()->previous() !== url()->current())
                    <li>
                        <a href="{{ url()->previous() }}" class="hover:underline">
                            Back
                        </a>
                    </li>
                    <li>/</li>
                @endif
                <li class="text-gray-700">{{ \Illuminate\Support\Str::limit($article->title, 100) }}</li>
            </ol>
        </nav>

        <h1 class="text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
            {{ $article->title }}
        </h1>

        <div class="text-sm text-gray-500 mb-8">
            <span>Published on {{ $article->created_at->format('F j, Y') }}</span>
            <span class="mx-2">·</span>
            <span>{{ config('app.name') }}</span>
        </div>

        @if ($article->article_post_image_path)
            <div class="mb-8 overflow-hidden rounded-lg shadow-md">
                <img src="{{ $article->article_post_image_path
                    ? Storage::url($article->article_post_image_path)
                    : asset('assets/img/placeholders/placeholder.jpg') }}"
                    alt="{{ $article->title }}"
                    class="w-full h-auto max-h-[450px] object-cover transition-transform duration-300 hover:scale-105">
            </div>
        @endif

        <div class="prose prose-lg max-w-none text-gray-800">
            {!! $article->content !!}
        </div>
    </div>
</x-main-layout>
