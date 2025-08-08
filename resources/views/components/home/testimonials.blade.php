@php
    $testimonials = \App\Models\Testimonial::orderBy('order')->get();
@endphp

@if($testimonials->count())
    <section class="py-3" id="testimonials">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Khách hàng nói gì về chúng tôi</h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    @foreach($testimonials as $index => $testimonial)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="card border-0 shadow-sm p-4 mx-auto" style="max-width: 720px;">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $testimonial->avatar
                                    ? asset('storage/' . $testimonial->avatar)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) . '&background=0D8ABC&color=fff&size=64' }}"
                                         alt="Avatar"
                                         class="rounded-circle border me-3"
                                         width="64" height="64" style="object-fit: cover;">
                                    <div>
                                        <h5 class="mb-0">{{ $testimonial->name }}</h5>
                                        @if($testimonial->location)
                                            <small class="text-muted">{{ $testimonial->location }}</small>
                                        @endif
                                    </div>
                                </div>
                                <p class="fst-italic mb-3">“{{ $testimonial->content }}”</p>
                                <div class="text-warning small">
                                    @for($i = 0; $i < $testimonial->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                    @for($i = $testimonial->rating; $i < 5; $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
                </button>
            </div>
        </div>
    </section>
@endif
