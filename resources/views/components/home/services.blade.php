@php
    $services = \App\Models\Service::orderBy('order')->take(12)->get();
@endphp

@if($services->count())
    <section class="py-3" id="home-services">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">DỊCH VỤ CỦA CHÚNG TÔI</h2>

            <div class="swiper myServiceSwiper">
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                        <div class="swiper-slide">
                            <div class="card h-100 border-0 shadow-sm text-white position-relative">
                                @if($service->thumbnail)
                                    <div class="position-relative" style="height: 400px; overflow: hidden;">
                                        <img src="{{ asset($service->thumbnail) }}"
                                             alt="{{ $service->title }}"
                                             class="img-fluid w-100 h-100"
                                             style="object-fit: cover;">
                                        <div class="position-absolute top-50 start-50 translate-middle text-center w-100 px-3">
                                            <h4 class="fw-bold text-white text-uppercase mb-3" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.7);">
                                                {{ $service->title }}
                                            </h4>
                                            <p class="text-uppercase fw-semibold fs-6 text-white"
                                               style="text-shadow: 1px 1px 3px rgba(0,0,0,0.6);">
                                                {{ \Illuminate\Support\Str::limit($service->short_description, 100) }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                                        <span class="text-muted">Không có ảnh</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination mt-3"></div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('services.index') }}" class="btn btn-outline-dark btn-view-all">
                    XEM TẤT CẢ <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const serviceSwiper = new Swiper(".myServiceSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4500,
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
        #home-services .card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.4s ease;
        }

        #home-services .card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        #home-services .btn-view-all {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.5rem 1.25rem;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        #home-services .btn-view-all i {
            transition: transform 0.3s ease;
            margin-left: 5px;
        }

        #home-services .btn-view-all:hover i {
            transform: translateX(4px);
        }
    </style>
@endif
