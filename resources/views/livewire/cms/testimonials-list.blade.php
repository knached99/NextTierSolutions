<div class="p-6 bg-gray-100 rounded-lg">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Submitted Testimonials</h3>

    <a class="bg-slate-300 p-3 rounded hover:bg-black hover:text-white"
        href="{{ route('testimonial.submit-testimonial') }}">
        Write Testimonial
    </a>

    @if ($testimonials->isEmpty())
        <p class="text-gray-600 mb-5 mt-4">No testimonials have been submitted yet.</p>
    @else
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($testimonials as $testimonial)
                <a href="{{ url('/dashboard/testimonial/' . $testimonial->testimonialID . '/viewTestimonial') }}"
                    class="block">
                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all p-5 h-full flex flex-col">

                        {{-- Show submitter picture or placeholder --}}
                        <div class="mb-4 flex justify-center">
                            <img src="{{ $testimonial->testimonial_submitter_picture
                                ? Storage::url($testimonial->testimonial_submitter_picture)
                                : asset('assets/img/placeholders/user-placeholder.png') }}"
                                alt="{{ $testimonial->name }}" class="w-20 h-20 rounded-full object-cover" />
                        </div>

                        <h4 class="text-lg font-bold text-gray-800 mb-2 truncate text-center">
                            {{ $testimonial->name }}
                        </h4>

                        <p class="text-gray-700 text-sm line-clamp-4 mb-2 flex-grow">
                            "{{ Str::limit($testimonial->testimonial_content, 120) }}"
                        </p>

                        <div class="text-xs text-gray-500 text-center">
                            Submitted: {{ \Carbon\Carbon::parse($testimonial->created_at)->format('F jS, Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
