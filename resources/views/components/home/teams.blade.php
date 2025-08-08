@php
    $team = \App\Models\TeamMember::orderBy('order')->get();
@endphp

@if($team->count())
    <section id="team" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 text-uppercase">Đội ngũ nhân sự</h2>

            <div class="swiper teamSwiper">
                <div class="swiper-wrapper">
                    @foreach($team as $member)
                        <div class="swiper-slide">
                            <div class="card h-100 text-center border-0 shadow-sm team-card">
                                <div class="position-relative">
                                    <img src="{{ Str::startsWith($member->photo, 'http') ? $member->photo : asset($member->photo) }}"
                                         class="card-img-top team-photo"
                                         alt="{{ $member->name }}">
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="fw-bold text-uppercase mb-1">{{ $member->name }}</h5>
                                    <p class="text-muted mb-2">{{ $member->position }}</p>
                                    @if($member->bio)
                                        <p class="small text-muted">{{ $member->bio }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Swiper Controls -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination mt-3"></div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            const teamSwiper = new Swiper('.teamSwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
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

@endif

<style>
    #team .team-card {
        transition: transform 0.4s ease;
    }

    #team .team-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    #team .team-photo {
        height: 380px;
        object-fit: cover;
    }

</style>
