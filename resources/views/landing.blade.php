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
                        <script type="application/json" class="swiper-config">
        {
            "loop": true,
            "speed": 600,
            "autoplay": {
                "delay": 5000
            },
            "slidesPerView": "auto",
            "centeredSlides": true,
            "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
            },
            "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
            }
        }
    </script>

                        <div class="swiper-wrapper">
                            @foreach ($slides as $slide)
                                <div class="swiper-slide">
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
        <div class="container section-title" data-aos="fade-up">
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
                    {{-- <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon flex-shrink-0" style="color: {{ $service->color }};">
                            <i class="bi {{ $service->icon }}"></i>
                        </div>
                        <div>
                            <h4 class="title">{{ $service->title }}</h4>
                            <p class="description">{{ $service->description }}</p>
                            @if ($service->link)
                                <a href="{{ $service->link }}" class="readmore stretched-link">
                                    <span>Learn More</span><i class="bi bi-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div> --}}
                @endforeach

            </div>
        </div>


    </section><!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
        {!! !empty($cmsContent['cta_background_image']->content)
            ? '<img src="' . asset('storage/' . $cmsContent['cta_background_image']->content) . '" alt="CTA Background" />'
            : '<img src="' . asset('assets/img/cta-bg.jpg') . '" data-aos="fade-in" alt="CTA Background" />' !!}

        <div class="container">
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

    <!-- Features Section -->
    <section id="features" class="features section">

        <div class="container">
            <div class="row">
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="mb-0">Powerful Features for</h3>
                    <h3>Your Business</h3>

                    <div class="row gy-4">

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-eye" style="color: #ff8b2c;"></i>
                                <span>Easy Cart Features</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-infinity" style="color: #5578ff;"></i>
                                <span>Sit amet consectetur adipisicing</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-mortarboard" style="color: #e80368;"></i>
                                <span>Ipsum Rerum Explicabo</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-star" style="color: #ffa76e;"></i>
                                <span>Easy Cart Features</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-x-diamond" style="color: #11dbcf;"></i>
                                <span>Easy Cart Features</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-camera-video" style="color: #4233ff;"></i>
                                <span>Sit amet consectetur adipisicing</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-brightness-high" style="color: #29cc61;"></i>
                                <span>Ipsum Rerum Explicabo</span>
                            </div>
                        </div><!-- End Icon List Item-->

                        <div class="col-md-6">
                            <div class="icon-list d-flex">
                                <i class="bi bi-activity" style="color: #ff5828;"></i>
                                <span>Easy Cart Features</span>
                            </div>
                        </div><!-- End Icon List Item-->
                    </div>
                </div>
                <div class="col-lg-5 position-relative" data-aos="zoom-out" data-aos-delay="200">
                    <div class="phone-wrap">
                        <img src="assets/img/about-page-title-bg.jpg" alt="Details" class="img-fluid" />
                        {{-- <img src="assets/img/iphone.png" alt="Image" class="img-fluid"> --}}
                    </div>
                </div>
            </div>

        </div>

        <div class="details">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <h4>Empowering Profitable, People-First Businesses</h4>
                        <p>At NextTier Solutions, we help companies grow profits by giving back to their teams,
                            employees, and communities. Through focus groups and reward systems, we strengthen workplace
                            culture and community reputation, creating lasting success and impact.</p>
                        <a href="#about" class="btn-get-started">Get Started</a>

                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Features Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Articles</h2>

        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-box">
                        <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid"
                                alt="">
                        </div>
                        <div class="meta">
                            <span class="post-date">Tue, December 12</span>
                            <span class="post-author"> / Julia Parker</span>
                        </div>
                        <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>
                        <p>Illum voluptas ab enim placeat. Adipisci enim velit nulla. Vel omnis laudantium.
                            Asperiores eum ipsa est officiis. Modi qui magni est...</p>
                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="post-box">
                        <div class="post-img"><img src="assets/img/blog/blog-2.jpg" class="img-fluid"
                                alt="">
                        </div>
                        <div class="meta">
                            <span class="post-date">Fri, September 05</span>
                            <span class="post-author"> / Mario Douglas</span>
                        </div>
                        <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>
                        <p>Voluptatem nesciunt omnis libero autem tempora enim ut ipsam id. Odit quia ab eum
                            assumenda. Quisquam omnis doloribus...</p>
                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="post-box">
                        <div class="post-img"><img src="assets/img/blog/blog-3.jpg" class="img-fluid"
                                alt="">
                        </div>
                        <div class="meta">
                            <span class="post-date">Tue, July 27</span>
                            <span class="post-author"> / Lisa Hunter</span>
                        </div>
                        <h3 class="post-title">Quia assumenda est et veritati</h3>
                        <p>Quia nam eaque omnis explicabo similique eum quaerat similique laboriosam. Quis omnis
                            repellat sed quae consectetur magnam...</p>
                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="post-box">
                        <div class="post-img"><img src="assets/img/blog/blog-4.jpg" class="img-fluid"
                                alt="">
                        </div>
                        <div class="meta">
                            <span class="post-date">Tue, Sep 16</span>
                            <span class="post-author"> / Mario Douglas</span>
                        </div>
                        <h3 class="post-title">Pariatur quia facilis similique deleniti</h3>
                        <p>Et consequatur eveniet nam voluptas commodi cumque ea est ex. Aut quis omnis sint ipsum
                            earum quia eligendi...</p>
                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Recent Posts Section -->

</x-main-layout>
