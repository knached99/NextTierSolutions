<x-main-layout>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        {!! !empty($cmsContent['hero_background']->content)
            ? '<img src="' . asset('storage/' . $cmsContent['hero_background']->content) . '" alt="Hero Background" />'
            : '' !!}

        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <h1 data-aos="fade-up">
                        {{ $cmsContent['hero_title']['content'] ?? '' }}
                    </h1>
                    <blockquote data-aos="fade-up" data-aos-delay="100">
                        <p>{{ $cmsContent['hero_description']['content'] ?? '' }}</p>
                    </blockquote>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">

        <div class="container">

            <div class="row g-0">

                <div class="col-xl-5 img-bg" data-aos="fade-up" data-aos-delay="100">
                    {!! !empty($cmsContent['why_us_image']->content)
                        ? '<img src="' . asset('storage/' . $cmsContent['why_us_image']->content) . '" alt="Why Us" />'
                        : '' !!}




                </div>

                <div class="col-xl-7 slides position-relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper init-swiper">

                        <div class="swiper-wrapper">
                            @foreach ($slides as $slide)
                                <div class="swiper-slide m-3">
                                    <div class="item">
                                        <h3 class="mb-3">{{ $slide['title'] }}</h3>
                                        <h4 class="mb-3">{{ $slide['subtitle'] }}</h4>
                                        <p>{{ $slide['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>


                </div>

            </div>

    </section><!-- /Why Us Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up" data-aos-delay="200">
            <h2>
                {{ $cmsContent['our_services_title']['content'] ?? '' }}

            </h2>
            <p>{{ $cmsContent['our_services_description']['content'] ?? '' }}
            </p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4 overflow-auto">

                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon flex-shrink-0"><i class="bi {{ $service->icon_class }}"
                                style="color: {{ $service->icon_color }};"></i></div>
                        <div>
                            <h4 class="title">{{ $service->title }}</h4>
                            <p class="description">{{ $service->description }}</p>
                            <a href="{{ $service->link }}" class="readmore stretched-link"><span>Learn More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>


    </section><!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
        {!! !empty($cmsContent['cta_background_image']->content)
            ? '<img src="' .
                asset('storage/' . $cmsContent['cta_background_image']->content) .
                '" alt="CTA Background" data-aos="fade-in" alt="CTA Background" />'
            : '' !!}

        <div class="container" data-aos="fade-up" data-aos-delay="200">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>{{ $cmsContent['cta_title']['content'] ?? '' }}</h3>
                        <p>{{ $cmsContent['cta_description']['content'] ?? '' }}</p>
                        <a class="cta-btn" href="/contact">Contact Us</a>
                    </div>

                </div>
            </div>
        </div>

    </section><!-- /Call To Action Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section bg-light py-5">
        <div class="container" data-aos="fade-up" data-aos-delay="200">
            <div class="section-title text-center mb-5">
                <h2 class="fw-bold text-dark">What Our Partners Are Saying</h2>
                <p class="text-secondary fst-italic">Real feedback from those who have experienced our impact.</p>
            </div>


            <div class="testimonials-scroll d-flex">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body text-center px-4 py-5">
                            <img src="{{ asset('storage/' . $testimonial->testimonial_submitter_picture) }}"
                                alt="{{ $testimonial->name }}" class="testimonial-profile">
                            <h5 class="fw-bold text-lg mb-1 text-dark">{{ $testimonial->name }}</h5>
                            <p class="text-muted small mb-3">{{ $testimonial->position }} &mdash;
                                <strong>{{ $testimonial->company_name }}</strong>
                            </p>
                            <p class="fst-italic text-secondary" style="min-height: 100px;">
                                “{{ $testimonial->testimonial_content }}”</p>
                        </div>
                        <div class="testimonial-footer">
                            <img class="rounded" src="{{ asset('storage/' . $testimonial->company_logo) }}"
                                alt="Company Logo">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>




    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Articles</h2>

        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                @foreach ($articles as $article)
                    <div class="col-xl-3 col-md-6 shadow-sm rounded-lg p-3 m-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="post-box">
                            <div class="post-img"><img
                                    src="{{ !empty($article->article_post_image_path) ? asset('storage/' . $article->article_post_image_path) : asset('assets/img/placeholders/placeholder.jpg') }}"
                                    class="img-fluid" alt="{{ $article->title }}">
                            </div>
                            <div class="meta">
                                <span class="post-date">
                                    {{ \Carbon\Carbon::parse($article->created_at)->format('D F jS, Y') }}
                                </span>
                                <span class="post-author"> / {{ config('app.name') }}</span>
                            </div>
                            <h3 class="post-title">{{ $article->title }}</h3>
                            <p>{{ $article->description }}</p>
                            <a href="{{ route('articles.display-article', ['slug' => $article->slug]) }}"
                                class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>

    </section><!-- /Recent Posts Section -->

</x-main-layout>
