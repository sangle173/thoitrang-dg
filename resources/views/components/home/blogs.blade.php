@php
    $blogs = \App\Models\Blog::latest()->take(6)->get();
@endphp

@if($blogs->count())
    <section class="py-3" id="home-blogs">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">TIN TỨC MỚI NHẤT</h2>

            <div class="swiper myBlogSwiper">
                <div class="swiper-wrapper">
                    @foreach($blogs as $blog)
                        <div class="swiper-slide">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 border-0 shadow-sm text-center">
                                    <div class="position-relative">
                                        <img src="{{ asset($blog->thumbnail) }}"
                                             alt="{{ $blog->title }}"
                                             class="card-img-top"
                                             style="height: 400px; object-fit: cover;">
                                        <div class="position-absolute bottom-0 end-0 bg-dark text-white px-2 py-1 small"
                                             style="opacity: 0.8;">
                                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title text-uppercase">{{ $blog->title }}</h5>
                                        <p class="card-text text-muted small">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination mt-3"></div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-dark btn-view-all">
                    XEM THÊM <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const blogSwiper = new Swiper(".myBlogSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    }
                }
            });
        </script>
    @endpush

    <style>
        #home-blogs .card {
            transition: transform 0.4s ease;
        }

        #home-blogs .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        #home-blogs .btn-view-all {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.5rem 1.25rem;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        #home-blogs .btn-view-all i {
            transition: transform 0.3s ease;
            margin-left: 5px;
        }

        #home-blogs .btn-view-all:hover i {
            transform: translateX(4px);
        }
    </style>
@endif
