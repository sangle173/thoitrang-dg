@php
    $sliders = \App\Models\HeroSlider::orderBy('order')->get();
@endphp

@if($sliders->count())
    <div id="heroCarousel"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="5000"
         data-bs-pause="hover"
         style="margin: 0; padding: 0;">

        <!-- Carousel indicators -->
        <div class="carousel-indicators">
            @foreach($sliders as $index => $slider)
                <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}"
                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="hero-slide-wrapper position-relative d-flex align-items-center justify-content-center text-white">
                        <!-- Slide Image (uses object-fit: cover to fill screen) -->
                        <img src="{{ asset($slider->image) }}"
                             alt="{{ $slider->headline }}"
                             class="hero-bg-img">

                        <!-- Slide Content -->
                        <div class="hero-content text-shadow text-center px-4 px-md-5">
                            <h1 class="display-4 fw-bold animate-fade-in">{{ $slider->headline }}</h1>
                            <p class="lead subheadline animate-fade-in">{{ $slider->subheadline }}</p>
                            @if($slider->button_text && $slider->button_link)
                                <a href="{{ $slider->button_link }}" class="btn btn-primary btn-lg mt-3 animate-fade-in">
                                    {{ $slider->button_text }} <i class="bi bi-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Carousel controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
@endif



<style>
    .hero-slide-wrapper {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        position: relative;
        background-color: #000;
    }

    .hero-bg-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
        pointer-events: none;
        transition: transform 8s ease-out;
    }


    .hero-content {
        z-index: 1;
        position: relative;
        max-width: 100%;
        padding: 1rem 2rem;
    }

    .text-shadow {
        text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.6);
    }

    .animate-fade-in {
        opacity: 0;
        animation: fadeIn 2s forwards;
        animation-delay: 1s;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    .btn-primary {
        background-color: #dc3545;
        border: none;
        padding: 10px 20px;
        font-size: 1.1rem;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .carousel-indicators button {
        background-color: #fff;
        border: none;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 5px;
        transition: background-color 0.3s;
    }

    .carousel-indicators .active {
        background-color: #dc3545;
    }

    /* Mobile tweaks */
    @media (max-width: 768px) {
        .hero-slide-wrapper {
            height: calc(100vw * 0.5625); /* 16:9 ratio = 56.25% of width */
        }

        .hero-bg-img {
            height: 100%;
            animation: mobileZoomIn 10s ease-out forwards;
            transform: scale(1);
        }

        @keyframes mobileZoomIn {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.1);
            }
        }

        .hero-content {
            padding: 0.5rem 1rem;
        }

        .hero-content h1 {
            font-size: 1.4rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .hero-content p {
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }

        .hero-content .btn {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
    }


</style>
